@extends('layouts.layout')

@section('title', 'Главная Новостройки')
{{--@section('sidebar')--}}
    {{--@parent--}}
    {{--<p>Это дополнение к основной боковой панели.</p>--}}
{{--@endsection--}}

@section('content')


    <section class="popular-complex">
        <div class="popular-block">
            <div class="popular-title">
                Популярные жилые комплексы
            </div>
            <div class="jk-box">
                {{--@each('chunk.jk', $objects, 'req')--}}
                @foreach($objects as $rec)
                    @include('chunk.jk', ['rec' => $rec])
                @endforeach

                <div class="clear"></div>
            </div>
        </div>
    </section>

    <section class="map">
        <div class="map-main-block">
            <div class="map-title">
                Все новострои Одессы на карте
            </div>
            <div class="map-find">
                <a href="/map.html"> Смотреть новострои Одессы на карте<i class="map-show-icon fa fa-chevron-right"></i> </a>
            </div>
            <div class="map-wrap"><div id="object_map" class="map"></div></div>
            <div class="clear"></div>
        </div>
    </section>

    <section>
        <div class="rayon-tab-block">
            <h2 class="rayon-tab-title">
                Все новострои Одессы по районам
            </h2>
            <div class="rayon-tab-box">
                <a href="/primorskiy.html" class="rayon-tab-item">
                    Приморский район
                </a>
                <a href="/malinovskiy.html" class="rayon-tab-item">
                    Малиновский район
                </a>
                <a href="/suvorovskiy.html" class="rayon-tab-item">
                    Суворовский район
                </a>
                <a href="/arcadia.html" class="rayon-tab-item">
                    Аркадия
                </a>
                <a href="/luzanovka.html" class="rayon-tab-item">
                    Лузановка
                </a>
                <a href="/centr.html" class="rayon-tab-item">
                    Центр
                </a>
                <a href="/cheremushki.html" class="rayon-tab-item">
                    Черемушки
                </a>
                <a href="/tairova.html" class="rayon-tab-item">
                    Таирова
                </a>
                <a href="/poskot.html" class="rayon-tab-item">
                    Поселок Котовского
                </a>
                <a href="/moldovanka.html" class="rayon-tab-item">
                    Молдаванка
                </a>
                <div class="clear"></div>
            </div>
        </div>
    </section>

    <section>
        <div class="bg-company">
            <div class="company-block">
                <div class="company-box">
                    <div class="company-title">Строительные компании</div>
                    <?php foreach ($builders as $b) : ?>
                    <?php if ($b->turn_off != "да") {?>
                    <a class="company-item"
                       href="//<?= $b->name . '.' ?>">
                        <div class="gefest-banner">
                            <img class="logo lazyload" src="/img/gefest.jpg">
                        </div>
                        <div class="company-name"><?= $b->name; ?></div>
                    </a>
                    <?php } ?>
                    <?php endforeach; ?>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="news-bg">
            <div class="news-title">Новости застройщиков</div>
            <div class="news-all">
                <a href="/news">Все новости <i class="news-icon fa fa-chevron-right"></i></a>
            </div>
            <div class="news-container">
                <?php foreach ($news as $new) :

                ?>
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
            <div class="clear"></div>
        </div>

    </section>


    <section>
        <div class="bg_blue_grad">

            <div class="van-question-block">
                <div class="mid">
                    <h2 class="van-question-title st-pad-down st-title">
                        Часто задаваемые вопросы о новостройках:
                    </h2>
                    <div class="van-question-box">

                        <div class="van-question-item">
                            <div class="van-q-item-title">
                                Вовремя ли сдаются дома?
                            </div>
                            <div class="van-q-item-text">
                                На сайте представлены объекты только от надежных застройщиков.
                            </div>
                            <div class="van-q-item-icon">
                                <i class="fa  fa-angle-down van-q-item-chevron"></i>
                            </div>
                        </div>
                        <div class="van-question-item">
                            <div class="van-q-item-title">
                                Возможна ли поэтапная оплата?
                            </div>
                            <div class="van-q-item-text">
                                Да, на большинство ЖК есть рассрочка.
                            </div>
                            <div class="van-q-item-icon">
                                <i class="fa  fa-angle-down van-q-item-chevron"></i>
                            </div>
                        </div>
                        <div class="van-question-item">
                            <div class="van-q-item-title">
                                Возможна ли рассрочка в сданном доме?
                            </div>
                            <div class="van-q-item-text">
                                У некоторых застройщиков это возможно. Уточняйте подробности у менеджеров.
                            </div>
                            <div class="van-q-item-icon">
                                <i class="fa  fa-angle-down van-q-item-chevron"></i>
                            </div>
                        </div>
                        <div class="van-question-item">
                            <div class="van-q-item-title">
                                Есть ли акционные скидки на новостройки?
                            </div>
                            <div class="van-q-item-text">
                                Да, на странице <a class="flink jlink" data-link="/akcia.html">акций</a> можно увидеть предложения со сниженными ценами.
                            </div>
                            <div class="van-q-item-icon">
                                <i class="fa  fa-angle-down van-q-item-chevron"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="application/ld+json">
{
    "@context":"https://schema.org",
    "@type":"FAQPage",
    "mainEntity":
    [
         {
            "@type":"Question",
            "name":"Вовремя ли сдаются дома?",
            "acceptedAnswer":
                [{"@type":"Answer",
                    "text":"На сайте представлены объекты только от надежных застройщиков."
                 }]
         },
         {
            "@type":"Question",
            "name":"Возможна ли поэтапная оплата?",
            "acceptedAnswer":
            [{"@type":"Answer","text":"Да, на большинство ЖК есть рассрочка."
            }]
         },
         {
            "@type":"Question",
            "name":"Возможна ли рассрочка в сданном доме?",
            "acceptedAnswer":
            [{"@type":"Answer","text":"У некоторых застройщиков это возможно. Уточняйте подробности у менеджеров."
            }]
         },
         {
            "@type":"Question",
            "name":"Есть ли акционные скидки на новостройки?”?",
            "acceptedAnswer":
            [{"@type":"Answer","text":"Да, на странице акций можно увидеть предложения со сниженными ценами."
            }]
         }
    ]
}
</script>
    <!-- Generated by https://www.matthewwoodward.co.uk/ -->

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJayBbXrok0QV_ccteOE-EVycW7mNHDD4"></script>
    <script>
        var mapAllObjects = <?=$mapAllObjects;?>;
    </script>

    {{--@includeIf('widgets.radio_block', ['some' => 'data'])--}}
{{--@includeIf('widgets.progress_block', ['some' => 'data'])--}}

@endsection
