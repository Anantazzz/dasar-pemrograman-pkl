<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ulasan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ulasan';

    protected $fillable = [
        'rating',
        'ulasan',
    ];
}
