<?php
namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: женя
 * Date: 05.06.2020
 * Time: 15:56
 */
class This_Object
{
    static private $favorites = null;
    static private $saw = null;

    static public $objectWhereAdd = 'pub = 1 and not_active !=1';

    static function getLink(&$o)
    {
        $builders = ThisBuilder::getAll();

        if (!empty($o->url) && !empty($o->developer)) {//$o['url']
            if(isset($builders[$o->developer])){
                $link = '/' . mb_strtolower($builders[$o->developer]['tree_name']) . '/' . str_replace('.html', '', $o->url);
            }else{
                $link = '/404.html';
            }
           // $link=$o->developer;
           // $link = $builders[$o->developer]['tree_name'];//config('app.short_url')
            //$link = '//' . mb_strtolower($builders[$o->developer]['tree_name']). '.' . 'laratest' . '/' . str_replace('.html', '', $o->url);//['tree_name']) . '.' . config('app.short_url') . '/' . str_replace('.html', '', $o->url)
            //$link = '/' . mb_strtolower($builders[$o->developer]['tree_name']) . '/' . str_replace('.html', '', $o->url); //['tree_name']) . '.' . config('app.short_url') . '/' . str_replace('.html', '', $o->url)
        } else {
            $link = '/404.html';
        }
        return $link;
    }


    static function getFirstImgPath(&$o)
    {

        $photosArr = explode(",", $o->photos_nums);//$o["photos_nums"]
        $path = '/objects/plashka/';

       // $returnImg = '/upload/objects/plashka/48518_56.jpg';
        $returnImg = '/img/apelsin1.jpg';

        foreach ($photosArr as $value) {

            if (file_exists('upload/' . $path . $o->id . "_" . $value . ".jpg")) {//$o["id"]

                $returnImg = '/upload' . $path . $o->id . "_" . $value . ".jpg";

                break;
            }else{
//                $img_req = 'http://novostroika.od.ua'.'/upload' . $path . $o->id . "_" . $value . ".jpg";
//                if (@fopen( $img_req , "r")) {
//                    //echo "Файл существует";
//                    $returnImg = $img_req;
//                } else {
//                    ///echo "Файл не найден";
//                }
//                $urlHeaders = @get_headers($img_req);
//                if(strpos($urlHeaders[0], '200')) {
////                    echo "Файл существует";
//                    $returnImg = $img_req;
//                }
//                else {
////                    echo "Файл не найден";
////                    $returnImg = $returnImg;
//                }
                $returnImg = 'http://novostroika.od.ua'.'/upload' . $path . $o->id . "_" . $value . ".jpg";
            }

        }

        return $returnImg;
    }

    static function createMapObject($array)
    {
        $objects = [];
        foreach ($array as $id => $obj) {
            $objects[$id]['id'] = $obj->id;
            $objects[$id]['orient'] = $obj->orient;
            $objects[$id]['map_lat'] = $obj->map_lat;
            $objects[$id]['map_lng'] = $obj->map_lng;
//            $objects[$id]['id'] = $obj['id'];
//            $objects[$id]['orient'] = $obj['orient'];
//            $objects[$id]['map_lat'] = $obj['map_lat'];
//            $objects[$id]['map_lng'] = $obj['map_lng'];
        }
        return json_encode($objects);
    }

    public static function setComplex(){
        return ' LEFT JOIN `Комплексы` kom ON kom.Код = obj_objects.jk_num_1c ';
    }

    static public function isFavorite($array)
    {
        if (empty(self::$favorites)) {
            self::$favorites = unserialize($_COOKIE['favourite']);
        }
        return in_array($array['id'], self::$favorites) ? true : false;
    }

    public static function notFoundMsg()
    {
        return "<div class='object-not-found'>Обьекты не найдены</div>";
    }

