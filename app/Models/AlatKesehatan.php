<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatKesehatan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'alat_kesehatan';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'foto_alat_kesehatan',
        'foto_serial_number',
        'nama_alat_kesehatan',
        'kode_inventaris',
        'merk',
        'type',
        'nomer_seri',
        'ruangan',
        'akd',
        'akl',
        'klasifikasi',
        'teknologi',
        'risiko',
        'tanggal_pengadaan',
        'sumber_pendanaan',
        'nama_penyedia',
        'masa_garansi',
    ];

    public function ruanganJoin(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan', 'id');
    }
}
