<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioSatu extends Model
{
    use HasFactory;

    protected $table = 'portofolio_satu';
    protected $fillable = ['judul_portofolio', 'ringkasan', 'keahlian', 'warna_tema'];
    protected $casts = [
    'setuju' => 'boolean',
];

    public function gambar()
    {
        return $this->hasMany(PortofolioGambar1::class, 'portofolio_id');
    }

    public function item()
    {
        return $this->hasMany(PortofolioItem::class, 'portofolio_id');
    }

    public function lpl()
    {
        return $this->hasOne(Lpl::class, 'portofolio_id');
    }
}
