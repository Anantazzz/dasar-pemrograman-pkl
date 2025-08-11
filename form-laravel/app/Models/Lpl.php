<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lpl extends Model
{
    use HasFactory;

    protected $table = 'lpl';
    protected $fillable = ['portofolio_id', 'longitude', 'latitude', 'terbuka_klien', 'layanan', 'setuju'];

    public function portofolio()
    {
        return $this->belongsTo(PortofolioSatu::class, 'portofolio_id');
    }
}
