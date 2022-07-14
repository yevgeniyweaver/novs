<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Services\FavService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class FavController extends Controller
{

    public function add()
    {
        FavService::write();
    }

    public function clear()
    {
        FavService::clearAll();
    }

    public function destroy()
    {
        FavService::destroy();
    }

    public function index(Request $request) {

        $object = new Building();
        $objectTable = $object->getTable();

        $favs = [];

        if($request->cookie('favourite')) {
            $fav_arr = [];
            if(is_string($request->cookie('favourite'))) {
                $fav_arr = json_decode(Cookie::get('favourite'));

                foreach($fav_arr as $k=>$v){
                    $fav[] = $v;
                }
            }
            else if (is_array($request->cookie('favourite'))) {
                $fav_arr = $request->cookie('favourite');
            }

            $fav_arr = is_array($fav_arr) ? $fav_arr : [$fav_arr];
            $where['id'] = 'id IN (' . implode(',', $fav_arr ) . ')';

            $favs = $object
                ->leftJoin('type_partner as t', "$objectTable.developer", '=', 't.type_partner_id')
                ->select("$objectTable.*", 't.type_partner_logo as dev_logo')
                ->whereRaw($where['id'])
                ->orderBy("$objectTable.top_sort", 'asc')
                ->limit(8)
                ->get();
        }


        return view('fav.fav', compact('favs'));
    }
}
