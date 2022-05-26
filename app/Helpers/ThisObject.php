<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: женя
 * Date: 05.06.2020
 * Time: 15:56
 */
class ThisObject
{
    static private ?array $favorites = null;
    static private $saw = null;

    static public string $objectWhereAdd = 'pub = 1 and not_active !=1';

    static function getLink(&$o): string
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

    static function createMapObject($mapArray): string
    {
        $objects = [];
        foreach ($mapArray as $id => $obj) {
            $objects[$id]['id'] = $obj->id;
            $objects[$id]['orient'] = $obj->orient;
            $objects[$id]['map_lat'] = $obj->map_lat;
            $objects[$id]['map_lng'] = $obj->map_lng;
        }
        return json_encode($objects);
    }

    public static function setComplex(): string {
        return ' LEFT JOIN `Комплексы` kom ON kom.Код = obj_objects.jk_num_1c ';
    }

    static public function isFavorite($array): bool
    {
        if (empty(self::$favorites)) {
            self::$favorites = unserialize($_COOKIE['favourite']);
        }
        return in_array($array['id'], self::$favorites);
    }

    public static function notFoundMsg(): string
    {
        return "<div class='object-not-found'>Обьекты не найдены</div>";
    }

    static function find($q, $nopagin = false)
    {


        $result = DB::table('obj_objects')
            ->leftJoin('type_partner as t', 'obj_objects.developer', '=', 't.type_partner_id')
            ->leftJoin('Комплексы as kom', 'kom.Код', '=', 'obj_objects.jk_num_1c')
            ->select(
                'obj_objects.*', 'kom.end_building_date','kom.end_kvartal','t.type_partner_logo as dev_logo'
            )
            ->whereRaw($piece)//  ->whereRaw('orders.user_id = users.id');
            ->orderBy('new', 'desc')
            ->paginate(16)
            ->appends($q); //->get();//->limit(8)  ->orderBy('o.prioritet', 'desc')  ->paginate(16)->appends($q);

//        $objects = DB::table('obj_objects as o')
//            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
//            ->select(
//                'o.*', 't.type_partner_logo as dev_logo'
//            )
//            ->where([ ['o.top_sort','!=',0]])
//            ->orderBy('o.top_sort', 'asc')->limit(8)->get();

//        $result = k_q::data($allQuery);
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

        return array('objects' => $result, 'req' => $q);
    }
}
