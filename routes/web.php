<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'OnmainController@onmain');

Route::get('/news', 'NewsController@news');
Route::get('/news/{id}', 'NewsController@show')->where('id','[a-z]+');

Route::get('/sdanie', array('as' => 'sdanie', 'uses' => 'OnmainController@sdanie'));
Route::get('/novie', array('as' => 'novie', 'uses' => 'OnmainController@novie'));

Route::get('/find', array('as' => 'find', 'uses' => 'FindController@index'));
Route::get('/favourites', array('as' => 'fav', 'uses' => 'FavController@index'));
//Route::resource('/fav','FavController',['only' => ['add','clear','destroy']]);
Route::post('/fav/add',['as' => 'addfav', 'uses' => 'FavController@add']);
Route::post('/fav/clear','FavController@clear' )->name('clearfav');
Route::post('/fav/destroy','FavController@destroy' )->name('destroyfav');

Route::post('/ajax/getobjinfo','AjaxController@clear' )->name('getObjInfo');
//Route::get('/favtest', 'FavtestController@add');
//Route::resource('/favtest', 'FavtestController',['only' => ['index', 'add','store', 'show', 'destroy']]);

Route::post('/object/info',[
    'as' => 'getObjInfo',
    'uses' => 'AjaxController@getObjInfo'
]);
Route::get('/{rayon}', array(
    'as' => 'rayon',
    'uses' => 'OnmainController@rayons'
))->middleware('rayons');

Route::get('/{developer}/{jk}','ObjectController@index' )->where(['developer' => '[0-9A-Za-z\-]+','jk' => '[0-9A-Za-z\-]+' ])->name('novjk');
Route::get('/{developer}',['uses'=>'DeveloperController@index'] )->middleware('rayons')->where(['developer' => '[0-9A-Za-z\-]+' ])->name('developer');
