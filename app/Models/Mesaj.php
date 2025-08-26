<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesaj extends Model
{
    protected $table = 'mesajlar'; 
    protected $guarded = [];

    public function gonderen()
    {
        return $this->belongsTo(User::class, 'gonderen_id');
    }
} 