<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('landingpage.dashboard-kos', compact('pemilik_kost'));
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

        $detail = collect($pemilik_kost);
        $d = $detail->firstWhere('id', '==', $id);
        return view('landingpage.detail_kamar_pemilik', compact('d'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d = Kost::find($id);
        return view('landingpage.test',compact('d'));
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
        DB::table('kost')->where('id',$id)->update(
            [
                'nama_kost' => $request->nama_kost,
                'luas_kamar' => $request->luas_kamar,
                'harga_kamar' => $request->harga_kamar,
                'alamat_kost' => $request->alamat_kost,
                'keterangan' => $request->keterangan,
                'kota_id' => $request->kota_id,
                'id_user' => $request->id_user,
            ]);

        return redirect('/dashboard-kos'.'/'.$id)
                        ->with('success','Data kost berhasil di Update!');
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