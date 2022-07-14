<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\News;


class NewsController extends Controller
{

    public function news()
    {
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
            ->paginate(10);

        return view('news.news', compact('news','title') );
    }

    public function show(string $id)
    {
        $new = News::find($id);

        return view('news.show', compact('new') );
    }
}