    static function find($q, $nopagin =false)
    {

        $where = array();

        if (isset($q['builder']) && !empty($q['builder'])) {

            $where[] = 'developer = ' . intval($q['builder']);

        }

        if (isset($q['year']) && !empty($q['year'])) {

            $years = array();

            foreach($q['year'] as $v){

                if($v=='2021+') {
                    $years[] = 'year_finish >= ' . self::qv('2021');

                }else if($v=='Сданные'){
                    $years[] = ' complite=1';
                }else{
                    $years[] = 'year_finish = ' . self::qv($v);
                }
            }
            $where[] = '('.implode(' OR ', $years).')';
//                $where[] = implode(' OR ', $years);
//            if($years){
//            }
        }

        // `rooms` LIKE '%3%' OR `rooms` LIKE '%4%' OR `rooms` LIKE '%2%'
        if(isset($q['rooms']) && !empty($q['rooms'])){
            $rooms = array();
            foreach($q['rooms'] as $v){
//                if(count($q['rooms']) ==1) {
//                    $rooms[] = "rooms LIKE '%" . k_q::e( $q['rooms']) . "%'";
//                }else{
//                }
                $rooms[] = "rooms LIKE '%" . $v . "%'";
            }
            $where[] = '('.implode(' OR ', $rooms).')';
        }

        ///////////////////РАЙОН В КОТОРОМ НАХОДИТСЯ ОБЪЕКТ///////////////

        if (isset($q['region']) && !empty($q['region'])) {

            $where[] = 'region = ' . self::qv($q['region']);

        }


        if (isset($q['city']) && !empty($q['city'])) {

            $where[] = 'city = ' . self::qv($q['city']);

        }

        /////////////////////// ЦЕНА ЗА КВЮ М2    /////////////////

        if (isset($q['price']) && !empty($q['price'])) {
            $where[] = 'price = ' . self::qv($q['price']);
        }

        if (isset($q['street_like']) && !empty($q['street_like'])) {
            $where[] = "street LIKE '%" .self::e( $q['street_like']) . "%'";
        }

        if (isset($q['developer']) && !empty($q['developer'])) {
            $where[] = 'developer = '.self::qv($q['developer']);
        }

        if (isset($q['city_like']) && !empty($q['city_like'])) {
            $where[] = "city LIKE '%" . k_q::e( $q['city_like']) . "%'";
        }

        if (isset($q['region_like']) && !empty($q['region_like'])) {
            $where[] = "region LIKE '%" . self::e( $q['region_like']) . "%'";
        }

        if (isset($q['newjk_input']) && isset($q['complitejk_input'])) {//isset($q['jk_is_new']) && isset($q['jk_was_passed'])
            $where[] = 'new = 1 OR complite = 1';
        } elseif (isset($q['newjk_input'])) {
            $where[] = 'new = 1';
        } elseif (isset($q['complitejk_input'])) {
            $where[] = 'complite = 1';
        }


        if (isset($q['price_min']) && !empty($q['price_min'])) {
            $where[] = 'obj_objects.price  >= ' . self::qv(intval($q['price_min']));
        }
        if (isset($q['price_max']) && !empty($q['price_max'])) {
            $where[] = 'obj_objects.price  <= ' . self::qv(intval($q['price_max']));
        }


        if (isset($q['id']) && !empty($q['id'])) {
            $where = [];
            if (is_array($q['id'])) {
                $where['id'] = 'id IN (' . implode(',', array_map('k_q::qv', $q['id'])) . ')';

            } else {
                $where['id'] = 'id = ' . self::qv(intval($q['id']));
            }
        }

//        $notKadorr = " AND NOT developer='22291'";
        $notKadorr = " AND developer!=22291 AND developer!=0 ";

        $where[] = self::$objectWhereAdd.$notKadorr;

        $piece = implode(' and ', $where);
        //vd1($piece);
        $page = isset($q['page']) ? $q['page'] : 0;

//        $pag_info = K_Paginator::prepear($page, 12);

//        $limit = "LIMIT {$pag_info['onPage']} OFFSET {$pag_info['start']}";

        if ($nopagin) {
            $limit = '';
            $pag_info = '';
        }
        if (isset($q['map_geo']) || isset($q['nolimit'])) {
            $limit = '';
            $pag_info = '';
        }
        ///

       // $allQuery = "SELECT obj_objects.*, kom.end_building_date, kom.end_kvartal FROM `obj_objects`  " . self::setComplex() . " WHERE {$piece} " ."ORDER BY new DESC, prioritet DESC ". $limit ;
        //vd1($allQuery);//, kom.end_building_date, kom.end_kvartal
//LEFT JOIN `Комплексы` kom ON kom.Код = obj_objects.jk_num_1c

        //vd1($piece);
        $result = DB::table('obj_objects')
            ->leftJoin('type_partner as t', 'obj_objects.developer', '=', 't.type_partner_id')
            ->leftJoin('Комплексы as kom', 'kom.Код', '=', 'obj_objects.jk_num_1c')
            ->select(
                'obj_objects.*', 'kom.end_building_date','kom.end_kvartal','t.type_partner_logo as dev_logo'
            )
            ->whereRaw($piece)//  ->whereRaw('orders.user_id = users.id');
            ->orderBy('new', 'desc')->paginate(16)->appends($q); //->get();//->limit(8)  ->orderBy('o.prioritet', 'desc')  ->paginate(16)->appends($q);

//        $objects = DB::table('obj_objects as o')
//            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
//            ->select(
//                'o.*', 't.type_partner_logo as dev_logo'
//            )
//            ->where([ ['o.top_sort','!=',0]])
//            ->orderBy('o.top_sort', 'asc')->limit(8)->get();



        //$result= $result->toArray();
        //vd1($result->toArray());
//        $result = k_q::data($allQuery);
//
//        //создание пагинации
//        $countItems = K_Q::row("SELECT COUNT(*) as c FROM `obj_objects` WHERE {$piece} ");
//        $countItems = $countItems['c'];
//        $pages = K_Paginator::simple($page, ceil($countItems / $pag_info['onPage']));
//
//        ob_start();
//        include(CHUNK_PATH . '/pagination.phtml');
//        $paginationHtml = ob_get_contents();
//        ob_end_clean();
//        "pagination" => $paginationHtml,
       // 'total' => $countItems,

        return array('objects' => $result,   'req' => $q);
    }

    static public function quote($value)
    {
//        if ($value instanceof K_Db_Expr) {
//            return $value->__toString();
//        }
        if (is_array($value)) {
            foreach ($value as &$val) {
                $val = self::quote($val);
            }
            return implode(', ', $value);
        }
        return self::_quote($value);
    }

    static protected function _quote($value)
    {
        return "'" . addcslashes($value, "\000\n\r\\'\"\032") . "'";
    }

    public static function qv($value)
    {
        return self::quote($value);
    }
}