<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 't_sewa';

    protected $fillable = [
        'id',
        'id_user',
        'nama_penyewa',
        'no_hp',
        'dp',
        'tgl_dp',
        'total_harga',
        'diskon',
        'sisa_bayar',
        'status_bayar',
        'status_approval',
        'approved_by',
        'updated_by',

    ];

    public $incrementing = false;

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'id_booking');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi');
    }

    public static function get_all ()
    {
        $data = Order::all();

        return $data;
    }

    public static function get_by_id ($id)
    {
        $data = Order::where('id_user', $id)->get();
        // dd($data);

        return $data;
    }

    public static function get_by_id_detail ($id)
    {
        $data = static::with(['orderDetail', 'lapangan', 'sesi'])
            ->where('id', $id)
            ->get();

        return $data[0];
    }

    public static function get_order_with_detail () {
        $data = static::with('orderDetail')
                ->where('status_approval', 1)
                ->get();

        return $data;
    }
    
}
