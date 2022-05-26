<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: женя
 * Date: 19.06.2020
 * Time: 17:09
 */
class ThisBuilder
{
    static private $builders = array();

    public static function getAll()
    {
        if (empty(self::$builders)) {

//            $builders = \App\Developer::all();
//            $builders = K_Tree::getTreeBranch('/builders/', true);
            $builders = DB::table('type_partner as d')
                ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
                ->whereRaw('d.type_partner_turn_off!="да"')
                ->select('d.type_partner_id as id',
                    'd.type_partner_name as name',
                    'd.type_partner_turn_off as turn_off',
                    't.tree_name',
                    'd.type_partner_logo as logo')->get();
            $builders = $builders->toArray();
            foreach ($builders as $builder) {
                self::$builders[$builder->id] = json_decode(json_encode($builder), true);//$builder
            }
        }
        return self::$builders;
    }
}
