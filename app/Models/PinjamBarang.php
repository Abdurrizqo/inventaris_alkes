<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PinjamBarang extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pinjam_barang';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'barang',
        'no_wa',
        'pegawai_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    public function barangJoin(): BelongsTo
    {
        return $this->belongsTo(AlatKesehatan::class, 'barang', 'id');
    }

    public function pegawaiPinjamJoin(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_pinjam', 'id');
    }
}
