<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// import models users
use App\Models\User;
use PDF;
use DB;
// buat export excel
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = ['No', 'Nama', 'Email', 'Role', 'Pekerjaan', 'Aksi'];
        $users = User::all();
        // dd($users);
        return view('admin.users.index', compact('users', 'title'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'role' => 'required',
            'telp' => 'required|int',
            'pekerjaan' => 'required|max:255',
            'foto_user' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'alamat' => 'required',
        ]);

        if(!empty($request->foto_user)){
            $fileName = 'foto_user-'.$request->name.'.'.$request->foto_user->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto_user->move(public_path('admin/img/users'),$fileName);
        }
        else{
            $fileName = '';
        }


        DB::table('users')->insert(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'telp' => $request->telp,
                'pekerjaan' => $request->pekerjaan,
                'foto_user' => $fileName,
                'alamat' => $request->alamat,
                'created_at'=>now()
            ]);
        return redirect()->route('users.index')->with('success' , 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = User::find($id);
        return view('admin.users.detail',compact('user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_edit = User::find($id);
        // dd($user_edit);
        return view('admin.users.form_edit',compact('user_edit'));
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
        // proses input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'telp' => 'required|numeric',
            'foto_user' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        //------------foto lama apabila admin ingin ganti foto kamar-----------
        $foto = DB::table('users')->select('foto_user')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto_user;
        }

        /**
         * Jika user ingin ganti foto profile
         * Jika ada foto lama ada, maka hapus foto lama terlebih dahulu danganti foto baru
         */
        if(!empty($request->foto_user)){
            if(!empty($kost_id->foto_user)) unlink('admin/img/'.$kost_id->foto_user);
            $fileName = 'foto_user-'.$request->name.'.'.$request->foto_user->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto_user->move(public_path('admin/img/users/'),$fileName);
        }
        /**
         * Jika admin tidak update foto kamar maka, pakai foto lama
         */
        else{
            $fileName = $namaFileFotoLama;
        }

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
            'foto_user' => $fileName,
            'password' => Hash::make($request->password),
            'updated_at'=>now(),
            ]);

        return redirect('/users'.'/'.$id)
                        ->with('success','Data user berhasil di Update!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // sebelum delete foto hapus bersih dulu fisik file fotonya jika ada
        $user = User::find($id);
        if(!empty($user->foto_user)) unlink('admin/img/users/'.$user->foto_user);

        User::where('id', $id)->delete();
        return redirect()->route('users.index')
        ->with('success', 'Data user berhasil dihapus!');
    }

    public function usersPDF(){
        $title = ['NO', 'NAMA', 'EMAIL', 'ROLE','PEKERJAAN', 'AKUN DIBUAT'];
        $users = User::all();
        $pdf = PDF::loadView('admin.users.usersPDF', compact('users', 'title'));
        return $pdf->download('data_users.pdf');
    }


    public function usersExcel(Request $request){
        return Excel::download(new UserExport, 'data_users.xlsx');
    }
}