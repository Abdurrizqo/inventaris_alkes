<?php

namespace App\Http\Controllers;

use App\Models\AlatKesehatan;



class AlkesController extends Controller
{
    public function guestViewAlkes($id)
    {
        try {
            $alkes = AlatKesehatan::findOrFail($id);
            return view('GuestAlkesView', ['alkes' => $alkes]);
        } catch (\Throwable $th) {
            return abort(404, $th->getMessage());
        }
    }
}
