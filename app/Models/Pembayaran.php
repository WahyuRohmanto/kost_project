<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    // proteceted fillabel buat table pembayaran
    protected $table = 'pembayaran';
    protected $fillable = ['kode_bayar','metode_pembayaran', 'pesanan', 'id_kamar', 'id_user', 'tanggal_masuk', 'tanggal_keluar', 'total_bayar', 'status_pembayaran'];
}