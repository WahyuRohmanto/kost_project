<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use DB;
use PDF;
use Excel;
use App\Exports\ExportPembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // Menampilkan semua data pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return view('admin.pembayaran.pembayaran', compact('pembayaran'));
    }

    // Menampilkan formulir pembuatan pembayaran
    public function create()
    {
        // Implementasi jika diperlukan
    }

    // Menyimpan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_bayar' => 'required|max:45',
            'tanggal_masuk' => 'required|max:45',
            'tanggal_keluar' => 'required|max:45',
            'total_bayar' => 'required|max:45',
            'id_user' => 'required|max:45',
            'metode_pembayaran' => 'required|max:45',
            'id_kamar' => 'required|max:45',
        ]);

        // Menyimpan data pembayaran
        DB::table('pembayaran')->insert([
            'kode_bayar' => $request->kode_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'total_bayar' => $request->total_bayar,
            'id_kamar' => $request->id_kamar,
            'id_user' => $request->id_user,
            'pesanan' => $request->pesanan,
            'status_pembayaran' => $request->status_pembayaran,
            'id_customer' => $request->id_customer,
            'unique_id_kost' => $request->unique_id,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Pembayaran sedang diproses, silakan bayar sesuai total pembayaran!');
    }

    // Menampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran_id = Pembayaran::all();
        $data = collect($pembayaran_id)->firstWhere('id', '==', $id);
        return view('admin.pembayaran.detailPembayaran', compact('data'));
    }

    // Mengupdate pembayaran oleh admin
    public function update(Request $request, $id)
    {
        $data = [
            'status_pembayaran' => $request->status_pembayaran,
        ];

        DB::table('pembayaran')
            ->where('id', $id)
            ->update($data);

        return back();
    }

    // Menghapus pembayaran
    public function destroy($id)
    {
        $fasilitas = Pembayaran::find($id);
        Pembayaran::where('id', $id)->delete();

        return back()->with('success', 'Data pembayaran berhasil dihapus!');
    }

    // Menghasilkan file PDF untuk data pembayaran
    public function pembayaranPDF()
    {
        $title = ['No', 'Kode Bayar', "Id Kamar", "Id User", "Tanggal Masuk", "Tanggal Keluar", "Total Bayar"];
        $pembayaran = Pembayaran::orderBy('id', 'DESC')->get();
        $pdf = PDF::loadView('admin.pembayaran.pembayaranPDF', compact('pembayaran', 'title'));
        return $pdf->download('data_pembayaran.pdf');
    }

    // Menghasilkan file Excel untuk data pembayaran
    public function pembayaranExcel(Request $request)
    {
        return Excel::download(new ExportPembayaran, 'pembayaran.xlsx');
    }

    // Menampilkan data pembayaran untuk penyewa
    public function penyewa()
    {
        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.id_user')
            ->join('kost', 'kost.id', '=', 'pembayaran.id_kamar')
            ->limit(3)
            ->get(['pembayaran.status_pembayaran', 'pembayaran.pesanan', 'users.name', 'kost.nama_kost']);
        return view('landingpage.dashboard', compact('pembayaran'));
    }

    // Menghasilkan invoice PDF untuk pelanggan
    public function invoiceCustomer()
    {
        $heading = ['Pemilik', 'Kode Bayar', 'Mulai Kost', 'Kost Selesai', 'Total Bayar', 'Status Pembayaran', 'Status Pesanan'];
        $invoice = Pembayaran::join('users', 'users.id', '=', 'pembayaran.id_user')
            ->join('kost', 'kost.id', '=', 'users.id')
            ->get(['*', 'pembayaran.id_user', 'users.name', 'kost.nama_kost', 'kost.luas_kamar', 'kost.harga_kamar']);
        $pdf = PDF::loadView('landingpage.invoiceCustomerPDF', compact('invoice', 'heading'));
        return $pdf->download('invoice.pdf');
    }

    // Menampilkan riwayat transaksi pelanggan
    public function transaksiCustomer()
    {
        $history = Pembayaran::join('kost', 'pembayaran.unique_id_kost', '=', 'kost.unique_id')
            ->join('users', 'kost.id_user', '=', 'users.id')
            ->where('pembayaran.id_customer', Auth::user()->id)
            ->get();

        return view('landingpage.history', compact('history'));
    }

    // Mengupdate pesanan oleh pemilik
    public function pemPemilik(Request $request, $id)
    {
        DB::table('pembayaran')
            ->where('id', $id)
            ->update(['pesanan' => $request->pesanan]);
        return back();
    }
}