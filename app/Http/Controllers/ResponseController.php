<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($darah_id)
    {
        $darahs = Response::where('darah_id', $darah_id)->first();
        $darahId = $darah_id;
        return view('response', compact('darahs', 'darahId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $darah_id)
    {
        $request->validate([
            'status' => 'required',
            'jadwal' => 'required',
        ]);
        if($request->status == 'ditolak'){
            $jadwal = null ;
        }
        else{
            $jadwal = $request->jadwal;
        }
        Response::updateOrCreate(
            [
                'darah_id' => $darah_id,
            ],
            [
                'status' => $request->status,
                'jadwal' => $jadwal,
            ]
        );
        return redirect()->route('data.petugas')->with('', 'Berhasil mengubah response!');
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
