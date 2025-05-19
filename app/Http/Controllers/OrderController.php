<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Sesi;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $order = Order::get_by_id($id);
        // dd($order);
        return view('order', compact('order'));
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
        
        $order = $request->all();
        

        $id_booking = 'SRA' . date('Ymd') . mt_rand(100, 999);
        $user = auth()->user();
        $fix_total = $order['fix_total'];
        $diskon = $order['fix_diskon'];
        $total_show = number_format($fix_total - $diskon);
        $dp = number_format(30/100 * $fix_total);
        $order = json_decode($order['data'], true);

        if ($user->no_hp == null || $user->no_hp == '') {
            return redirect()->route('profile')->with('error', 'Silahkan isi No HP yang terhubung dengan Whatsapp terlebih dahulu');
        }


        $order_create = Order::create([
            'id' => $id_booking,
            'id_user' => $user->id,
            'nama_penyewa' => $user->name,
            'no_hp' => $user->no_hp,
            'dp' => 0,
            'tgl_dp' => date('Y-m-d'),
            'total_harga' => $fix_total,
            'diskon' => $diskon,
            'sisa_bayar' => $fix_total - $diskon,
            'status_bayar' => 0,
            'status_approval' => 1
        ]);

        //kirim api ke sipa_t_sewa_master
        $send_api = $this->send_api_booking_master($id_booking, $user->name, $user->no_hp, $fix_total,1,0);


        foreach ($order as $item) {
            $order_detail = OrderDetail::create([
                $sesi = $item['id_sesi'],
                $id_sesi = Sesi::where('sesi', $sesi)->first(),
                $jam_mulai = $id_sesi->jam_mulai,
                $jam_selesai = $id_sesi->jam_selesai,
                $id_lapangan = $item['id_lapang'],
                $lapangan = Lapangan::where('id', $id_lapangan)->first(),
                $nama_lapangan = $lapangan->nama,
                $tgl_mulai =  $item['tanggal'],
                $tgl_selesai =  $item['tanggal'],

                'id_booking' => $id_booking,
                'id_lapangan' => $id_lapangan,
                'id_sesi' => $sesi,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'total_harga_sewa' => $item['price'],
                'status_approval' => 1
            ]);

            //kirim api ke sipa_t_sewa
            $send_api_detail = $this->send_data_booking_detail($id_booking,$item['price'], $jam_mulai, $jam_selesai, $tgl_mulai, $tgl_selesai, $id_lapangan);
        }

        $message = "Terimakasih $user->name telah melakukan pemesanan di Area Sportainment. Berikut detailnya:

    - Nama Penyewa: $user->name
    - ID Order : $id_booking
    - Hari, Tanggal : $order_detail->tgl_mulai
    - Jam Mulai : $jam_mulai
    - Jam Selesai : $order_detail->jam_selesai
    - Jenis Lapangan: $nama_lapangan
        
    Total Biaya Sewa = *Rp. $total_show,-*
    DP 30% = Rp. $dp,-
        
    Silahkan lakukan pembayaran sewa melalui rekening :
    Bank Syariah Indonesia (BSI) 
    7700700237 
    A.n *SMP QLP Rabbani Bandung*
        
    Note: Booking DP minimal 30% dari total sewa dan akan di masukkan ke jadwal apabila sudah melakukan pembayaran dengan mengirimkan foto bukti transfer.";

        //kirim wa notif
        $send_notif = $this->send_notif($user->no_hp, $message);

        if ($send_notif) {
            return redirect()->route('order.index')->with('success', 'Booking berhasil');
        }

    }

    public function detail($id)
    {
        // $order_detail = Order::get_by_id_detail($id);
        $order_detail = OrderDetail::get_detail_order_by_id($id);

        // dd($order_detail);
       
        return $order_detail;
    }

    public function get_order_detail_all () {
        $order_detail = OrderDetail::get_all_order_detail();
        // dd($order_detail);

        return $order_detail;
    }

    public function get_jadwal_per_hari($tgl) {
        $jadwal = OrderDetail::jadwal_per_hari($tgl);
        // dd($jadwal);        
        
        return $jadwal;

    }

    function send_notif ($no_wha, $message) {
        $dataSending = array();
        $dataSending["api_key"] = "VDSVRW87NW812KD7";
        $dataSending["number_key"] = "EP9028RqdDXPhPix";
        $dataSending["phone_no"] = $no_wha;
        $dataSending["message"] = $message;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataSending),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

    }

    function send_api_booking_master($id,$nama_penyewa,$no_hp,$total_harga,$status_approval,$status_bayar){
	    $curl = curl_init();
	    $url = "http://103.135.214.11:81/qlp_system/api_sipa/simpan_booking.php";

	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($load_data) );
		curl_setopt($curl, CURLOPT_POSTFIELDS, "id=".$id."&nama_penyewa=".$nama_penyewa."&no_hp=".$no_hp."&total_harga=".$total_harga."&status_approval=".$status_approval."&status_bayar=".$status_bayar);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	    $result = curl_exec($curl);
	    curl_close($curl);

	    // echo "<pre>";
	    // return ($result);
	}

    function send_data_booking_detail($id, $total_harga, $jam_mulai, $jam_selesai, $tgl_mulai, $tgl_selesai, $id_lapangan){
	    $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.135.214.11:81/qlp_system/api_sipa/simpan_booking_detail.php',
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  // CURLOPT_SSL_VERIFYPEER => false,
		  // CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_POSTFIELDS => array(
		  	'id' => $id,
		  	'total_harga' => $total_harga,
		  	'jam_mulai' => $jam_mulai,
			'jam_selesai' => $jam_selesai,
			'tgl_mulai' => $tgl_mulai,
			'tgl_selesai' => $tgl_selesai,
			'id_lapangan' => $id_lapangan)

		));

		$response = curl_exec($curl);

		// echo $response;
		curl_close($curl);
	    // return ($response);
	}


}
