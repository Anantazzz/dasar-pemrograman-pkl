<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioItem extends Model
{
    use HasFactory;

    protected $table = 'portofolio_item';
    protected $fillable = ['portofolio_id', 'judul_proyek', 'deskripsi_singkat', 'url_proyek'];

    public function portofolio()
    {
        return $this->belongsTo(PortofolioSatu::class, 'portofolio_id');
    }
}
