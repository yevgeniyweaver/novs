<?php


namespace App\Services;


use App\Models\News;
use App\Traits\MultiDispatch;

class NewsService
{

    use MultiDispatch;

    private const DEFAULT_PARAMS = [
        'limit' => 10,
        'orderBy' => 'new_date',
        'sortBy' => 'DESC'
    ];

    public function getList(?array $filters = []) {

        if (empty($filters)) {
            $filters = $this->getDefaultParams();
        }

        $limit = $filters['limit'];
        $orderBy = $filters['orderBy'];
        $sortBy = $filters['sortBy'];

        $select = [
            'type_news_id as id',
            'type_news_new_date as new_date',
            'type_news_image as image',
            'type_news_content as content',
            'type_news_header1 as header1',
            'tree.tree_name as name'
        ];

//        $news = DB::table('type_news as news')

        $news = (new News())
            ->leftJoin('tree', 'type_news.type_news_id', '=', 'tree.tree_id')
            ->select($select)
            ->orderBy($orderBy, $sortBy)
            ->limit($limit)
            ->get();

        return $news;
    }

    public function getOne(): array {

    }

    public function getDefaultParams(): array {
        return self::DEFAULT_PARAMS;
    }
}