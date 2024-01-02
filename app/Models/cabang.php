<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
    use HasFactory;

    protected $table = "cabang";

    protected $fillable = [
        'kode_cabang',
        'nama_cabang',
        'lokasi_cabang',
        'radius_cabang'
        // tambahkan kolom lain sesuai kebutuhan
    ];
}
