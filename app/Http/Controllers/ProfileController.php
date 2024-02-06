<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('landingpage.profileDetail', compact('user'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('landingpage.profileEdit',compact('user'));
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
        // dd($request->all());
        // proses input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'telp' => 'required|numeric',
            // 'foto_user' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        //------------foto lama apabila admin ingin ganti foto kamar-----------
        // $foto = DB::table('users')->select('foto_user')->where('id',$id)->get();
        // foreach($foto as $f){
        //     $namaFileFotoLama = $f->foto_user;
        // }

        /**
         * Jika user ingin ganti foto profile
         * Jika ada foto lama ada, maka hapus foto lama terlebih dahulu danganti foto baru
         */
        // if(!empty($request->foto_user)){
        //     if(!empty($kost_id->foto_user)) unlink('admin/img/'.$kost_id->foto_user);
        //     $fileName = 'foto_user-'.$request->name.'.'.$request->foto_user->extension();
        //     //$fileName = $request->foto->getClientOriginalName();
        //     $request->foto_user->move(public_path('admin/img/users/'),$fileName);
        // }
        // /**
        //  * Jika admin tidak update foto kamar maka, pakai foto lama
        //  */
        // else{
        //     $fileName = $namaFileFotoLama;
        // }

        /**
         * Lakukan update data dari request form edit
         */
        DB::table('users')->where('id',$id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'pekerjaan' => $request->pekerjaan,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                // 'foto_user' => $fileName,
                // 'password' => Hash::make($request->password),
                'updated_at'=>now(),
            ]);

        return redirect()->route('customer-profile.index')->with('success','Data user berhasil di Update!');

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