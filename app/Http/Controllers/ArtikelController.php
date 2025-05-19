<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::all();
        // dd($artikel);
        return view('admin.artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'judul' => 'required',
            'isi_artikel' => 'required'
        ]);

        // $image = null;
        $image_url = null;
            $path = 'assets/img';
            if ($request->has('image')) {
                $image = $request->file('image')->store($path);
                $image_name = $request->file('image')->getClientOriginalName();
                $image_url = $path . '/' . $image_name;
                Storage::disk('public')->put($image_url, file_get_contents($request->file('image')->getRealPath()));
            } else {
                return redirect()->back()->with('failed', 'Image tidak boleh kosong');
            }


        $artikel = Artikel::create([
            'image' => $image,
            'judul' => $request->judul,
            'isi_artikel' => $request->isi_artikel,
            'status' => 1,
            'upload_by' => auth()->user()->name

        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        //
    }
}
