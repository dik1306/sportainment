<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'm_diskon';

    public static function get_diskon ($kode_diskon)
    {
        $data = Diskon::where('kode_diskon', $kode_diskon)->first();

        return $data;
    }
    
}
