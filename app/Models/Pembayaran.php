<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    // proteceted fillabel buat table pembayaran
    protected $table = 'pembayaran';
    protected $guarded = [];   
}