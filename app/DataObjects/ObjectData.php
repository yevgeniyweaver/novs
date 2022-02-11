<?php
namespace App\DataObjects;

use Carbon\Carbon;



class ObjectData extends \Spatie\DataTransferObject\DataTransferObject

{

    public static function generateCarbonObject(?string $date): ?Carbon

    {

        if (!$date) {

            return null;

        }

        return \Illuminate\Support\Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $date);

    }

}
