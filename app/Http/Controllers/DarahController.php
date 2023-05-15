<?php

namespace App\Http\Controllers;

use App\Exports\darahExport;
use App\Models\Darah;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;

class DarahController extends Controller
{
    public function login(){
        return view('login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    public function exportExcel()
    {
        //nama file yang akan terdownload 
        $file_name =
        'data_pendonor.xlsx';
        //memanggil file ReportsExport dan mendownloadnya dengan nama seperti $file name
        return Excel::download(new darahExport, $file_name);
    }

    public function exportPDF() { 
        $data = Darah::with('response')->get()->toArray(); 
        view()->share('darahs',$data); 
        $pdf = PDF::loadView('print', $data)->setPaper('a4', 'landscape'); 
        return $pdf->download('donors-data.pdf'); 
    } 

    public function data(Request $request){
       $search = $request->search;
       $darahs = Darah::with('response')->where('nama', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
       return view('data',compact('darahs'));
    }

    public function dataPetugas(Request $request){
        $search = $request->search;
        $darahs = Darah::with('response')->orderBy('created_at', 'DESC')->get();
        return view('petugas', compact('darahs'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // validasi
          $request->validate([
            'nama' => 'required',
            'email'=> 'required',
            'no_telp' => 'required|max:13',
            'darah' => 'required',
            'umur'=>'required',
            'berat'=>'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png,svg',
        ]);
        // pindah foto ke folder public
        $path = public_path('assets/image/');
        $image = $request->file('foto');
        $imgName = rand() . '.' . $image->extension(); // foto.jpg : 1234.jpg
        $image->move($path, $imgName);
        // tambah data ke db
        Darah::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'darah' => $request->darah,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'foto' => $imgName,
        ]);
        return redirect()->back();
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('data');
            }elseif(Auth::user()->role == 'petugas') {
                return redirect()->route('data.petugas');
            }
        }else {
            return redirect()->back()->with('gagal', 'Gagal login, coba lagi!');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Darah $donorDarah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Darah $donorDarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Darah $donorDarah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Darah::where('id', $id)->firstOrFail();
        $image = public_path('assets/image/'.$data['foto']);
        unlink($image);
        $data->delete();
        return redirect()->back();
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
