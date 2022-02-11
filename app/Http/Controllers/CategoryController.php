<?php
/**
 * Created by PhpStorm.
 * User: женя
 * Date: 04.11.2019
 * Time: 17:16
 */

namespace App\Http\Controllers;
use App;
use App\User;
use App\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Collection;
use Route;


class CategoryController extends Controller
{
    /**
     * Показать профиль данного пользователя.
     *
     * @param  int  $id
     * @return Response
     */
    public function products()//show __invoke
    {
       //$category = DB::table('categories')->where('id', 16)->first();
       $category = Category::find([16,12,18]);

        //$category = DB::table('categories')->where('id', 16)->value('name');
       // vd1($category);
//        //$email = DB::table('users')->where('name', 'John')->value('email');
//        $products = DB::table('products')->where('category_id', 16)->get();
//        $products = DB::table('products')->where('category_id', 16)->pluck('id');
        //$products = DB::table('products')->whereRaw('is_active=1 and can_buy = 1 and category_id=12', [25])->get();

        $products = DB::table('products')->whereRaw('is_active=1 and can_buy = 1 and category_id=12', [25])->select('id', 'name as kyx_name')->get();

       vd1($products);



        return view('category.products', ['category'=>$category, 'products'=> $products]);//User::findOrFail($id) ['user' =>$id ]
    }

    public function category($id)//show __invoke
    {
        $category ="CATEGORY PAGE id  = ".$id;
        //$route = route('name');
        $route = url('foo','CategoryController@products');
        $data = [
            'name'=>'John',
            'age'=>'20',
            'category' =>$category,
            'id'=>$id
        ];
        if ($route->input('id') == 1)
        {
            //
        }
        //$url = url('foo','CategoryController@products');


        return view('category.products',$data );//User::findOrFail($id) ['user' =>$id ]
    }
}