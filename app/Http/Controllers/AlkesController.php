<?php

namespace App\Http\Controllers;

use App\Models\AlatKesehatan;
use App\Models\PinjamBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class AlkesController extends Controller
{
    public function homeControlle(Request $request)
    {
        $search = $request->search;
        $alkes = [];

        if ($search) {
            $search = '%' . $search . '%';

            $alkes = AlatKesehatan::select('alat_kesehatan.id', 'alat_kesehatan.foto_alat_kesehatan', 'alat_kesehatan.nama_alat_kesehatan', 'alat_kesehatan.kode_inventaris', 'ruangan.nama_ruangan')
                ->leftJoin('ruangan', 'alat_kesehatan.ruangan', '=', 'ruangan.id')
                ->where(function ($query) use ($search) {
                    $query->where('nama_alat_kesehatan', 'LIKE', $search)
                        ->orWhere('kode_inventaris', 'LIKE', $search);
                })
                ->get();
        }
        return view('homeView', ['alkes' => $alkes]);
    }

    public function scanAlkesView()
    {
        return view('scanQRView');
    }

    public function guestViewAlkes($id)
    {
        try {
            $alkes = AlatKesehatan::where('alat_kesehatan.id', $id)
                ->leftJoin('ruangan', 'alat_kesehatan.ruangan', '=', 'ruangan.id')
                ->select('alat_kesehatan.*', 'ruangan.nama_ruangan')
                ->first();

            $statusPinjam = PinjamBarang::where('barang', $id)
                ->where('status', 'pinjam')
                ->leftJoin('pegawai', 'pegawai.id', '=', 'pinjam_barang.pegawai_pinjam')
                ->first();

            return view('GuestAlkesView', ['alatKesehatan' => $alkes, 'statusPinjam' => $statusPinjam]);
        } catch (\Throwable $th) {
            return abort(404, $th->getMessage());
        }
    }

    public function pinjamBarang(Request $request)
    {
        $reqUser = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        try {
            if (Auth::guard('karyawan')->attempt($reqUser)) {

                DB::beginTransaction();

                AlatKesehatan::findOrFail($request->input('barang'));

                $user = Auth::guard('karyawan')->user();

                $no_wa = $request->input('no_wa'); // Mengambil nomor dari input
                if (strpos($no_wa, '+628') === 0) {
                    // Jika sudah diawali dengan +628, tidak perlu diubah
                } elseif (strpos($no_wa, '628') === 0) {
                    // Jika hanya terdiri dari 628 tanpa +, tambahkan +
                    $no_wa = '+' . $no_wa;
                } elseif (strpos($no_wa, '08') === 0) {
                    // Jika diawali dengan 08, ubah menjadi +628
                    $no_wa = preg_replace('/^08/', '+628', $no_wa);
                }

                $pinjam = PinjamBarang::create(
                    [
                        'barang' => $request->input('barang'),
                        'no_wa' => $no_wa,
                        'pegawai_pinjam' => $user->pegawai,
                        'tanggal_pinjam' => Carbon::now(),
                    ]
                );


                $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

                $message = "Terimakasih telah mengisi form peminjaman barang, untuk melakukan pengembalian silahkan membuka link berikut \n\n". env('APP_URL'). '/detail-peminjaman/' . $pinjam->id;

                $client->messages->create(
                    "whatsapp:" . $no_wa, // Nomor WhatsApp penerima
                    [
                        'from' => env('TWILIO_WHATSAPP_FROM'),
                        'body' => $message
                    ]
                );
                DB::commit();

                return response()->json(['data' => 'success']);
            } else {
                DB::rollBack();
                return response()->json(['data' => null, 'message' => 'username atau password salah'], 401);
            }
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 400);
        }
    }

    public function barangKembaliView($id)
    {
        $pinjamBarang = PinjamBarang::where('pinjam_barang.id', $id)
            ->leftJoin('alat_kesehatan', 'alat_kesehatan.id', '=', 'pinjam_barang.barang')
            ->leftJoin('pegawai', 'pegawai.id', '=', 'pinjam_barang.pegawai_pinjam')
            ->first();

        if (!$pinjamBarang) {
            return abort(404);
        }
        return view('barangKembali', ['barangKembali' => $pinjamBarang, 'idPinjam' => $id]);
    }

    public function updateBarangKembali($id)
    {
        try {
            PinjamBarang::where('id', $id)
                ->update(
                    [
                        'status' => 'KEMBALI',
                        'tanggal_kembali' => Carbon::now()
                    ]
                );

            return response()->json([
                'data' => null,
                'message' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function updateBarangHilang($id)
    {
        try {
            PinjamBarang::where('id', $id)
                ->update(
                    [
                        'status' => 'HILANG',
                        'tanggal_kembali' => Carbon::now()
                    ]
                );

            return response()->json([
                'data' => null,
                'message' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }
}
