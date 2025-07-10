<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public $fillable = ['user_id', 'jumlah', 'tanggal'];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
