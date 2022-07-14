<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DeveloperController extends Controller
{

    public function index(string $developer) {

        $dev = DB::table('type_partner as d')
            ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
            ->whereRaw('d.type_partner_turn_off!="да" AND t.tree_name="' . $developer.'"')
            ->select('d.*',
                't.*',
                'd.type_partner_id as id',
                'd.type_partner_name as name',
                'd.type_partner_turn_off as turn_off',
                't.tree_name',
                'd.type_partner_builders_bg as builders_bg',
                'd.type_partner_logo as logo')
            ->first();

        $dev = json_decode(json_encode($dev), true);

        $builders_bg = 'http://novostroika.od.ua/upload/' . $dev['builders_bg'];

        $dev_objects = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->whereRaw('o.developer='.$dev['id'])
            ->limit(4)
            ->get();

        return view('object.developer', compact('dev','dev_objects','builders_bg'));
    }
}
