<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
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
        $diskon = Diskon::where('kode_diskon', $request->diskon)
        ->select('kode_diskon', 'persentase', 'maks_potongan', 'limit')
        ->first();

        // dd($diskon);
        if(!$diskon) {
            return redirect()->back()->with('error', 'Kode diskon tidak ditemukan');
        } 

        session()->put('diskon', [
            'kode_diskon' => $diskon->kode_diskon,
            'persentase' => $diskon->persentase,
            'maks_potongan' => $diskon->maks_potongan,
            'limit' => $diskon->limit,
        ]);

        return view('cart', compact('diskon'));

        // return redirect()->back()->with('success', 'Kode diskon berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $diskon = $_GET['diskon'];

        $checkdiskon = Diskon::where('kode_diskon', $diskon)
        ->select('kode_diskon', 'persentase', 'maks_potongan', 'limit')
        ->first();

        // dd($diskon);
        if(!$checkdiskon) {
            return 'Kode diskon tidak ditemukan';
        }
        return $checkdiskon;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function edit(Diskon $diskon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diskon $diskon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diskon $diskon)
    {
        //
    }
}
