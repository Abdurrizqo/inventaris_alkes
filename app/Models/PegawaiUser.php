<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PegawaiUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pegawai',
        'username',
        'name',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function pegawai():BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai', 'id');
    }
}
