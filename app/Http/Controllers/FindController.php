<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use This_Object;
use App\DataObjects\FindData;

class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        self::who();
    }
}

class B extends A {
//    public static function who() {
//        echo __CLASS__;
//    }
    public static function test() {
        self::who();
    }
}

B::who();

class FindController extends Controller
{
    //

    protected $request;
    protected $start;

    public function __construct(Request $request, string $start = '')
    {
        $this->request = $request;
        $this->start = $start;
    }

    public function getStart(){
        return $this->start;
    }


    public function index()
    {
        //поиск объектов

        $findData = FindData::fromRequest($this->request);
        $query = $this->getQuery($findData);
        //dump($validated);
        $query = This_object::find($query);

        $objectsFind = $query['objects'];
        //$paginationHtml = $query['pagination'];
        //рендер страницы
        return view('find.find', compact('objectsFind') );
    }

    private function getQuery(FindData $findData)
    {
        return array_merge($this->getTypeJk(), $this->getQueryParams($findData));
    }

    /**
     * @param $query
     * @return mixed
     */
    private function getTypeJk()
    {
        //vd1($this->request['type']);
        $query = [];
        switch ($this->request['type']) {
            case 'likejk':
                $query['id'] = $this->request['id'];
                break;
            case 'likejkstreet':
                $query['street_like'] = $this->request['req'];
                break;
            case 'likejkcity':
                $query['city_like'] = $this->request['req'];
                break;
            case 'likejkregion':
                $query['region_like'] = $this->request['req'];
                break;
            case 'likejkdeveloper':
                $query['developer'] = $this->request['id'];
                break;
        }
        return $query;
    }

    private function getQueryParams(FindData $findData)
    {
        $query = [];
        dump($findData);
        if ($findData->newjk_input == 1) {
            $query['newjk_input'] = 1;//$query['jk_is_new']
        }
        if ($findData->page) {
            $query['page'] = $this->request['page'];
        }
        if ($findData->complitejk_input == 1) {
            $query['complitejk_input'] = 1;//$query['jk_was_passed']
        }
        if ($findData->price_min) {
            $query['price_min'] = $this->request['price_min'];
        }
        if ($findData->price_max) {
            $query['price_max'] = $this->request['price_max'];
        }
        if ($findData->region) {
            $query['region'] = $this->request['region'];
        }
        if ($findData->city) {
            $query['city'] = $this->request['city'];
        }
        if ($findData->year) {
            $query['year'] = $this->request['year'];
        }
        if ($findData->rooms) {
            $query['rooms'] = $this->request['rooms'];
        }

        return $query;
    }
}
