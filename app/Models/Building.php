<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Building extends Model
{

    protected string $table = 'obj_objects';

    public function dev(): HasOne
    {
        return $this->hasOne(Developer::class, 'type_partner_id', 'developer');
    }

//    public static function inpublic() {
//        return static::where('pub', 1)->get();
//    }

}
