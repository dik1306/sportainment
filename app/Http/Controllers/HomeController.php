<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Diskon;
use App\Models\JenisLapangan;
use App\Models\Lapangan;
use App\Models\OrderDetail;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $artikel_show = Artikel::all();
        $list_lapangan = Lapangan::all();
        $sesi = Sesi::all();
        $jenis_lapangan = JenisLapangan::all();
        // $jadwal = OrderDetail::where('tgl_mulai', '2024-04-28')->get();
        // dd($jadwal);        
        // dd($order_detail);        


        return view('index', compact('artikel_show', 'list_lapangan', 'sesi', 'jenis_lapangan'));
    }

    public function generate_id_booking() {
        $today = date('Ymd');
        
        $id = 'SRA' . $today . mt_rand(100, 999);

        return $id;

    }

    // public function addToCart ($id_lapang, $id_sesi){
    //     $lapangan = Lapangan::find($id_lapang);
    //     $sesi = Sesi::find($id_sesi);
    //     // dd($lapangan, $sesi);

    //     $cart = session()->get('cart', []);
    //     // dd($cart);

    //     if (isset($cart[$id_lapang])) {
    //         $cart[$id_lapang];
    //     } else {
    //         $cart[$id_lapang] = [
    //             'id' => $lapangan->id,
    //             'nama' => $lapangan->nama,
    //             'weekday_1' => $lapangan->harga_weekday_perjam_1,
    //             'weekday_2' => $lapangan->harga_weekday_perjam_2,
    //             'weekend_1' => $lapangan->harga_weekend_perjam_1,
    //             'weekend_2' => $lapangan->harga_weekend_perjam_2,
    //             'sesi' => $sesi->sesi,
    //             'jam_mulai' => $sesi->jam_mulai,
    //             'jam_selesai' => $sesi->jam_selesai,
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     // dd(session()->get('cart'));
    //     return redirect()->back()->with('success', 'Lapangan berhasil ditambahkan');
    // }

    public function removeFromCart(Request $request) {
        $id_lapang = $request->id_lapang;
        $cart = session()->get('cart');

        if (isset($cart[$id_lapang])) {
            unset($cart[$id_lapang]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
       
    }

    public function checkout (Request $request) {

        
        $data = $request->cart;
 
        // return $data;
        $data = json_decode($data, true);
        
        return view('cart', compact('data'));
        
    }

    public function cart (Request $request) {
        
        return view('cart');
        
    }

    public function remove_cart(Request $request, $id) {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function all_sesi() {
        $sesi = Sesi::all();
        return $sesi;
    }

    
}
