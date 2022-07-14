<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'type_news';

    public static function inpublic(){
        return static::where('pub', 1)->get();
    }
}
