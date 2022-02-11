<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAge;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App;
use App\Building;
use This_Object;
use DB;
use Route;
use App\Services\MetaService;
use App\Helpers\This_Favorites;
//use Djmitry\Meta\Meta;
use Djmitry\Meta\Meta;

//use Torann\LaravelMetaTags\MetaTag;
use Torann\LaravelMetaTags\Facades\MetaTag;


trait AutoOptions {
    protected function run() {
        if(empty($this->speed)){
            $this->speed = 100;
        }
        echo "Running at speed: {$this->speed}km/h" . PHP_EOL;
    }
    public function stop() {
        if(empty($this->speed)) $this->speed = 0;
        echo "Stopped moving!" . PHP_EOL;
    }
}

trait AutoSpeak {
    public function makeSound(){
        echo $this->protectedName . PHP_EOL;
    }
}

class Auto {
    use AutoOptions, AutoSpeak;
    public $model;
    public $speed;
    public $year;
    protected $price;
    private $owner;
    public function __construct($model = 'Opel', $speed, $year)
    {
        $this->model = $model;
        $this->speed = $speed;
        $this->year = $year;
    }
    public function runPub(){
        $this->run();
    }
    public function __destruct()
    {

    }
    public function __unset($name)
    {
        vd1('remove object');
        // TODO: Implement __unset() method.
    }
}
class Audi extends Auto {
    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price = $price;
    }
}
//$audi = new Audi('Audi', 200, 2008);
//
//vd1($audi);
//$audi->setPrice(232939239);
//vd1($audi->getPrice());
//vd1($audi);

//$car = new Auto('Audi', 200, 2008);
//$car->runPub();
//$car->stop();
//vd1($car->speed);



class OnmainController extends Controller
{
    use AutoOptions, AutoSpeak;
    public $public ='public';
    public $speed;
    protected $protectedName = 'protected';
    private $private = 'private';


    public function __construct(MetaService $metaService)
    {

//        $metaService
//            ->setTitle('title', 'Все Новострои Одессы')
//            ->setDescription('description', 'Все Новострои Одессы по цене от застройщика, предложения на любой вкус')
//            ->setFavicon('image', asset('images/locked-logo.png'));
    }


    public function onmain()//show __invoke $id
    {



        $req = new Request();
        $find=  new FindController($req,3);
//        echo $find->getStart();
//        $f =88;
//        echo 'ss: $e';
        $title = "Main Page";


//        $developer = App\Developer::query();
//        $users = App\User::where('active', 1)->get();
        //$this->gallery = k_treequery::crt('/maingal/')->types(array('image'))->go();
        //->where([ ['status', '=', '1'], ['subscribed', '<>', '1'],])
//        $objects = App\Building::whereRaw('not_active!=1' AND 'pub=1') // ->where('votes', '>=', 100)
//            ->orderBy('orient', 'desc')
//            ->take(8)
//            ->get();
//        foreach($objects as $obj){
//            vd1($obj->dev);
//        }

        $objects = DB::table('obj_objects as o')
            ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
            ->select(
                'o.*', 't.type_partner_logo as dev_logo'
            )
            ->where([ ['o.top_sort','!=',0]])
            ->orderBy('o.top_sort', 'asc')->limit(8)->get();


        $builders = DB::table('type_partner')->whereRaw('type_partner_turn_off!="да"')
            ->select('type_partner_id as id',
                'type_partner_name as name',
                'type_partner_turn_off as turn_off',
                'type_partner_logo as logo')->get();

        $news = DB::table('type_news as news')
            ->leftJoin('tree', 'news.type_news_id', '=', 'tree.tree_id')
            ->select('news.type_news_id as id',
                'news.type_news_new_date as new_date',
                'news.type_news_image as image',
                'news.type_news_content as content',
                'news.type_news_header1 as header1',
                'tree.tree_name as name'
                )
            ->orderBy('new_date', 'desc')->limit(10)->get();
//            ->get();
//        ->simplePaginate(6);
        /* ПОЛНЫЙ JOIN */
//        $users = DB::table('users')
//            ->join('contacts', 'users.id', '=', 'contacts.user_id')
//            ->join('orders', 'users.id', '=', 'orders.user_id')
//            ->select('users.*', 'contacts.phone', 'orders.price')
//            ->get();
//        $this->v->news = K_TreeQuery::crt("/news/")->type('news')->order(array('news' => 'new_date'))->condit(['news'=>' and type_news_new_date < NOW() '])->limitLikeSql(0, 6)->go(array('orderby' => 'DESC'));
//        //$this->v->text = k_treequery::gOne('/texts/main/', 'node');
        $query = This_Object::find(['map_geo' => true]);
        $map = $query['objects'];
//        $roominfo = json_decode($this->v->all['appart'], true);
//        $this->v->room = $roominfo;
        $mapAllObjects = This_Object::createMapObject($map);
        $url = Route::currentRouteName();
        //vd1(Route::current()->uri());//Route::current()->uri()
        //vd1($mapAllObjects);
//        $this->v->builders = K_TreeQuery::crt('/builders/')->type('partner')->go();
//        $objects = Object::where(['not_active'=>0])
//            ->orderBy('new', 'desc')
//            ->take(20)
//            ->get();

        $builders = DB::table('type_partner')->whereRaw('type_partner_turn_off!="да"')
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
        return view('onmain.onmain', compact('objects','builders','news', 'mapAllObjects') );
    }


