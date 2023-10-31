<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import model pembayaran
use App\Models\Pembayaran;
use DB;
use PDF;
use App\Exports\ExportPembayaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * Controller untuk APIs pembayaran
     */
    // ======================================

    public function pembayaranIndex(){
        $pembayaran = Pembayaran::all();

        if($pembayaran){
            $data = [
                "message" => "Get All Resource - Pembayaran",
                "data" => $pembayaran 
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Data Not Found",
                 
            ];
            return response()->json($data, 404);
        }
        
    }

    public function pembayaranShow($id){
        $pembayaran = Pembayaran::find($id);

        if($pembayaran){
            $data = [
                "message" => "Get All Resource - Pembayaran",
                "data" => $pembayaran 
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Data Not Found",
                 
            ];
            return response()->json($data, 404);
        }
    }

    // ============================================

     
    public function index()
    {
        $pembayaran = Pembayaran::all();
        // dd($pembayaran);
        return view('admin.pembayaran.pembayaran', compact('pembayaran'));
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
        // dd($request->all());

        $request->validate([
            'kode_bayar' => 'required|max:45',
            'tanggal_masuk' => 'required|max:45',
            'tanggal_keluar' => 'required|max:45',
            'total_bayar' => 'required|max:45',
            'id_user' => 'required|max:45',
            'metode_pembayaran' => 'required|max:45',
            'id_kamar' => 'required|max:45',
        ]);

            DB::table('pembayaran')->insert(
                [
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
                    'created_at'=>now()
                ]);
        return back()->with('success','Pembayaran sedang di proses silahkan bayar sesuai total pembayaran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran_id = Pembayaran::all();
        $data = collect($pembayaran_id)->firstWhere('id', '==', $id);
        return view('admin.pembayaran.detailPembayaran',compact('data'));
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
        // dd($id);
        $test = DB::table('pembayaran')
        ->where('id', $id)
        ->update(
            [
                'pesanan'=>$request->pesanan,
            ]
        );
        // dd($test);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fasilitas = Pembayaran::find($id);
        Pembayaran::where('id', $id)->delete();

        return back()
        ->with('success', 'Data pembayaran berhasil dihapus!');
    }

    public function pembayaranPDF(){
        $title = ['No', 'Kode Bayar', "Id Kamar", "Id User", "Tanggal Masuk", "Tanggal Keluar", "Total Bayar"];
        $pembayaran = Pembayaran::orderBy('id', 'DESC')->get();
        // $d_fasilitas = Fasilitas::all();
        // dd($kost);
        $pdf = PDF::loadView('admin.pembayaran.pembayaranPDF', compact('pembayaran' , 'title' ));
        return $pdf->download('data_pembayaran.pdf');
    }

    public function pembayaranExcel(Request $request){
        return Excel::download(new ExportPembayaran, 'pembayaran.xlsx');
    }

    public function penyewa(){
        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.id_user')
                ->join('kost', 'kost.id', '=', 'pembayaran.id_kamar')
                ->limit(3)
                ->get(['pembayaran.status_pembayaran', 'pembayaran.pesanan', 'users.name', 'kost.nama_kost']);


        // $pembayaran = Pembayaran::select('*')->
        // dd($pembayaran);
        return view('landingpage.dashboard', compact('pembayaran'));
    }

    public function invoiceCustomer(){
        $heading = ['Pemilik', 'Kode Bayar', 'Mulai Kost', 'Kost Selesai', 'Total Bayar', 'Status Pembayaran', 'Status Pesanan'];
        // $invoice = Pembayaran::all();
        $invoice = Pembayaran::join('users', 'users.id', '=', 'pembayaran.id_user')
              ->join('kost', 'kost.id', '=', 'users.id')
              ->get(['*', 'pembayaran.id_user', 'users.name', 'kost.nama_kost', 'kost.luas_kamar', 'kost.harga_kamar']);
        // dd($invoice);
        $pdf = PDF::loadView('landingpage.invoiceCustomerPDF', compact('invoice', 'heading'));
        return $pdf->download('invoice.pdf');
    }

    public function transaksiCustomer(){
        // $history = Pembayaran::where('id_customer', Auth::user()->id)->get();   
        // dd($history);
        $history = Pembayaran::join('kost', 'pembayaran.unique_id_kost', '=', 'kost.unique_id')
        ->join('users', 'kost.id_user', '=', 'users.id')
        ->where('pembayaran.id_customer', Auth::user()->id)
        ->get();
        // dd($history);
        return view('landingpage.history', compact('history'));
    }
}