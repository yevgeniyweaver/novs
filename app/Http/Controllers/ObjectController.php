<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Crumbs;

trait Price {
    public function makePrice(){
        //echo $this->price;
        $input = file_get_contents("http://kooperativ-prostranstvo.novostroika.od.ua/zhk-prostranstvonaradostnoy.html");
        return $input;
    }
}
class ObjectController extends Controller
{
    use Price;
    protected $price;
    public function __construct()
    {
        $this->price = 1000;
    }


    public function index($developer, $jk){//show __invoke $id

//        $input = file_get_contents("http://kooperativ-prostranstvo.novostroika.od.ua/zhk-prostranstvonaradostnoy.html");
       // vd1( $GLOBALS);

        $jk_url = $jk.'.html';


        $object = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select(
                'o.*', 't.type_partner_logo as dev_logo'
            )
            ->where([ ['o.url','=', $jk_url]])
            ->orderBy('o.top_sort', 'asc')->first();

        $e = json_decode(json_encode($object), true);//$builder

        $builder = DB::table('type_partner as d')
            ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
            ->whereRaw('d.type_partner_turn_off!="да" AND d.type_partner_id='.$object->developer)
            ->select('d.type_partner_id as id',
                'd.type_partner_name as name',
                'd.type_partner_color as color',
                'd.type_partner_turn_off as turn_off',
                't.tree_name',
                'd.type_partner_logo as logo')->first();
        $dev = json_decode(json_encode($builder), true);//$builder

        if($e['price_cur']==2){ $e['price_cur_word'] = 'грн'; }else{ $e['price_cur_word'] = '$'; }

        $point = [];
        $point['id'] = $e['id'];
        $point['orient'] = $e['orient'];
        $point['map_lat'] = $e['map_lat'];
        $point['map_lng'] = $e['map_lng'];
        $mapPoint = json_encode([$point]);
        //vd1($mapPoint);
        //vd1($developer);

//        $builders = DB::table('type_partner as d')
//            ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
//            ->whereRaw('d.type_partner_turn_off!="да" AND t.tree_name="'.$developer.'"')
//            ->select('d.type_partner_id as id',
//                'd.type_partner_name as name',
//                'd.type_partner_turn_off as turn_off',
//                't.tree_name',
//                'd.type_partner_logo as logo')->first();

//        $jkId = htmlspecialchars($jk['id']);
//        $developerId = htmlspecialchars($developer['tree_id']);

//        if($this->v->jk['date_price_update'] !='0000-00-00 00:00:00'){
//            $this->v->updatePrice = K_Date::dateParse($this->v->jk['date_price_update']);
//            $this->v->updatePrice = $this->v->updatePrice['d'].' '.K_Date::ruMonthWord($this->v->updatePrice['m']);
////            vd1($this->v->updatePrice['d'].' '.K_Date::ruMonthWord($this->v->updatePrice['m']));
//        }
//
//
        $jk_plans = json_decode($e['plans'],true);

//        if(strripos($jk_plans[0]['price_all'], 'грн')){
//            $e['priceCurrency'] = 'UAH';
//        }else{
//            $e['priceCurrency'] = 'USD';
//        }

        if(!empty($jk_plans)){
            $e['lowPlan'] = preg_replace('~\D+~', '', $jk_plans[0]['price_all']);
            $e['highPlan'] = preg_replace('~\D+~', '', end($jk_plans)['price_all'] );
            $e['lowPrice'] = str_replace ( '$', '', $e['lowPlan'] );
            $e['highPrice'] = str_replace ( '$', '', $e['highPlan'] );
        }

        $optionsProfi = DB::table('Комплексы as kom')
            ->select('kom.*',
                'cl.Наименование as nov_class',
                'kr.Наименование as constructive',
                'w.Наименование as nov_windows',
                'so.Наименование as nov_boiler',
                'sf.Наименование as nov_flat_health',
                'im.Наименование as inner_walls',
                'vo.Наименование as interior_facing')
            ->leftJoin('НовКласс as cl', 'kom.class', '=', 'cl.Код')
            ->leftJoin('НовКонструктивноеРешение as kr', 'kom.foundation', '=', 'kr.Код')
            ->leftJoin('НовОкна as w', 'kom.windows', '=', 'w.Код')
            ->leftJoin('НовСистемаОтопления as so', 'so.Код', '=', 'kom.heating_system')
            ->leftJoin('НовСостояниеКвартир as sf', 'sf.Код', '=', 'kom.flat_helth')
            ->leftJoin('НовВнутренняяОтделка as vo', 'vo.Код', '=', 'kom.interior_finish')
            ->leftJoin('НовМатериалВнутреннихСтен as im', 'im.Код', '=', 'kom.inner_material')
            ->whereRaw('kom.Код='.$e['jk_num_1c'])
            ->first();

         $optionsProfi = json_decode(json_encode($optionsProfi), true);//$builder
//
//            $optionsProfi = k_q::row("SELECT kom.*, cl.Наименование nov_class, kr.Наименование constructive, w.Наименование nov_windows, so.Наименование nov_boiler, sf.Наименование nov_flat_health, im.Наименование inner_walls, vo.Наименование interior_facing FROM `Комплексы` kom
//										LEFT JOIN НовКласс cl ON cl.Код = kom.class
//										LEFT JOIN НовКонструктивноеРешение kr ON kr.Код = kom.foundation
//                                        LEFT JOIN НовОкна w ON w.Код = kom.windows
//                                        LEFT JOIN НовСистемаОтопления so ON so.Код = kom.heating_system
//                       					LEFT JOIN НовСостояниеКвартир sf ON sf.Код = kom.flat_helth
//                       					LEFT JOIN НовВнутренняяОтделка vo ON vo.Код = kom.interior_finish
//                                        LEFT JOIN НовМатериалВнутреннихСтен im ON im.Код = kom.inner_material
//                                        WHERE kom.Код=".$e['jk_num_1c']);

//            $global =array();
//            //'options_build_end'=>date('d.m.Y',strtotime($optionsProfi['end_building_date'])),'options_floors'=> $optionsProfi['floors'],'options_constructive'=> $optionsProfi['constructive'],'options_thermal_insulation'=> $optionsProfi['thermal_insulation'],'options_inner_walls'=>$optionsProfi['inner_walls'],
//            if($optionsProfi['start_building_date'] !='0000-00-00 00:00:00'){
//                $global['options_build_start_1'] = $optionsProfi['start_kvartal']." ".$optionsProfi['start_building_date'];
//            }
//            if($optionsProfi['end_building_date'] !='0000-00-00 00:00:00'){
//                $global['options_build_end_1'] = $optionsProfi['end_kvartal']." ".$optionsProfi['end_building_date'];
//            }
//            if(!empty($optionsProfi['floors'])) $global['options_floors']=$optionsProfi['floors'];
//            if(!empty($optionsProfi['constructive'])) $global['options_constructive']=$optionsProfi['constructive'];
//            if(!empty($optionsProfi['thermal_insulation'])) $global['options_thermal_insulation']=$optionsProfi['thermal_insulation'];
//            if(!empty($optionsProfi['inner_walls'])) $global['options_inner_walls']=$optionsProfi['inner_walls'];
//
//            $engineering =array();
//            //'options_interior_facing'=>$optionsProfi['interior_facing'], 'options_windows'=>$optionsProfi['nov_windows'], 'options_boiler_room'=>$optionsProfi['nov_boiler'], 'options_roof'=>$optionsProfi['roof'], 'options_height'=>$optionsProfi['room_height'],
//            if(!empty($optionsProfi['interior_facing'])) $engineering['options_interior_facing']=$optionsProfi['interior_facing'];
//            if(!empty($optionsProfi['nov_windows'])) $engineering['options_windows']=$optionsProfi['nov_windows'];
//            if(!empty($optionsProfi['nov_boiler'])) $engineering['options_boiler_room']=$optionsProfi['nov_boiler'];
//            if(!empty($optionsProfi['roof'])) $engineering['options_roof']=$optionsProfi['roof'];
//            if(!empty($optionsProfi['room_height'])) $engineering['options_height']=$optionsProfi['room_height'];
//
//            $insideparams =array();
//            //'options_lift'=>$optionsProfi['lift'], 'options_parking'=>$optionsProfi['parking'], 'options_security'=>$optionsProfi['security'],
//            if(!empty($optionsProfi['lift'])) $insideparams['options_lift']=$optionsProfi['lift'];
//            if(!empty($optionsProfi['parking'])) $insideparams['options_parking']=$optionsProfi['parking'];
//            if(!empty($optionsProfi['security'])) $insideparams['options_security']=$optionsProfi['security'];
//
//            $this->v->options['global'] = $global;
//            $this->v->options['engineering'] =$engineering;
//            $this->v->options['insideparams'] = $insideparams;
//        }
//
//
//        // $this->v->options = json_decode($this->v->jk['options'],true);
//
        $jk_build_status = json_decode($e['build_status'],true);
//
//        $objects = [];
//        $objects['id'] = $e['id'];
//        $objects['orient'] = $e['orient'];
//        $objects['map_lat'] = $e['map_lat'];
//        $objects['map_lng'] = $e['map_lng'];
////        vd1(explode('-',$e['action_date']));
//        if($e['city'] == 'г.Одесса'){
//            $branchArray = [
//                'Суворовский' => '%suvorovkiy%',
//                'Приморский' => '%primorskiy%',
//                'Киевский' => '%kievskiy%',
//                'Малиновский' => '%malinovskiy%',
//                'Центр' => '%primorskiy%',
//                'Слободка' => '%malinovskiy%'
//            ];
//            $whereBranch = 'raion LIKE ';
//            $branch = $branchArray[trim($e['region'])];
//            if($e['region'] != 'Киевский' && $e['region'] != 'Овидиопольский') {
//                $whereBranch .= "'" . $branch . "'";
////                vd1($branch);
//            }else if($e['region'] == 'Овидиопольский'){
//                $whereBranch = 'city LIKE "%г.Черноморск%"';
//            }else{
//                $whereBranch.= "'".$branch."'";
//                $select2 = " UNION select * from obj_branches where raion LIKE '%illichovsk%'";
//            }
//        }else if($e['city'] == 'Авангард'){
////            $whereBranch = 'city="пгт.Авангард"';
//            $whereBranch = 'raion LIKE "%kievskiy%"';
//            $select2 = " UNION select * from obj_branches where raion LIKE '%malinovskiy%'";
//        }else if($e['city'] == 'г.Черноморск'){
//            $whereBranch = 'city LIKE "%г.Черноморск%"';
//        }else{
//            $whereBranch = 'raion LIKE "%kievskiy%"';
//            $select2 = " UNION select * from obj_branches where raion LIKE '%illichovsk%'";
//        }
//
//
//
////        vd1("select * from obj_branches where $whereBranch  $select2");
//
//        $this->v->branches = k_q::data("select * from obj_branches where $whereBranch  $select2");

//        // добавочка для Приморского и малиновского районов 704-45-67
//
//        if(in_array($e['region'],['Приморский','Малиновский'])) {
//            $this->v->branches[] = array(
//                'phone' => '+38(048) 704-45-67',
//                'address' => 'ул.Среднефонтанская 35'
//            );
//        }

//
//        $this->v->mapObjects = json_encode([$objects]);
//        $this->v->rec = k_Q::data("SELECT * FROM `obj_objects` WHERE developer = '$developerId' AND not id='$jkId' limit 4 ");
//        $this->v->action = k_Q::data("SELECT * FROM `obj_objects` WHERE developer = '$developerId' AND action=1 AND not id='$jkId' limit 3 ");
//        $this->v->actionCount = count($this->v->action);

//        $objects = DB::table('obj_objects as o')
//            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
//            ->select('o.*', 't.type_partner_logo as dev_logo')
//            ->where([ ['o.top_sort','!=',0]])
//            ->orderBy('o.top_sort', 'asc')->limit(8)->get();

        $recomended = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->whereRaw('o.developer='.$object->developer)->limit(4)->get();
        $action = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->whereRaw('o.developer='.$object->developer. ' AND o.action=1 AND not id='.$e['id'])
            ->limit(4)->get();

        $actionCount = $action->count();

//        //вытягиваем фото из массива всего объекта//
        $photoArray = array_filter(explode(",", $e['photos_nums']));
        foreach ($photoArray as $v) {
            $jk_slides[] = 'b' . $e['id'] . '_' . $v;
        }
//        //вытягиваем информацию об площади и цене квартир//
//        $roominfo = json_decode($e['appart'], true);
//        $this->v->room = $roominfo;
//        ///////  вытягиваем инфу об описании объекта////////
        $object_desc = ($e['descr']);

        //вытягиваем координаты обьектов для показа на карте//
        /*
        $keywords = preg_split("/[\s,]+/", $cash );
        */
        //вытягиваем планировки из массива всего объекта//

        //$plansArray = array_filter(explode(",",$e['plans_nums']));
        $street = $e['orient'];
        $builder = 'Новострои от '.$dev['name'];//$developer['name']
        Crumbs::add($builder, '/'.$developer);
        Crumbs::add($street, '/novjk.html');
        // META
        $title = "{$e['orient']} &mdash; Продажа квартир  | {$dev['name']}";
        $description = "Продажа квартир в {$e['orient']} по цене от застройщика ➜ от {$e['price']} {$e['price_cur_word']}/м2 ★★★ Без комиссии ★★★ Без переплат ★★★ Отдел продаж новостроя";

//        MetaTag::set('title', $title);
//        MetaTag::set('description', $description);

        //        K_SEO::$description = "Продажа квартир в {$jk['orient']} по цене от застройщика ➜ от {$jk['price']} {$e['price_cur_word']}/м2 ★★★ Без комиссии ★★★ Без переплат ★★★ Отдел продаж новостроя";
//        K_SEO::$title = "{$jk['orient']} &mdash; Продажа квартир  | {$developer['name']}";
        $object = $e;

        return view('object.object', compact('object','dev','jk_plans','jk_slides','jk_build_status','action','actionCount','recomended','object_desc','mapPoint'));
    }


    public function show($jk){//show __invoke $id
        vd1($jk);
        //    $news = DB::table('news')->get();
//        $news = DB::table('type_news as news')
//            ->leftJoin('tree', 'news.type_news_id', '=', 'tree.tree_id')
//            ->select('news.type_news_id as id',
//                'news.type_news_new_date as new_date',
//                'news.type_news_image as image',
//                'news.type_news_content as content',
//                'news.type_news_header1 as header1',
//                'tree.tree_name as name'
//            )
//            ->paginate(10);
        return view('object.object' );
    }
}

//$object = new ObjectController();
//$object->makePrice();  // из типажа Movement
