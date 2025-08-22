<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Management extends Model
{
    use HasFactory, SoftDeletes;

     protected $table = 'management'; 

     protected $fillable = [
         'proyek',
         'judul_tugas',
         'deskripsi_tugas',
         'batas_akhir',
         'status',
         'progress',
     ];
}
