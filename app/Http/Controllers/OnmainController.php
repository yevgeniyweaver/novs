<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAge;
use App\Repository\BuildingRepo;
use Meta;
use Illuminate\Http\Request;
use App;
use App\Helpers\ThisObject;
use Illuminate\Support\Facades\DB;
use App\Services\MetaService;
use App\Services\NewsService;


class OnmainController extends Controller
{
    protected MetaService $metaService;
    protected NewsService $newsService;

    public function __construct(MetaService $metaService, NewsService $newsService)
    {
        $this->metaService = $metaService;
        $this->newsService = $newsService;
        $this->metaService->setKey('title', 'Все Новострои Одессы');
        $this->metaService->setKey('description', 'Все Новострои Одессы по цене от застройщика, предложения на любой вкус');
        //$this->metaService->setKey('image', asset('img/favicon.ico'));
    }


    public function onmain(BuildingRepo $buildingRepo)
    {
        $news = $this->newsService->getList();

        $getCountByPartners = $buildingRepo->getCountByPartner();

        $objects = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select(
                'o.*', 't.type_partner_logo as dev_logo'
            )
            ->where([ ['o.top_sort','!=',0]])
            ->orderBy('o.top_sort', 'asc')->limit(8)->get();


        $builders = DB::table('type_partner')
            ->whereRaw('type_partner_turn_off!="да"')
            ->select('type_partner_id as id',
                'type_partner_name as name',
                'type_partner_turn_off as turn_off',
                'type_partner_logo as logo')
            ->get();

        $query = $buildingRepo->find(['map_geo' => true]);



        $map = $query['objects'];
        $mapAllObjects = ThisObject::createMapObject($map);

        $builders = DB::table('type_partner')->whereRaw('type_partner_turn_off !="да"')
            ->select('type_partner_id as id',
                'type_partner_name as name',
                'type_partner_turn_off as turn_off',
                'type_partner_logo as logo')->get();

        return view('onmain.onmain', compact('objects','builders','news', 'mapAllObjects', 'getCountByPartners') );
    }


    public function news() {

        $news = DB::table('type_news as news')
            ->leftJoin('tree', 'news.type_news_id', '=', 'tree.tree_id')
            ->select('news.type_news_id as id',
                'news.type_news_new_date as new_date',
                'news.type_news_image as image',
                'news.type_news_content as content',
                'news.type_news_header1 as header1',
                'tree.tree_name as name'
            )
            ->paginate(10);

        return view('news.news', compact('news') );
    }

    public function sdanie() {

        $url = Route::currentRouteName();
        $sdanie = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->where([ ['o.complite','=',1],['t.type_partner_turn_off','!=','да']])
            ->orderBy('o.top_sort', 'asc')
            ->paginate(20);

        $meta = DB::table('tree as t')
            ->select('t.tree_meta_title as title', 't.tree_meta_description as description','t.tree_meta_keywords as keywords')
            ->where([ ['t.tree_type','=','page'],['t.tree_name','=', $url]])
            ->first();

        return view('onmain.sdanie', compact('sdanie') );
    }

    public function novie(){

        $url = Route::currentRouteName();
        $novie = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->where([ ['o.new','=',1],['t.type_partner_turn_off','!=','да']])
            ->orderBy('o.top_sort', 'asc')
            ->paginate(20);

        $meta = DB::table('tree as t')
            ->select('t.tree_meta_title as title', 't.tree_meta_description as description','t.tree_meta_keywords as keywords')
            ->where([ ['t.tree_type','=','page'],['t.tree_name','=', $url]])
            ->first();

        return view('onmain.novie', compact('novie') );
    }

    public function rayons($rayon)
    {

        if(!empty($rayon)){
            $rayons_obj = DB::table('obj_objects as o')
                ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
                ->leftJoin('tree as tr', 'o.region', '=', 'tr.tree_title')
                ->select('o.*','tr.tree_title','tr.tree_name','t.type_partner_logo as dev_logo')
                ->distinct()
                ->where([ ['tr.tree_name','=',$rayon],['t.type_partner_turn_off','!=','да']])
                ->orderBy('o.orient', 'asc')->paginate(20); //->get();//->get();
        }
//        $rayon = DB::table('obj_objects as o')
//            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
//            ->select('o.*', 't.type_partner_logo as dev_logo')
//            ->where([ ['o.new','=',1],['t.type_partner_turn_off','!=','да']])
//            ->orderBy('o.top_sort', 'asc')->paginate(20); //->get();
        //vd1($objects);

        return view('onmain.rayon', compact('rayons_obj') );
    }
}
