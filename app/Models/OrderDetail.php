<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 't_sewa_detail';

    protected $fillable = [
        'id_booking',
        'id_lapangan',
        'id_sesi',
        'tgl_mulai',
        'tgl_selesai',
        'jam_mulai',
        'jam_selesai',
        'total_harga_sewa',
        'status_approval'
    ];
    public $incrementing = false;


    public function order()
    {
        return $this->belongsTo(Order::class, 'id_booking');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi');
    }

    public static function get_all_order_detail()
    {
        $data = static::with(['lapangan', 'sesi', 'order'])->get();

        return $data;
    }

    public static function get_detail_order_by_id($id)
    {
        $data = static::with([ 'lapangan', 'sesi', 'order'])
            ->where('id_booking', $id)
            ->get();

        return $data;
    }

    public static function jadwal_per_hari($tgl)
    {
        $data = static::with(['lapangan', 'sesi', 'order'])
            ->where('tgl_mulai', $tgl)
            ->get();

        return $data;
    }


}
