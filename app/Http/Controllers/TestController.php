<?php

namespace App\Http\Controllers;

class TestController
{

}

class A {
    public static $res = 100;
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        echo static::$res;
        static::who();
    }
}

class B extends A {
    public static $res = 7;
    public static function who() {
        echo __CLASS__;
    }
//    public static function test() {
//        echo self::$res;
//    }
}
B::test();
