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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', 'OnmainController@onmain');
//Route::get('user/{id}', function ($id) {
//    return 'User '.$id;
//});

// Пользователь
//Route::get('user/profile', 'UserController@show')->name('profile')->middleware('auth');
//Route::get('user/profile', ['middleware' => 'auth', function() {
//    // Только аутентифицированные пользователи могут зайти...
//    var_dump('user loggined');
//}]);

Route::get('user/profile', [//'middleware' => 'auth',
    'as' => 'profile',
    'uses' => 'UserController@profile'//
]);
Route::get('user/send','UserController@send')->name('send');
//Route::get('/user/view', function () {
//    return view('user.profile', ['id' => 'James','user'=>'eee']);
//});
Route::get('/user/view', function () {
    //return view('user.profile')->with(['id' => 'James','user'=>'eee']);
    $user = "KING";
    $users =[];
    $users=['Vasya','Petia','Alex'];
    return view('user.profile', compact('users','user') );
});
// ДлЯ юзер сонтроллера только числа
Route::get('user/{id}', function ($id) {
    return 'User '.$id;
    //return action('UserController@profile',$id);
})->where('id','[0-9]+'  );//     '[0-9]+'   '[A-Za-z]+'
Route::get('user/{id}/{name}','UserController@show' )->where(['id' => '[0-9]+', 'name' => '[a-z]+'])->name('userInfo');
Route::get('test/{name?}', function ($name = null) {
    return $name;
});
//Route::get('user/{id}/{name}', function ($id, $name) {
//    //
//})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);



//Route::middleware(['first', 'second'])->group(function () {
//    Route::get('/', function () {
//        // Uses first & second Middleware
//    });
//    Route::get('user/profile', function () {
//        // Uses first & second Middleware
//    });
//});
Route::get('/api/test', 'AjaxController@test');


Route::get('/news', 'NewsController@news');
Route::get('/news/{id}', 'NewsController@show')->where('id','[a-z]+');
Route::get('/sdanie', array(
    'as' => 'sdanie',
    'uses' => 'OnmainController@sdanie'
));
Route::get('/novie', array(
    'as' => 'novie',
    'uses' => 'OnmainController@novie'
));
Route::get('/home', function () {
    $minutes = 60;
    $cookie = Cookie('home', 'home323', $minutes);
    return response('Hello World', 200)
        ->header('Content-Type', 'text/plain')
        ->cookie($cookie);
});
Route::get('/find', array(
    'as' => 'find',
    'uses' => 'FindController@index'
));

Route::get('/favourites', array(
    'as' => 'fav',
    'uses' => 'FavController@index'
));
//Route::resource('/fav','FavController',['only' => ['add','clear','destroy']]);
Route::post('/fav/add',[
    'as' => 'addfav',
    'uses' => 'FavController@add'
]);
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

Route::get('products/', 'CategoryController@products');//CategoryController@products  ['uses' => 'CategoryController@products', 'as' => 'name']
Route::get('products/{id}', ['uses' => 'CategoryController@category', 'as' => 'name']);

//Route::get('/sdanie','DeveloperController@index' )->name('developer');


//Route::get('{developer}/{id}','UserController@show' )->where(['id' => '[0-9]+', 'name' => '[a-z]+'])->name('userInfo');
///{jk}
//Route::filter('before', function()
//{
//    // Check if we asked for a user
//    $server = explode('.', Request::server('HTTP_HOST'));
//    if (count($server) == 4)
//    {
//        Route::get('/', [//'middleware' => 'auth',
//            'as' => 'developer',
//            'uses' => 'DeveloperController@index'//
//        ]);
//        // We have 3 parts of the domain - therefore a subdomain was requested
//        // i.e.  user.domain.com
//        // Check if user is valid and has access - i.e. is logged in
////        if (Auth::user()->username === $server[0])
////        {
////
////            // User is logged in, and has access to this subdomain
////            // DO WHATEVER YOU WANT HERE WITH THE USER PROFILE
////            echo "your username is ".$server[0];
////        }
////        else
////        {
////            // Username is invalid, or user does not have access to this subdomain
////            // SHOW ERROR OR WHATEVER YOU WANT
////            echo "error - you do not have access to here";
////        }
//    }
//    else
//    {// Only 2 parts of domain was requested - therefore no subdomain was requested
//        // i.e. domain.com
//        // Do nothing here - will just route normally - but you could put logic here if you want
//    }
//});


//Route::domain('{subdomainn}.'.config('app.short_url'))->group(function () {//config('app.short_url')
//   //Route::get('/', 'NewsController@show')->name();
//    Route::get('/', [//'middleware' => 'auth',
//        'as' => 'developer',
//        'uses' => 'DeveloperController@index'//
//    ]);
////    Route::get('/', function ($domain, $id) { });
//    Route::get('{jk}', 'ObjectController@show');
//    //Route::resource('/{jk}', 'ObjectController@index');
//});

//api.php
//Route::resource('user', 'User\UserController', ['only' => ['index', 'store']]);
//Route::group(['domain' => '{account}.myapp.com'], function () {
//    Route::get('user/{id}', function ($account, $id) {
//        //
//    });
//});
//
//Route::group(array('subdomain' => '{account}.'.config('app.short_url')), function(){// myapp.com
//    Route::get('/', array(
//        'as' => 'partner-home',
//        'uses' => 'DeveloperController@index'
//    ));
//});

//Route::get('/news', function () {
//    //return view('user.profile')->with(['id' => 'James','user'=>'eee']);
////    $news = DB::table('news')->get();
////    $news = App\Link::all();
//    $news = App\Link::inpublic();
//    return view('news.news', compact('news') );
//});
//Route::get('/news/{id}', function ($id) {
//    //return view('user.profile')->with(['id' => 'James','user'=>'eee']);
//    //$link = DB::table('news')->find($id);
//    $link = App\Link::find($id);
//    return view('news.show', compact('link') );
//});


//Route::get('user/{id}', function ($id) {
//    //return 'User '.$id;
//    return action('UserController@show');
//}); //->where('id', '[0-9]+')

//Route::get('user/{id}', 'UserController@profile')->where('id','[0-9]+');;


//Route::get('user/{id}/profile', function ($id) {
//    return action('UserController@cabinet');
//})->name('UserProfile');

//Route::get('user/{id}/{name?}', function ($id, $name=null) {
//    return action('UserController@profile',$id);
//})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

//Route::get('user/{id}', function ($id) {
//   //return route('profile');
//    //Request $request,
//    return action('UserController@profile');
//    //return view('resources/views/user/profile');
//});





//Route::get('productsw/', action('UserController@show'));

//Route:: post('user/dashboard', function () {
//    return 'Welcome to dashboard';
//});
//Route :: get ('emp/{id}', function ($id) {
//    echo 'Emp '.$id;
//});
Route :: get ('emp/{desig?}', function ($desig = null) {// Необязательный параметр
    echo $desig;
});
Route::match(['get', 'post'], 'emp/{id}', function ($id) {
    echo 'Emp '.$id;
});
Route::get('posts/{post}/comments/{comment}/{text}', function ($postId, $commentId, $text) {
    //
    return "Post №".$postId." comments is ".$commentId." text is ".$text;
});


//Route::namespace('Admin')->group(function () {
//    // Controllers Within The "App\Http\Controllers\Admin" Namespace
//});

//Route::get('/home', 'HomeController@index')->name('home');
