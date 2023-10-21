<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// import model kost
use App\Models\Kost;
use App\Models\Fasilitas;
use App\Models\RekomendasiKost;
use Ramsey\Uuid\Uuid;
// import db dan pdf
use DB;
use PDF;

class InfoKostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekomendasi = DB::table('rekomendasi_kost')
        ->join('kost', 'rekomendasi_kost.kost_id', '=' , 'kost.id')
        ->get();
        // dd($rekomendasi);
        // $kost = Kost::select('*')
        // ->join('users', 'users.id', '=', 'kost.id_user')
        // ->get();    
        $kost = Kost::all();
        // dd($kost);
        // $kost = Kost::all();
        return view('landingpage.home', compact('kost', 'rekomendasi'));
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
        
        $rekomendasi = DB::table('kost')
        ->join('users', 'kost.id_user', '=', 'users.id')
        ->join('fasilitas', 'kost.id_fasilitas', '=', 'fasilitas.id')
        ->get();
        // dd($rekomendasi);
        $kost_id = collect($rekomendasi)->firstWhere('unique_id', '==' ,$id);
        // dd($kost_id);
        return view('landingpage.detail_kamar_customer',compact('kost_id'));
        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}