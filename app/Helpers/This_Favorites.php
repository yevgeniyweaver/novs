<?php

namespace App\Helpers;
//use Illuminate\Cookie;
use App\Events\onAddFav;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Event;


class This_Favorites
{
//    static public $cookies;

    static public $favorites;

    public static function init()
    {

        if (empty(self::$favorites)) {
           //$cookie = self::unserializeCookies();
            $cookie = json_decode(Cookie::get('favourite'));
            self::$favorites = $cookie;
        }
        //return Cookie::get('favourite');
    }

    public static function isFavorite($id)
    {
        if(empty(self::$favorites) || self::$favorites ==null ){
            $cookie = json_decode(Cookie::get('favourite'));
            self::$favorites = $cookie;
            if(!empty($cookie) && $cookie !=null){
                return in_array($id, self::$favorites) ? true : false;
            }
            return false;

        }else{
            return in_array($id, self::$favorites) ? true : false;
        }
       //return self::$favorites;

    }


    public static function set($value)
    {
        if ($_COOKIE['favourite']) {
            self::$favorites = self::unserializeCookies();
            if (!in_array($_POST['id'], self::$favorites)) {
                array_push(self::$favorites, $value);
            }
        } else {
            self::$favorites = [$_POST['id']];
        }
        self::setCookies();
    }

    public static function write()
    {
        //self::unserializeCookies();
//        $val = Cookie::get('favourite');
        //Cookie::queue(Cookie::forget('favourite'));
        if (Cookie::has('favourite')) {
            $fav = Cookie::get('favourite');
            $sa = json_decode(Cookie::get('favourite'));
            self::$favorites = $sa;
//            cookie->queue('name', json_encode($_POST), 84600);
            if (!in_array($_POST['id'], self::$favorites)) {
                array_push(self::$favorites, $_POST['id']);
            }
        } else {
            $sa = [$_POST['id']];
            self::$favorites = [$_POST['id']];//$_POST['id']
        }
        return self::setCookies();
        //return json_decode(Cookie::get('favourite'));
      // Cookie::get('favourite');
//        if (isset($_COOKIE['favourite'])) {
//            self::$favorites = self::unserializeCookies();
//            if (!in_array($_POST['id'], self::$favorites)) {
//                array_push(self::$favorites, $_POST['id']);
//            }
//        } else {
//            self::$favorites = [2];//$_POST['id']
//        }
//        self::setCookies();
//        return self::$favorites;
    }

    public static function unserializeCookies()
    {
        $minutes=10;
        $fav = '111111111118';
//        $value = $request->cookie('name');
        $cookie = Cookie('favourite', $fav, $minutes);
       // $value = Cookie::get('favourite');
        $response = new response();
       return $response->withCookie($cookie);//$cookie->getName();
        //return $request->id;
       //return response()->cookie($cookie);
        //return unserialize($_COOKIE['favourite']);
    }

    public static function getCountFavourites()
    {
        if (!empty(self::$favorites) && self::$favorites !=null) {
            return count(self::$favorites);
        }else{
            $cookie = json_decode(Cookie::get('favourite'));
            if(!empty($cookie) && $cookie !=null){
                return count($cookie);
            }
        }
    }

    public static function clearAll()
    {
        setcookie('favourite', null, 0, '/', config('app.url'));
    }

    public static function destroy()
    {
        $id = $_POST['id'];
        $cookies = self::unserializeCookies();
        foreach ($cookies as $key => $value) {
            if ($id == $value)
                unset($cookies[$key]);
        }
        self::$favorites = $cookies;
        self::setCookies();
    }

    private static function setCookies()
    {
        $minutes = 350;
        Cookie::queue(Cookie::make('favourite', json_encode(self::$favorites), $minutes));
       // Cookie::queue(['favourite', json_encode(self::$favorites), 10]);
        $req = new Request();
//        return Cookie::get('favourite');
        Event::fire(new onAddFav($req));
        return self::getCountFavourites();
//        setcookie('favourite', serialize(self::$favorites), 0, '/', config('app.url'));
//        echo This_Favorites::getCountFavourites();
    }

    public static function getVD()
    {
        //vd1(static::$favorites);
        return Cookie::get('favourite');
    }
}