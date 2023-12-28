<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Exports\PemilikExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pembayaran;

/**
 * import query builder
 * import models
 * - kost
 * - user/role
 * - rekomendasi kost
 */
use DB;
use App\Models\Kost;
use App\Models\User;
use App\Models\RekomendasiKost;
use App\Models\Fasilitas;
use App\Models\Kota;
use Illuminate\Support\Facades\Validator;


class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemilik_kost = DB::table('users')
        ->join('kost', 'kost.id_user', '=', 'users.id')
        ->join('fasilitas', 'fasilitas.id', '=', 'kost.id_fasilitas')
        ->select('*')
        ->where('role', 'pemilik')
        ->get();

        // dd($pemilik_kost);
        
        return view('landingpage.kelola_pemilik.table_pemilik', compact('pemilik_kost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemilik_kost = DB::table('users')
        ->join('kost', 'kost.id_user', '=', 'users.id')
        ->join('fasilitas', 'fasilitas.id', '=', 'kost.id_fasilitas')
        ->select('*')
        ->where('role', 'pemilik')
        ->get();

        $d = collect($pemilik_kost);
        $detail_kamar = $d->firstWhere('id', '==', $id);
        return view('landingpage.kelola_pemilik.detail_kamar', compact('detail_kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $fasilitas = Fasilitas::all();
        $detail_kamar = Kost::find($id);
        $kota = Kota::find($id);
        return view('landingpage.kelola_pemilik.form_edit',compact('detail_kamar', 'fasilitas', 'kota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
// dd($request);
        $request->validate([
            'nama_kost' => 'required|max:45',
            'luas_kamar' => 'required|max:45',
            'harga_kamar' => 'required|max:45',
            'alamat_kost' => 'required|max:45',
            'foto_kamar' => 'required|max:45',
            'id_fasilitas' => 'required|max:45',
            'kota_id' => 'required|max:45',
            'id_user' => 'required|max:45',
        ]);

        DB::table('kost')
        ->where('id',$id)
        ->update(
            [
                'nama_kost' =>$request->nama_kost,
                'luas_kamar' =>$request->luas_kamar,
                'harga_kamar' =>$request->harga_kamar,
                'alamat_kost' =>$request->alamat_kost,
                'foto_kamar' =>$request->foto_kamar,
                'id_fasilitas' =>$request->id_fasilitas,
                'kota_id' =>$request->kota_id,
                'id_user' =>$request->id_user,
                'updated_at'=>now(),
            ]
        );

        return redirect()->route('data-pemilik.index')->with(['success' => 'Kost Pemilik Berhasil Diupdate!']);
        
    }

    public function destroy($unique_id)
    {
        $kost = Kost::where('unique_id', $unique_id)->first();

        if (!$kost) {
            return redirect()->route('data-pemilik.index')->with(['error' => 'Kost Pemilik tidak ditemukan!']);
        }

        $kost->delete();

        return redirect()->route('data-pemilik.index')->with(['success' => 'Kost Pemilik Berhasil Dihapus!']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cetakKost()
    {
        $pemilik_kost = DB::table('users')
        ->join('kost', 'kost.id_user', '=', 'users.id')
        ->join('fasilitas', 'fasilitas.id', '=', 'kost.id_fasilitas')
        ->select('*')
        ->where('role', 'pemilik')
        ->get();
        $pdf = PDF::loadView('landingpage.kelola_pemilik.cetakPDF', ['pemilik_kost'=> $pemilik_kost]);
        return $pdf->download('data_kost_pemilik.pdf');
    }

    public function print(Request $request){
        return Excel::download(new PemilikExport, 'pemilik_kost.xlsx');
    }

    public function pesanan(){
        $title = ['No', 'Kode Bayar', 'Customer', 'Tanggal Masuk', 'Tanggal Keluar', 'Total Bayar', 'Status Pembayaran', 'Pesanan', 'Action'];
        // $pembayaran = Pembayaran::all();
        $pembayaran = Pembayaran::join('users', 'pembayaran.id_customer', '=', 'users.id')
        ->get();
        // dd($pembayaran);

        return view('landingpage.kelola_pemilik.pesanan', compact('pembayaran', 'title'));
    }
}