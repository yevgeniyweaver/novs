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
//        Meta::set('title', 'Private Area');
//        Meta::set('description', 'You shall not pass!');
//        Meta::set('image', asset('images/locked-logo.png'));
        $this->metaService = $metaService;
        $this->newsService = $newsService;
        $this->metaService->setKey('title', 'Все Новострои Одессы');
        $this->metaService->setKey('description', 'Все Новострои Одессы по цене от застройщика, предложения на любой вкус');
        //$this->metaService->setKey('image', asset('img/favicon.ico'));
    }


    public function onmain(BuildingRepo $buildingRepo)
    {
        $req = new Request();
        $find = new FindController($req,3);
        $title = "Main Page";


//        $developer = App\Developer::query();
//        $users = App\User::where('active', 1)->get();
        //$this->gallery = k_treequery::crt('/maingal/')->types(array('image'))->go();
        //->where([ ['status', '=', '1'], ['subscribed', '<>', '1'],])

        $objects = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select(
                'o.*', 't.type_partner_logo as dev_logo'
            )
            ->where([ ['o.top_sort','!=',0]])
            ->orderBy('o.top_sort', 'asc')->limit(8)->get();
        dump($objects);


        $builders = DB::table('type_partner')
            ->whereRaw('type_partner_turn_off!="да"')
            ->select('type_partner_id as id',
                'type_partner_name as name',
                'type_partner_turn_off as turn_off',
                'type_partner_logo as logo')
            ->get();

        $news = $this->newsService->getList();

//        ->simplePaginate(6);
        /* ПОЛНЫЙ JOIN */
//        $users = DB::table('users')
//            ->join('contacts', 'users.id', '=', 'contacts.user_id')
//            ->join('orders', 'users.id', '=', 'orders.user_id')
//            ->select('users.*', 'contacts.phone', 'orders.price')
//            ->get();
//        $this->v->news = K_TreeQuery::crt("/news/")->type('news')->order(array('news' => 'new_date'))->condit(['news'=>' and type_news_new_date < NOW() '])->limitLikeSql(0, 6)->go(array('orderby' => 'DESC'));
//        //$this->v->text = k_treequery::gOne('/texts/main/', 'node');
        $query = $buildingRepo->find(['map_geo' => true]);

        $getCountByPartners = $buildingRepo->getCountByPartner();

        $map = $query['objects'];
        $mapAllObjects = ThisObject::createMapObject($map);
//        $this->v->builders = K_TreeQuery::crt('/builders/')->type('partner')->go();
//        $objects = Object::where(['not_active'=>0])
//            ->orderBy('new', 'desc')
//            ->take(20)
//            ->get();

        $builders = DB::table('type_partner')->whereRaw('type_partner_turn_off !="да"')
            ->select('type_partner_id as id',
                'type_partner_name as name',
                'type_partner_turn_off as turn_off',
                'type_partner_logo as logo')->get();

        $builders = $builders->toArray();
        foreach ($builders as $builder) {
                //self::$builders[$builder->id] = $builder;
            $b[] = json_decode(json_encode($builder), true);
        }
        //$builders = collect($builders);
        //$builders = $builders->all()->toArray();
        //$builders = $builders->toArray();
        //$user = DB::table('users')->where('name', 'John')->first();
        //$email = DB::table('users')->where('name', 'John')->value('email');
        //Массив значений одного столбца
//        $titles = DB::table('roles')->pluck('title');
        //$roles = DB::table('roles')->pluck('title', 'name');
//        foreach ($titles as $title) {         echo $title;     }
//        $users = DB::table('users')->count();
//        $price = DB::table('orders')->max('price');
        //$users = DB::table('users')->distinct()->get();

        //Добавить столбец выборки
//        $query = DB::table('users')->select('name');
//        $users = $query->addSelect('age')->get();
        ///$news = App\Link::all();
        return view('onmain.onmain', compact('objects','builders','news', 'mapAllObjects', 'getCountByPartners') );
    }


    public function news(){
    //    $news = DB::table('news')->get();
        $news = DB::table('type_news as news')
            ->leftJoin('tree', 'news.type_news_id', '=', 'tree.tree_id')
            ->select('news.type_news_id as id',
                'news.type_news_new_date as new_date',
                'news.type_news_image as image',
                'news.type_news_content as content',
                'news.type_news_header1 as header1',
                'tree.tree_name as name'
            )//->get();
            ->paginate(10);

        return view('news.news', compact('news') );
    }

    public function sdanie(){

        $url = Route::currentRouteName();
        $sdanie = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->where([ ['o.complite','=',1],['t.type_partner_turn_off','!=','да']])
            ->orderBy('o.top_sort', 'asc')->paginate(20); //->get();

        $meta = DB::table('tree as t')
            ->select('t.tree_meta_title as title', 't.tree_meta_description as description','t.tree_meta_keywords as keywords')
            ->where([ ['t.tree_type','=','page'],['t.tree_name','=',$url]])
            ->first(); //->get();

        MetaTag::set('title', $meta->title);
        MetaTag::set('description', $meta->description);
        MetaTag::set('keywords', $meta->keywords);
        MetaTag::set('image', asset('images/locked-logo.png'));
        return view('onmain.sdanie', compact('sdanie') );
    }

    public function novie(){

        $url = Route::currentRouteName();
        $novie = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->where([ ['o.new','=',1],['t.type_partner_turn_off','!=','да']])
            ->orderBy('o.top_sort', 'asc')->paginate(20); //->get();
        $meta = DB::table('tree as t')
            ->select('t.tree_meta_title as title', 't.tree_meta_description as description','t.tree_meta_keywords as keywords')
            ->where([ ['t.tree_type','=','page'],['t.tree_name','=',$url]])
            ->first(); //->get();

        MetaTag::set('title', $meta->title);
        MetaTag::set('description', $meta->description);
        MetaTag::set('keywords', $meta->keywords);
        MetaTag::set('image', asset('images/locked-logo.png'));

        return view('onmain.novie', compact('novie') );
    }

    public function rayons($rayon){
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
