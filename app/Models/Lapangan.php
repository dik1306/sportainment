<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'm_lapangan';

    public static function get_lapangan ($id)
    {
        $data = Lapangan::whereIn('id', array($id))->get();

        return $data;
    }

    public static function get_lapangan_by_id ($id)
    {
        $data = Lapangan::where('id', $id)->first();

        return $data;
    }
}
