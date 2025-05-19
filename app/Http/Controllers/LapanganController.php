<?php

namespace App\Http\Controllers;

use App\Models\JenisLapangan;
use App\Models\Lapangan;
use App\Models\Sesi;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Lapangan  $lapangan
     * @return \Illuminate\Http\Response
     */
    public function show(Lapangan $lapangan, $id)
    {
        $lapangan = JenisLapangan::where('id_lapang', $id)->first();
        $list_lapangan = Lapangan::where('id_jenis_lapang', $id)->get();
        $sesi = Sesi::all();
        // dd($list_lapangan);
        return view('lapangan.detail', compact('lapangan', 'list_lapangan', 'sesi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lapangan  $lapangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lapangan $lapangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lapangan  $lapangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lapangan $lapangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lapangan  $lapangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lapangan $lapangan)
    {
        //
    }
}
