<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Services\FavService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Crumbs;
use Illuminate\Support\Facades\Redis;

class FavController extends Controller
{

    public function add()
    {
        FavService::write();
//        $value = $request->cookie('favourite');
//        return $value;
//        $minutes = 60;
//        $cookie = Cookie('favourite', 'level', $minutes);
//        //return response('Hello World')->cookie($cookie);
//        return response('Hello World')->cookie(
//            'name', 'value', $minutes
//        );
    }

    public function clear()
    {
        FavService::clearAll();
    }

    public function destroy()
    {
        FavService::destroy();
    }

    public function index(Request $request) {//show __invoke $id
        $object = new Building();
        $objectTable = $object->getTable();
        $minutes = 10;

        //Redis::set('one', 'redia one');
//        dump(Redis::get('one'));
//        Redis::lpush('names', 1,2,3,4);
//        dump(Redis::lrange('names', 0, -1));
//        dump(Cache::get('fav'));
//        dump(Cache::get('qqq'));
//        Cache::put('fav', 'cache 11113333');
//        Cache::put('qqq', 'cache qqq value');


//     $response->withCookie(cookie('name', 'value', $minutes));
        //$response = new Response('gerrkkkk');
//        $value = $request->cookie('name');
//        $value = Cookie::get('name');
        //$response->withCookie('name', 'value', $minutes);
        $favs = [];
        //vd1($request->cookie('favourite'));
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

            dump($where['id']);

            $favs = $object
                ->leftJoin('type_partner as t', "$objectTable.developer", '=', 't.type_partner_id')
                ->select("$objectTable.*", 't.type_partner_logo as dev_logo')
                ->whereRaw($where['id'])
                ->orderBy("$objectTable.top_sort", 'asc')->limit(8)->get();
        }

        //$request->cookie('name');
        //vd1($request->cookie('favourite'));
        //return response('Hello World')->cookie($cookie);
//        $dev = DB::table('type_partner as d')
//            ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
//            ->whereRaw('d.type_partner_turn_off!="да" AND t.tree_name="'.$developer.'"')
//            ->select('d.*',
//                't.*',
//                'd.type_partner_id as id',
//                'd.type_partner_name as name',
//                'd.type_partner_turn_off as turn_off',
//                't.tree_name',
//                'd.type_partner_builders_bg as builders_bg',
//                'd.type_partner_logo as logo')->first();
//        $dev = json_decode(json_encode($dev), true);//$builder
//
//        $builders = $dev;
//        $builders_bg = 'http://novostroika.od.ua/upload/'.$dev['builders_bg'];
//
//        $dev_objects = DB::table('obj_objects as o')
//            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
//            ->select('o.*', 't.type_partner_logo as dev_logo')
//            ->whereRaw('o.developer='.$dev['id'])->limit(4)->get();
//
//        if($developer){
//            K_Crumbs::add($builder, '/');
//        }
//        $favourite = unserialize($_COOKIE['favourite']);


        Crumbs::add('Избранное', '/favourites');
        Crumbs::add('Главная','/');

        return view('fav.fav', compact('favs'));//compact('dev','dev_objects','builders_bg')
    }
}
