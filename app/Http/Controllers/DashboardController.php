<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * - import DB buat jalanin query builder
 * - import models pembayaran
 */
use DB;
use App\Models\Pembayaran;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $pembayaran = Pembayaran::select('*')
        ->sum('total_bayar');
        $data_kost = DB::table('pembayaran')->get();
        $data_users = User::select('name', 'role', 'pekerjaan', 'total_bayar', 'id_kamar', 'tanggal_masuk')->join('pembayaran', 'users.id', '=', 'pembayaran.id_user')->get();
        return view('admin.home', compact('data_kost', 'data_users', 'pembayaran'));
    }

    public function Revenue(){
        $pembayaran = Pembayaran::select('*')
        ->get();
        return view('admin.home', compact('pembayaran'));
    }
}