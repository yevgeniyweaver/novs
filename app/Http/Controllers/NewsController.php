<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use DB;


// Получить текущего аутентифицированного пользователя...

class NewsController extends Controller
{
    //

    public function news()//show __invoke $id
    {
        //return view('user.profile')->with(['id' => 'James','user'=>'eee']);
        $news = DB::table('type_news as news')
            ->leftJoin('tree', 'news.type_news_id', '=', 'tree.tree_id')
            ->select('news.type_news_id as id',
                'news.type_news_new_date as new_date',
                'news.type_news_image as image',
                'news.type_news_content as content',
                'news.type_news_header1 as header1',
                'tree.tree_name as name'
            )
            ->orderBy('new_date', 'desc')
            //->get();
            ->paginate(10);

//        $user = Auth::user();
//        if (Auth::check()){ var_dump($user->name); }

        //$title = "News Page";
        return view('news.news', compact('news','title') );
    }

    public function show($id)//show __invoke $id
    {
        vd1($id);
        //return view('user.profile')->with(['id' => 'James','user'=>'eee']);
        $link =App\News::find($id);
        //$link = App\Link::find($id);
        //dd($link);
        return view('news.show', compact('new') );
    }
}
