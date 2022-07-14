<?php


namespace App\Services;
use App\Events\onAddFav;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;


class FavService
{
    static public $cookies;
    static public array $favorites;

    public static function init()
    {
        if (empty(self::$favorites)) {
            //$cookie = self::unserializeCookies();
            $cookie = json_decode(Cookie::get('favourite'));
            self::$favorites = $cookie;
        }
    }

    public static function isFavorite(string $id)
    {
        if (empty(self::$favorites) || self::$favorites == null) {
            $cookie = json_decode(Cookie::get('favourite'));

            if (empty($cookie) || $cookie == null) {
                return false;
            }

            self::$favorites = $cookie;

            return in_array($id, self::$favorites) ? true : false;

        } else {
            return in_array($id, self::$favorites) ? true : false;
        }
    }


    public static function set(string $value)
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

    public static function write(): void
    {
        if (Cookie::has('favourite')) {
            self::$favorites = json_decode(Cookie::get('favourite'));
            if (!in_array($_POST['id'], self::$favorites)) {
                array_push(self::$favorites, $_POST['id']);
            }
        } else {
            self::$favorites = [$_POST['id']];
        }

        self::setCookies();
    }

    public static function unserializeCookies()
    {
        $minutes = 10;
        $cookie = Cookie('favourite', $fav, $minutes);
        $response = new response();
        return $response->withCookie($cookie);//$cookie->getName();
        //return $request->id;
        //return response()->cookie($cookie);
        //return unserialize($_COOKIE['favourite']);
    }

    public static function getCountFavourites()
    {
        if (!empty(self::$favorites) && self::$favorites != null) {
            return count(self::$favorites);
        } else {
            $cookie = json_decode(Cookie::get('favourite'));
            if (!empty($cookie) && $cookie != null) {
                return count($cookie);
            }
        }
    }

    public static function clearAll()
    {
        setcookie('favourite', null, 0, '/', config('app.url'));
    }

    public static function destroy(): void
    {
        $id = $_POST['id'];
        $cookies = self::unserializeCookies();
        foreach ($cookies as $key => $value) {
            if ($id == $value) {
                unset($cookies[$key]);
            }
        }
        self::$favorites = $cookies;
        self::setCookies();
    }

    private static function setCookies(): int
    {
        $minutes = 350;
        Cookie::queue(Cookie::make('favourite', json_encode(self::$favorites), $minutes));
        return self::getCountFavourites();
    }

    public static function getVD()
    {
        return Cookie::get('favourite');
    }
}
