<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 't_artikel';

    public static function get_all () 
    {
        $data = Artikel::all();

        return $data;
    }

}
