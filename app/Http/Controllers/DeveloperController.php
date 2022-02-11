<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Crumbs;
use Illuminate\Support\Facades\Redis;
class DeveloperController extends Controller
{
    //

    public function index($developer){//show __invoke $id

        $dev = DB::table('type_partner as d')
            ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
            ->whereRaw('d.type_partner_turn_off!="да" AND t.tree_name="'.$developer.'"')
            ->select('d.*',
                't.*',
                'd.type_partner_id as id',
                'd.type_partner_name as name',
                'd.type_partner_turn_off as turn_off',
                't.tree_name',
                'd.type_partner_builders_bg as builders_bg',
                'd.type_partner_logo as logo')->first();
        $dev = json_decode(json_encode($dev), true);//$builder
        $builders = $dev;
        $builders_bg = 'http://novostroika.od.ua/upload/'.$dev['builders_bg'];
//        $this->v->slides = unserialize($this->v->builders['slider']);
//        $notKadorr = " AND developer!=22291 AND developer!=0 ";
//        $where = AllConfig::$objectWhereAdd.$notKadorr;
        ////////////////////////////////Выбираем обект для показа в блоке ЖК///////////////////////////////
//        $this->v->count = k_Q::data("SELECT id, COUNT(*) FROM `obj_objects` WHERE developer = '$developerId'");
//        if (empty($_POST['next'])) {
//            $this->v->limit = 0;
//            $this->v->b = k_q::row("select * from obj_objects where developer = '$developerId'  limit  {$this->v->limit},1");
//        } else {
//            $this->v->limit = $_POST['next'];
//            $this->v->b = k_q::row("select * from obj_objects where developer = '$developerId'  limit  {$this->v->limit},1");
//        }
//        // obj_objects*, kom.end_building_date, kom.end_kvartal   . self::setComplex() . "
//        $all = k_q::data("select obj_objects.*, kom.end_building_date, kom.end_kvartal from obj_objects " . this_object::setComplex() . " where ". $where ." AND developer = '$developerId' ORDER BY new desc, action DESC ");
        ////////////////////////////////ВЫБОР ОБЬЕКТОВ ПО РАЕНУ И СОСТОЯНИЮ ОБЬКТА////////////////////////////
        $dev_objects = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select('o.*', 't.type_partner_logo as dev_logo')
            ->whereRaw('o.developer='.$dev['id'])->limit(4)->get();
//        $q['builder'] = $developerId;
//        $q['map_geo'] = true;
//        $query = This_Object::find($q);
//        $this->v->paginationHtml = $query['pagination'];
//        $this->v->mapObjects = This_Object::createMapObject($this->v->all);
//        $appart = json_decode($this->v->b['appart'], true);
//        K_Crumbs::add('Ukkk',AllConfig::$protocol.'test.novostroika.od.ua');
        Crumbs::add('Главная','/');
        Crumbs::add($dev['name'], '/');

        return view('object.developer', compact('dev','dev_objects','builders_bg'));
    }
}
