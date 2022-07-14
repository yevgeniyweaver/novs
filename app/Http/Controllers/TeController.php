<?php

namespace App\Http\Controllers;
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