    public function news(){//show __invoke $id
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
    function prints(){
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}



interface IDraw {
    public function draw($text);
}

class Circle implements IDraw {
    public function draw($text)
    {
        echo $text;
    }
}

class Square implements IDraw {
    private $error = 404;
    public function draw($text)
    {
        echo $text;
    }
    public function __get($name)
    {
        echo "Get undefined or private var: '$name'\n";
    }
    public function __set($name, $value)
    {
        echo "Set undefined or private var: '$name' to '$value'\n";
    }
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Call new method '$name' "
            . implode(', ', $arguments). "\n";
    }
}
//
class Disp {
    public function get($class)
    {vd1($class);
        if (class_exists(ucfirst($class))){

            return new $class;
        }
    }
}


//$disp = new Disp();
//
//$circle = $disp->get('Circle');
//$square = $disp->get('Square');
//vd1($circle);
//$circle->draw('This is Circle');
//$square->draw('This is Square');


//abstract class AbstractFruit {
//    const NAME = 'orange';
//    const COLOR = 'green';
//    const WEIGHT = '100g';
//
//    public function __construct(
//        $appLayoutsPath = AbstractFruit::NAME,
//        $moduleLayoutsPath = AbstractFruit::COLOR,
//        $moduleTemplatesPath = AbstractFruit::WEIGHT
//    ) {}
//}

class Fruit {
    public $name;
    public $color;
    public function __construct($name, $color) {
        $this->name = $name;
        $this->color = $color;
    }
    public static function go(){
        echo 10;
    }
    public function intro() {
        echo "The fruit is {$this->name} and the color is {$this->color}.";
    }
}

class Strawberry extends Fruit {
    public $weight;
    public function intro() {
        echo "The fruit is {$this->name}, the color is {$this->color}, and the weight is {$this->weight} gram.";
    }
    public function setWeight($color = 'blue')
    {
        parent::go();
        $this->color = $color;
    }
}

//$strawberry = new Strawberry('strawbery', 'red');
//$strawberry->intro();
//$strawberry->setWeight();
//vd1($strawberry);







class Ar {
    public $bal;
    public $name;
    public function getBal(){
        return $this->bal;
    }
    public static function sum($a, $b)
    {
        return $a + $b;
    }
    function __destruct() {
        echo "The fruit is {$this->bal}.";
    }
}
class Ar2 extends Ar{
    public static function sum($a, $b)
    {
        return $a + $b;
    }
}
//$ar2 = new Ar2();
////$ar2->bal= 'erer';
////echo $ar2->bal;
//echo Ar2::sum(2, 8);


class CallStatic
{
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling new method '$name' arguments:"
            . implode(', ', $arguments). "\n";
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling static method '$name' "
            . implode(', ', $arguments). "\n";
    }
}

//$obj = new CallStatic;
//$obj->runTest('name','age');
//
//CallStatic::runTest('in static context');

//class Message
//{
//    public function formatMessage($message)
//    {
//        return printf("<i>%s</i>", $message);
//    }
//}
//
//class BoldMessage extends Message
//{
//    public function formatMessage($message)
//    {
//        return printf("<div style='color:red'>%s</div>", $message);
//    }
//}
//$message = new Message();
//$message->formatMessage('Hello World'); // prints '<i>Hello World</i>'
//$message = new BoldMessage();
//$message->formatMessage('Hello World'); // prints '<b>Hello World</b>'

/*
6_1 "SELECT employee_id,first_name,last_name,salary
       FROM employees WHERE salary >
	        (SELECT AVG(SALARY) FROM employees);",

6_2 "SELECT b.name, office_id, person.name as fam, MAX(wage)
FROM `person` LEFT JOIN `branch` as b ON person.office_id=b.id
GROUP BY  b.name",

6_3 "",

6_4 "SELECT b.id, b.name, SUM(wage), COUNT(person.id)
FROM `person`  LEFT JOIN branch b ON b.id=person.office_id
GROUP BY office_id ORDER BY SUM(wage) DESC";
*/

function getNumOfUniqueCharacters($str, $n) {
    $temp_array = [];
    $key_array = [];
    $count = [];
    $chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    $i = 0;
    $u = 2;
    function in_arrayi($needle, $haystack) {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }
    foreach($chars as $k=>$v){
        if(!in_arrayi($v, $key_array)){
            $key_array[$i] = $v;
        }else{
            if(isset($temp_array[$v]) && in_arrayi($v, $key_array)){
                $temp_array[$v] = $temp_array[$v]+1;
            }else{
                $temp_array[$v] = $u;
            }
            if($temp_array[$v] >=$n){
                $count[$v] = $temp_array[$v];
            }
        }
        $i++;
    }
    return count($count);
}
//vd1(getNumOfUniqueCharacters('Aa1Bbb2C3', 3)); // 0
//vd1(getNumOfUniqueCharacters('A1222a11C1', 4)); // 2, because A and 1 both occur 2 or more times.
//vd1(getNumOfUniqueCharacters('Alabama', 3)); // 1