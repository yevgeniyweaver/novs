<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="{{ app()->getLocale() }}"><!--<![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1"/>

    {{--<title>@yield('title')</title>--}}
    <title>{!! Meta::get('title') !!}</title>
    {!! Meta::tag('url', Request::url()); !!}
    {!! Meta::tag('site_name', 'My site') !!}
    {!! Meta::tag('description') !!}
    {!! Meta::tag('keywords') !!}
    {!! Meta::tag('image', asset('img/favicon.ico')) !!}

    {{--<meta name="title" content=""/>--}}
    {{--<meta name="description" content=""/>--}}
    {{--<meta name="keywords" content=""/>--}}
    <?php
        //echo "<link rel='canonical' href='".AllConfig::$protocol.AllConfig::$domen.K_Url::get()->getPath()."' />";
    ?>

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:url" content="">
    <meta property="og:type" content="article">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="Все новостройки Одессы">
    <meta property="og:image:width" content="968">
    <meta property="og:image:height" content="504">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link href="/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1"/>


    {{--@php--}}
        {{--echo "<style>";--}}
        {{--include  "/css/novs/inheader.css";--}}
        {{--echo "</style>";--}}
    {{--@endphp--}}
    <link property="" rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css?v=" type="text/css">

    <link rel="stylesheet" href="/css/novs/inheader.css" />


    {{--@if (Route::current()->uri() == '/')--}}

    {{--@endif--}}
    <link rel="stylesheet" href="/css/novs/main-find.css" />
    <link rel="stylesheet" href="/css/novs/finder.css" />
    <link rel="stylesheet" href="/css/novs/main.css" />

    {{--<script async>--}}
        {{--(function () {--}}
            {{--function addFont() {--}}
                {{--var style = document.createElement('style');--}}
                {{--style.rel = 'stylesheet';document.head.appendChild(style);style.textContent = localStorage.sourceSansPro;--}}
            {{--}--}}
            {{--try {--}}
                {{--if (localStorage.sourceSansPro) {// The font is in localStorage, we can load it directly--}}
                    {{--addFont();--}}
                {{--} else {// We have to first load the font file asynchronously--}}
                    {{--var request = new XMLHttpRequest();--}}
                    {{--request.open('GET', '/usr/fonts/exo2/font.css', true);--}}
                    {{--request.onload = function () {--}}
                        {{--if (request.status >= 200 && request.status < 400) {// We save the file in localStorage--}}
                            {{--localStorage.sourceSansPro = request.responseText;// ... and load the font--}}
                            {{--addFont();--}}
                        {{--}--}}
                    {{--};request.send();--}}
                {{--}--}}
            {{--} catch (ex) {// maybe load the font synchronously for woff-capable browsers// to avoid blinking on every request when localStorage is not available--}}
            {{--}--}}
        {{--}());--}}
    {{--</script>--}}

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
        <link rel="stylesheet" href="/plugin/fancybox3.5/jquery.fancybox.min.css" />

</head>

<body itemscope="" itemtype="http://schema.org/WebPage">

<?php

//print_r(\App\Helpers\ThisFavorites::getCountFavourites());

$builders = DB::table('type_partner')->whereRaw('type_partner_turn_off!="да"')->select('*','type_partner_id as id', 'type_partner_name as name')->get();

//vd1($builders);

?>
<?php

use App\Helpers\ThisFavorites;
$rayons = DB::table('tree as t')
//                                ->leftJoin('type_partner as t', 'o.developer', '=', 't.type_partner_id')
    ->select('t.*')
    ->where([ ['t.tree_type','=','rayon']])
    ->whereIn('t.tree_id', [12855, 16650, 16630,16610,16670,16690,16710,19628,19688,19708,19548])
    ->orderBy('t.tree_title', 'asc')->get();
?>
<header id="top" class="header">

    <div class="header-fixed">
        <div class="header-box">
            <div class="header-col brand" data-link="\">
                <div class="header-menu-button"><div class="menu icon"></div></div>
                <div class="header-logo-box" itemscope itemtype="http://schema.org/Organization">
                    <a href="/" itemprop="url"><!--logo_novs.png-->
                        <img itemprop="logo" src="/img/logo_novs.png" class="header-logo" alt="Все новострои Одессы">
                    </a>
                </div>
                <div class="header-mob-fav"></div>
                <div class="clear"></div>
            </div>
            <div class="menu">
                <div class="menu-wraper">
                    <div id="dd-btn2" class="menu-col" style="position: relative">
                        Районы<i class="main-menu-dev-icon fa fa-chevron-down"></i>
                        <div class="drop_menu builder-dropdown-menu" id="drop_menu_r">

                            <div class="drop_menu_box">
                                <div  class="drop_menu_col">

                                    @foreach($rayons as $rayon)
                                        <div class="drop_menu_item">
                                            <a href="/{{$rayon->tree_name}}">{{$rayon->tree_title}}</a>
                                        </div>
                                    @endforeach
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/primorskiy">Приморский район</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/malinovskiy">Малиновский район</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/kievskiy">Киевский район</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/suvorovskiy">Суворовский район</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/arcadia">Аркадия район</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/luzanovka">Лузановка район</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/centr">Центр</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/cheremushki">Черемушки</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/tairova">Таирова</a>--}}
                                    {{--</div>--}}

                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/poskot">Поселок Котовского</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="drop_menu_item">--}}
                                        {{--<a href="/moldovanka">Молдаванка</a>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>

                    <div class="menu-col"><a class="index_link" href="/sdanie">Сданные</a></div>
                    <div class="menu-col"><a class="index_link" href="/novie">Новые</a></div>
                    <div class="menu-col"><a class="index_link" href="/akcia">Акции</a></div>
                    <div class="menu-col"><a class="index_link" href="/kvartiry">Квартиры</a></div>
                    <div class="menu-col"><a class="index_link" href="/kvartiry-s-remontom">Квартиры с ремонтом</a></div>

                    <div id="dd-btn" class="menu-col">
                        Застройщики<i class="main-menu-dev-icon fa fa-chevron-down"></i>
                        <div class="drop_menu builder-dropdown-menu" id="drop_menu_z">

                            <?php

                            //DB::setFetchMode(PDO::FETCH_ASSOC);
                            //$builders = DB::table('type_partner')->whereRaw('type_partner_turn_off!="да"')->select('type_partner_id as id', 'type_partner_name as name')->get();
                            $builders = DB::table('type_partner as d')
                                ->leftJoin('tree as t', 'd.type_partner_id', '=', 't.tree_id')
                                ->whereRaw('d.type_partner_turn_off!="да"')
                                ->select('d.type_partner_id as id',
                                    'd.type_partner_name as name',
                                    'd.type_partner_turn_off as turn_off',
                                    't.tree_name as link',
                                    'd.type_partner_logo as logo')->get();

                            $builders = $builders->toArray();
                            $builders_count = count($builders); $b_quarter  = intval($builders_count/4);
                            ?>

                            <div class="drop_menu_box">
                                <?php
                                $s = 0;
                                foreach ($builders as $b){?>


                                <?php if($s==0 || $s==$b_quarter  || $s==$b_quarter*2 || $s==$b_quarter*3){?>
                                <div  class="drop_menu_col">
                                    <div class="drop_menu_item">
                                        <a href="<?= $b->link?>"><?= $b->name; ?></a>
                                    </div>
                                    <?php }elseif($s==$b_quarter-1 || $s==$b_quarter*2-1 || $s==$b_quarter*3-1 || $s==$builders_count-1){?>
                                    <div class="drop_menu_item">
                                        <a href="<?= $b->link?>"><?= $b->name; ?></a>
                                    </div>
                                </div>

                                <?php }else{?>
                                <div class="drop_menu_item">
                                    <a href="<?= $b->link  ?>"><?= $b->name; ?></a>
                                </div>
                                <?php } ?>


                                <? $s++;  } ?>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div class="fav-menu-col"></div>
                    <div class="clear"></div>
                </div>
                <div class="fav-wraper">
                    <a id="fav" class="index_link" >
                        <i class="fa main-menu-icon <?=!empty(ThisFavorites::getCountFavourites())?'fa-heart':''?>"></i>
                        <span id="count_fav"><?=ThisFavorites::getCountFavourites()?></span>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</header>

<main>

    @if (Route::current()->uri() == '/')
        @includeIf('widgets.mainfinder', ['some' => 'data'])
    @endif


    <div class="content">

        @yield('content')

    </div>
</main>

<footer>
    <div class="footer-bg">
        <div class="footer-contacts">
            <div class="footer-title"><div class="footer-title-t1">Все новострои</div><div class="footer-title-t2">Одессы</div></div>
            <br>
            <div class="official-info">
                <span class="official-info-text">
                     Компания является официальным партнером всех представленных на сайте застройщиков. Объекты продаются без какой либо комиссии.
                </span>
            </div>
            <a class="footer-contacts" href="/otdel-prodaj.html">Контакты</a>
            <div class="vse">Все новострои Одессы</div>
        </div>
        <div class="clear"></div>
    </div>
</footer>


<?php $showJBlock = false;  ?>

<div id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</div>

<div id="blackout" <?= $showJBlock ? 'style="display:block"' : '' ?>></div>
<div id="jump_block" <?= $showJBlock ? 'style="display:block;top:70px"' : '' ?>></div>

<link property="" rel="stylesheet" href="/plugin/sumoselect/sumoselect.css?v=1" type="text/css">
<link rel="stylesheet" href="/css/novs/forms.css" />
<link rel="stylesheet" href="/css/novs/misc.css" />
<link rel="stylesheet" href="/css/novs/builders.css" />

<script src="/js/jquery/jquery-3.1.1.min.js"></script>
<script src="/js/jquery/jquery.form.js"></script>

<script src="/js/jquery.maskedinput.min.js"></script>
<script src="/plugin/sumoselect/jquery.sumoselect.min.js"></script>


<script src="/js/novs/main.js"></script>
<script src="/js/novs/misc.js"></script>


@if (Route::current()->uri() == '/')
    <script src="/js/novs/map.js"></script>
    <script src="/js/novs/main-map.js"></script>
@endif



<script defer src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script defer src="/plugin/fancybox3.5/jquery.fancybox.min.js"></script>


{{--<script defer type="text/javascript">--}}
    {{--$(function() {--}}
        {{--$('body').on('click', '.red-heart', function (e) {--}}
            {{--var url = $(this).data('url');--}}
            {{--var id = $(this).data('id');--}}
            {{--$.ajax({--}}
                {{--url: '{{ route('addfav') }}',--}}
                {{--{{ route('addfav') }}--}}
                {{--type: "POST",--}}
                {{--data: {id:id},--}}
                {{--headers: {--}}
                    {{--'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--console.log(data);--}}
                {{--},--}}
                {{--error: function (msg) {--}}
                    {{--alert('Ошибка');--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--})--}}

{{--</script>--}}


<!--            Для Квартиры с ремонтом                -->
    {{--<script async defer type="text/javascript" src="/usr/js/map.js"></script>--}}
    {{--<script async defer type="text/javascript" src="/usr/js/main-map.js"></script>--}}

<?php //\App\Helpers\ThisFavorites::init()



?>





</body>
</html>
