<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'ruangan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'nama_ruangan'
    ];
}
