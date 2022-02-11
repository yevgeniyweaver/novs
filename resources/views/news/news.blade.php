@extends('layouts.layout')
@section('title', 'Page Title')
{{--@section('sidebar')--}}
    {{--@parent--}}
    {{--<p>Это дополнение к основной боковой панели.</p>--}}
{{--@endsection--}}
@section('content')
    {{--@includeIf('widgets.radio_block', ['some' => 'data'])--}}
    {{--@includeIf('widgets.progress_block', ['some' => 'data'])--}}
    {{--@includeIf('widgets.uslugi', ['some' => 'data'])--}}
    {{--@include('widgets.menu', ['some' => 'data'])--}}
    {{--@includeIf('view.name', ['some' => 'data'])--}}

<h1>{{ $title or 'dddd' }}</h1>
<div class="st-main">
    <section class="news">
        <div class="news-bg">
            <div class="news-title">Новости застройщиков</div>
            <div class="news-all">
                <a href="/news.html">Все новости <i class="news-icon fa fa-chevron-right"></i></a>
            </div>
            <div class="news-container">
                <?php foreach ($news as $new) :?>
                <div class="news-item">
                    <div class="news-date"><?=  $new->new_date ?></div>
                    <div class="news-img-box">
                        <img class="news-content_image lazyload" src="upload/st_news.png" style="width: 270px;height: 180px;margin: 10px;">
                    </div>
                    <div class="news-content">

                        <div class="news-content_header">
                            <a href="<?= "/" . $new->name . ".html" ?>"><?= threePointCut($new->header1,65) ?></a>
                        </div>
                        <div class="news-content_text"><?= htmlСut(preg_replace("/<img[^>]+\>/i","",$new->content), 230) ?></div><!-- preg_replace("'<img[^>]*?>.*?>'si","",$news['content'])
                                                                                                                                                                             preg_replace("/<img[^>]+\>/i", "", $news['content'])
                                                                                                                                                                             preg_replace("/<img[^>]+\>/i", "", $news['content'])
                                                                                                                                                 -->
                    </div>
                </div>
                <? endforeach; ?>
                <div class="clear"></div>
            </div>
            {{ $news->appends(['sort' => 'votes'])->links() }}
            <div class="clear"></div>
        </div>

    </section>




    <ul>
    @foreach($news as $new)
            {{--<li><a href="/news/{{$new->id}}">{{$new->title}}</a></li>--}}
    @endforeach
    {{--{{$news}}--}}
    </ul>
    <div>
        Hello, {{ $title or 'Default' }}.
    </div>

</div>
{{--@each('view.name', $jobs, 'job')--}}

@endsection

{{--@foreach ($users as $user)--}}
    {{--@if ($loop->first)--}}
        {{--Это первая итерация.--}}
    {{--@endif--}}

    {{--@if ($loop->last)--}}
        {{--Это последняя итерация.--}}
    {{--@endif--}}

    {{--<p>Это пользователь {{ $user->id }}</p>--}}
{{--@endforeach--}}
{{--@php--}}
    {{--//--}}
{{--@endphp--}}

{{--@foreach ($users as $user)--}}
    {{--@foreach ($user->posts as $post)--}}
        {{--@if ($loop->parent->first)--}}
            {{--Это первая итерация родительского цикла.--}}
        {{--@endif--}}
    {{--@endforeach--}}
{{--@endforeach--}}
{{--@for ($i = 0; $i < 10; $i++)--}}
    {{--Текущее значение: {{ $i }}--}}
{{--@endfor--}}
{{--@if (count($records) === 1)--}}
    {{--Здесь есть одна запись!--}}
{{--@elseif (count($records) > 1)--}}
    {{--Здесь есть много записей!--}}
{{--@else--}}
    {{--Здесь нет записей!--}}
{{--@endif--}}


{{--Для React.js --}}
{{--@verbatim--}}
    {{--<div class="container">--}}
        {{--Hello, {{ $title }}.--}}
    {{--</div>--}}
{{--@endverbatim--}}
