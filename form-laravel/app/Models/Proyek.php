<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyek extends Model
{
   use HasFactory, SoftDeletes;
   protected $table = 'proyek'; 
    
   protected $fillable = [
        'detail',
        'deskripsi',
        'kategori',
        'anggaran',
        'batas_akhir',
        'lampiran',
        'lokasi_pengerjaan',
    ];
}
