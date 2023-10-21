<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import model kost
use App\Models\Kost;
use App\Models\Fasilitas;
// import DB Query builder untuk fiture upload
use DB;
use PDF;
use App\Exports\ExportKost;
use Maatwebsite\Excel\Facades\Excel;




class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Controller untuk APIs kost
     */
    // ======================================

    public function kostIndex(){
        $kost = Kost::all();

        if($kost){
            $data = [
                "message" => "Get All Resource - Kost",
                "data" => $kost 
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Data Not Found",
                 
            ];
            return response()->json($data, 404);
        }
        
    }

    public function kostShow($id){
        $kost = Kost::find($id);

        if($kost){
            $data = [
                "message" => "Get All Resource - kost",
                "data" => $kost 
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Data Not Found",
                 
            ];
            return response()->json($data, 404);
        }
        
    }

    public function kostStore(Request $request){
        $input = [
            'nama_kost' => $request->nama_kost,
            'luas_kamar' =>  $request->luas_kamar,
            'harga_kamar' =>  $request->harga_kamar,
            'alamat_kost' =>  $request->alamat_kost,
            'keterangan' =>  $request->keterangan,
            'id_fasilitas' =>  $request->id_fasilitas,
            'id_user' =>  $request->id_user,
            'kota_id' =>  $request->kota_id,
            'foto_kamar' =>  $request->foto_kamar,
            'unique_id' => $request->unique_id,
        ];

            
        
        $kost = Kost::create($input);
            $data = [
                "message"=>"Kost is Created!",
                "data" => $kost,
            ];
            return response()->json($data, 201);
    }


    public function kostUpdate(Request $request, $id){
        $kost = Kost::find($id);

        if($kost){
            $input = [
                'foto_kamar' => $request->foto_kamar ?? $kost->foto_kamar,
                'nama_kost' => $request->nama_kost ?? $kost->nama_kost,
                'luas_kamar' => $request->luas_kamar ?? $kost->luas_kamar,
                'harga_kamar' => $request->harga_kamar ?? $kost->harga_kamar,
                'alamat_kost' => $request->alamat_kost ?? $kost->alamat_kost,
                'keterangan' => $request->keterangan ?? $kost->keterangan,
                'id_fasilitas' => $request->id_fasilitas ?? $kost->id_fasilitas,
                'kota_id' => $request->kota_id ?? $kost->kota_id,
                'created_at' => $request->created_at ?? $kost->created_at,
                'updated_at' => $request->updated_at ?? $kost->updated_at,
            ];
            $kost->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $kost
            ];

            return response($data, 200);
        }else{
            $data = [
                'message' => 'Resource not found',
            ];
            return response()->json($data, 404);
        }
    }

    public function kostDestroy($id){
        $kost = Kost::find($id);

        if($kost){
        $kost->delete();

        $data = [
            "message" => "Resource is delete successfully",
        ];

        } else{
            $data = [
                'message' => 'Resource not found',
            ];
        
            return response()->json($data, 404);
        }
            return response()->json($data, 200);
    }
    




    // ============================================


    public function index(Request $request)
    {
        // $kost = Kost::all();
        // return view('admin.kost.kost', compact('kost'));

        $kost = Kost::orderBy('id', 'DESC')->get();
        $d_fasilitas = Fasilitas::all();
        return view('admin.kost.kost', compact('kost', 'd_fasilitas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kost.form');
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
            'nama_kost' => 'required|max:45',
            'luas_kamar' => 'required|max:45',
            'harga_kamar' => 'required|max:45',
            'keterangan' => 'required|max:45',
            'alamat_kost' => 'required|string|min:10',
            'foto_kamar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'id_fasilitas' => 'required|max:45',
            'id_user' => 'required|integer',
        ]);
      
        // $kost = Kost::create($request->all());
        // apakah admin ingin upload foto kamar
        if(!empty($request->foto_kamar)){
            $fileName = 'foto_kamar-'.$request->luas_kamar.'.'.$request->foto_kamar->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto_kamar->move(public_path('admin/img'),$fileName);
        }
        else{
            $fileName = '';
        }

        //lakukan insert data dari request form
        DB::table('kost')->insert(
            [
                'nama_kost' => $request->nama_kost,
                'luas_kamar' => $request->luas_kamar,
                'harga_kamar' => $request->harga_kamar,
                'keterangan' => $request->keterangan,
                'alamat_kost' => $request->alamat_kost,
                'foto_kamar' => $fileName,
                'id_fasilitas' => $request->id_fasilitas,
                'id_user' => $request->id_user,
                'kota_id' => $request->kota_id,
                'unique_id' => $request->unique_id,
                'created_at'=>now()
            ]);
       
        return redirect()->route('kost.index')
                        ->with('success','Kost Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d_fasilitas = Fasilitas::all();
        
        $kost_id = Kost::find($id);
        return view('admin.kost.detail',compact('kost_id', 'd_fasilitas'));
    }

    public function detail($id)
    {
        $detail_kamar = Kost::find($id);
        return view('landingpage.detail_product',compact('detail_kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kost_edit = Kost::find($id);
        return view('admin.kost.form_edit',compact('kost_edit'));
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
        // proses input data kost
        $request->validate([
            'nama_kost' => 'required|max:45',
            'luas_kamar' => 'required|max:45',
            'harga_kamar' => 'required|max:45',
            'keterangan' => 'required|max:45',
            'alamat_kost' => 'nullable|string|min:10',
            'foto_kamar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'id_fasilitas' => 'required|max:45'
        ]);

        //------------foto lama apabila admin ingin ganti foto kamar-----------
        $foto = DB::table('kost')->select('foto_kamar')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto_kamar;
        }

        /**
         * Jika admin ingin ganti foto kamar
         * Jika ada foto lama ada, maka hapus foto lama terlebih dahulu danganti foto baru
         */
        if(!empty($request->foto_kamar)){
            if(!empty($kost_id->foto_kamar)) unlink('admin/img/'.$kost_id->foto_kamar);
            $fileName = 'foto_kamar-'.$request->luas_kamar.'.'.$request->foto_kamar->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto_kamar->move(public_path('admin/img'),$fileName);
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
        DB::table('kost')->where('id',$id)->update(
            [
                'nama_kost' => $request->nama_kost,
                'luas_kamar' => $request->luas_kamar,
                'harga_kamar' => $request->harga_kamar,
                'keterangan' => $request->keterangan,
                'alamat_kost' => $request->alamat_kost,
                'foto_kamar' => $fileName,
                'id_fasilitas' => $request->id_fasilitas,
                'updated_at'=>now(),
            ]);

        return redirect('/kost'.'/'.$id)
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
        // sebelum delete foto hapus bersih dulu fisik file fotonya jika ada
        $kost = Kost::find($id);
        if(!empty($kost->foto_kamar)) unlink('admin/img/'.$kost->foto_kamar);

        Kost::where('id', $id)->delete();
        return redirect()->route('kost.index')
        ->with('success', 'Data kost berhasil dihapus!');
    }

    public function generatePDF(){
        $data = [
            'title' => 'Testing generate pdf',
            'date' => date('m/d/Y'),
            'isi' => 'Menggunakan pustaka barryvdh/laravel-dompdf'
        ];

        $pdf = PDF::loadView('admin.kost.testPDF', $data);
        return $pdf->download('test_pdf.pdf');
    }

    public function kostPDF(){
        $title = ['No', 'Nama Kost', "Luas Kamar", "Harga Kamar", "Alamat Kost", "Keterangan", "Fasilitas"];
        $kost = Kost::orderBy('id', 'DESC')->get();
        $d_fasilitas = Fasilitas::all();
        // dd($kost);
        // $pdf = PDF::loadView('admin.kost.kostPDF', ['kost' => $kost, 'd_fasilitas' => $d_fasilitas, 'title' => $title]);
        $pdf = PDF::loadView('admin.kost.kostPDF', compact('kost', 'd_fasilitas', 'title'));
        return $pdf->download('info_kost.pdf');
    }

    public function exportExcel(Request $request){
        return Excel::download(new ExportKost, 'kost.xlsx');
    }
}