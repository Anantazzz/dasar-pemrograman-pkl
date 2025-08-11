<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioGambar1 extends Model
{
    use HasFactory;

    protected $table = 'portofolio_gambar1';
    protected $fillable = ['portofolio_id', 'file_path'];

    public function portofolio()
    {
        return $this->belongsTo(PortofolioSatu::class, 'portofolio_id');
    }
}
