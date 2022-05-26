<?php

namespace App\Http\Controllers;

use App\Helpers\ThisFavorites;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Crumbs;
use Cookie;

use DB;
//use Illuminate\Support\Facades\Cookie;
//use Illuminate\Support\Facades\Response;

use Torann\LaravelMetaTags\Facades\MetaTag;

class FavController extends Controller
{

    public function add(Request $request)//Request $request
    {
//        return $_POST['id'];
        //return $request->id;
        return ThisFavorites::write();

        //return $request->cookie('favourite');
//        $value = $request->cookie('favourite');
//
//        return $value;

//        $minutes=60;
//
//        $cookie = Cookie('favourite', 'level', $minutes);
//
//        //return response('Hello World')->cookie($cookie);
//        return response('Hello World')->cookie(
//            'name', 'value', $minutes
//        );

    }

    public function clear()
    {
        ThisFavorites::clearAll();
    }

    public function destroy()
    {
        ThisFavorites::destroy();
    }

    public function index(Request $request){//show __invoke $id
        $minutes = 10;
        //Создаем экземпляр ответа
//    $response = new Illuminate\Http\Response('Hello World');
// $response = new \Symfony\Component\HttpFoundation\Response('hello');
//     $response->withCookie(cookie('name', 'value', $minutes));
        //$response = new Response('gerrkkkk');
//        $value = $request->cookie('name');
//        $value = Cookie::get('name');
        //для версии 5.2 и выше:
        //$response->withCookie('name', 'value', $minutes);
        $response = new Response('hello');
        $fav=[];
        if($request->cookie('favourite')){
            if(is_string($request->cookie('favourite'))){
                $fav_arr = json_decode(Cookie::get('favourite'));
               //vd1($fav_arr);
                foreach($fav_arr as $k=>$v){
                    $fav[] = $v;
                }
            }
            else if(is_array($request->cookie('favourite'))){
                $fav_arr = $request->cookie('favourite');
                vd1($request->cookie('favourite'));
            }
           //vd1($fav);
            if (is_array($fav_arr)) {
                $where['id'] = 'id IN (' . implode(',',$fav_arr ) . ')';//
            } else {
//                $where['id'] = 'id = ' . k_q::qv(intval($q['id']));
            }
            vd1( $where['id']);
        }

        //$request->cookie('name');

       // vd1($request->cookie('favourite'));


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
//        if ($favourite) {
//            $query = ThisObject::find(['id' => $favourite, 'page' => (int)$_GET['page']]);
//            $this->v->allFavourite = $query['objects'];
//            $this->v->paginationHtml = $query['pagination'];
//            $this->v->isActive = true;
//        }
        $favs = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select(
                'o.*', 't.type_partner_logo as dev_logo'
            )
            ->where([ ['o.top_sort','!=',0]])
            ->orderBy('o.top_sort', 'asc')->limit(8)->get();


        Crumbs::add('Избранное', '/favourites');
        Crumbs::add('Главная','/');
        MetaTag::set('title', 'Избранное');
        return view('fav.fav', compact('favs'));//compact('dev','dev_objects','builders_bg')
    }
}
