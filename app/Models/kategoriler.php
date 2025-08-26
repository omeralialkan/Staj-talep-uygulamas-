<?php
// app/Models/kategoriler.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriler extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_adi',
        'talep_eden',
        'kategori_url',
        'anahtar',
        'aciklama',
        'resim',
        'durum',
    ];

    // user ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class, 'talep_eden');
    }
    public function yonlendirilenUser()
    {
        return $this->belongsTo(User::class, 'yonlendirilen_id');
    }
}
