<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Building extends Model
{

    protected $table = 'obj_objects';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function dev(): HasOne
    {
        return $this->hasOne(Developer::class, 'type_partner_id', 'developer');
    }
    //
//    public static function inpublic(){
//        return static::where('pub',1)->get();
//    }

    //protected $dateFormat = 'U';
//    const CREATED_AT = 'creation_date';
//    const UPDATED_AT = 'last_update';

    //protected $connection = 'connection-name';

    // ВСТАВКА НОВОЙ ЗАПИСИ
//    $flight = new Flight;
//    $flight->name = $request->name;
//    $flight->save();

    // ИЗМЕНЕНИЕ
    //$flight = App\Flight::find(1);
    //$flight->name = 'New Flight Name';
    //$flight->save();

}
