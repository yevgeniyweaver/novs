@extends('layouts.layout')
@section('title', 'Главная Новостройки')
@section('content')

    <section class="b-navigation-block">
        <div class="b-nav-bg">
            <div class="b-nav-box">
                <div class="b-nav-tabs">
                    <i class="b-nav-icon fa fa-home"></i>
                    <div class="b-nav-home">
                        <?= crumbs::render() ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </section>

<section>
    <div class="builders-bg" >

        <div class="builders-slogan-overlay">
            <div class="builders-slogan" style="<?php if(!empty($dev['builders_bg']  )):?>
                    background-image: url(<?=$builders_bg?>);
            <?php endif; ?>">
                <div style=" display: none;" class="builders-slogan-img-box">
                    <img class="builders-slogan-img"  src="/upload/<?= $dev['logo']? $dev['logo'] : $itemlogo['type_partner_logo'] ?>">
                </div>
                <div class="builders-slogan-name-box">
                    <div class="builders-slogan-name">
                        Компания является официальным партнером
                        строительной компании. Объекты продаются без какой либо комиссии.
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

        </div>


    </div>
</section>



<section class="b-build-complex">
    <div class="b-complex-box">
        <script type="text/javascript">

        </script>
        <!--        <div class="b-complex-objects">-->
        <!--            <div class="b-complex-objects-item" data-status="">Все объекты</div>-->
        <!--            <div class="b-complex-objects-item" data-status="nocomplite">Строящиеся дома</div>-->
        <!--            <div class="b-complex-objects-item" data-status="complite">Сданые</div>-->
        <!--            <div class="b-complex-objects-item" data-status="new">NEW предложения</div>-->
        <!--            <div class="clear"></div>-->
        <!--        </div>-->
        <!---->
        <!--        <div class="b-complex-districts-box">-->
        <!---->
        <!--           -->
        <!--            <div class="b-complex-districts">-->
        <!---->
        <!--                <div id="b-complex-districts-item" class="b-complex-districts-item" data-region="Приморский">Приморский-->
        <!--                    район-->
        <!--                </div>-->
        <!--                <div id="b-complex-districts-item" class="b-complex-districts-item" data-region="Киевский">Киевский-->
        <!--                    район-->
        <!--                </div>-->
        <!--                <div id="b-complex-districts-item" class="b-complex-districts-item" data-region="Суворовский">-->
        <!--                    Суворовский район-->
        <!--                </div>-->
        <!--                <div id="b-complex-districts-item" class="b-complex-districts-item" data-region="Малиновский">-->
        <!--                    Малиновский район-->
        <!--                </div>-->
        <!--                <div class="clear"></div>-->
        <!--            </div>-->
        <!--        </div>-->


        <div class="b-complex-item-block">
            <div class="jk-box">
                @foreach($dev_objects as $rec)
                    @include('chunk.jk', ['rec' => $rec])
                @endforeach
            </div>

            <div class="clear"></div>
            <div id="pages_wrapper">
<!--                --><?//= $this->v->paginationHtml ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>


    <div class="clear"></div>


</section>

<section class="b-map-section">

    <div class="b-map-bg">
        <div class="b-map-btn-block">
            <div class="b-map-btn">
                Все новострои от <?= $dev['tree_title'] ?> на карте
            </div>
        </div>
        <div id="builders-map" class="map"></div>
        <div class="clear"></div>
    </div>

    <script  type="text/javascript"
             src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJayBbXrok0QV_ccteOE-EVycW7mNHDD4"></script>
    <script async defer type="text/javascript" src="/usr/js/map.js"></script>
    <script async defer type="text/javascript" src="/usr/js/builders-map.js"></script>
    <div class="clear"></div>
</section>

<section class="b-steps-section">
    <div class="b-steps">
        <div class="b-steps-title">
            3 простых шага <br>
            и квартира ваша!
        </div>
        <div class="b-steps-box">
            <div class="b-steps-col">
                <div class="b-steps-col-title1">
                    <div class="b-step-word">
                        шаг
                    </div>
                    <div class="b-step-number">
                        1
                    </div>

                </div>
                <div class="b-steps-col-title2">
                    Заявка
                </div>
                <div class="b-steps-col-word">
                    Оформите заявку или позвоните нашему<br> специалисту для предварительной<br> консультации.
                </div>
            </div>

            <div class="b-steps-col">
                <div class="b-steps-col-title1">
                    <div class="b-step-word">шаг</div>
                    <div class="b-step-number">2</div>
                </div>
                <div class="b-steps-col-title2">Осмотр</div>
                <div class="b-steps-col-word">
                    Встреча в офисе, детальная консультация, ответы на вопросы, осмотр понравившихся вариантов.
                </div>
            </div>

            <div class="b-steps-col">
                <div class="b-steps-col-title1">
                    <div class="b-step-word">
                        шаг
                    </div>
                    <div class="b-step-number">
                        3
                    </div>
                </div>
                <div class="b-steps-col-title2">
                    Ключи от вашей квартиры
                </div>
                <div class="b-steps-col-word">
                    Заключение сделки, с полным<br> юридическим сопровождением. Оплата<br> по цене застройщика без
                    комисии.
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section>

<!--<section class="b-detail-form">-->
<!--    <div class="b-detail-form-bg" style="background-color:--><?//= $this->v->builders['color'] ?><!--">-->
<!--        <div class="b-detail-form-title">-->
<!---->
<!--            <div class="b-detail-form-head">-->
<!--                Шаг 1.<br>-->
<!--                Получение детальной информации<br>-->
<!--            </div>-->
<!---->
<!--            <div class="b-detail-form-podrobnee">-->
<!--                Оставьте заявку и наши специалисты свяжутся с вами<br> в течении 20 минут.-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="b-detail-form-border">-->
<!--            <div class="b-detail-form-box">-->
<!--                <form action="/ajax/forms/details" class="ajax_form" method="post">-->
<!---->
<!--                    <div class="b-detail-form-place">-->
<!--                        <input type="text" name="name" placeholder="Как вас зовут" class="b-detail-form-field" style="border-color: --><?//= $developer['color'] ?><!--">-->
<!--                    </div>-->
<!---->
<!--                    <div class="b-detail-form-place">-->
<!--                        <input type="text" id="b-detail-form-phone" name="phone" class="b-detail-form-field" style="border-color: --><?//= $developer['color'] ?><!--">-->
<!--                    </div>-->
<!---->
<!--                    <div class="b-detail-form-place">-->
<!--                        <input type="text" name="email" placeholder="ваш e-mail" class="b-detail-form-field" style="border-color: --><?//= $developer['color'] ?><!--">-->
<!--                    </div>-->
<!---->
<!--                    <div class="clear"></div>-->
<!---->
<!--                    <div id="_form_note_details" class="_form_note">-->
<!---->
<!--                        <div class="form_note_label">-->
<!---->
<!--                        </div>-->
<!--                        <div class="clear"></div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="b-detail-form-submit">-->
<!--                        <input type="submit" class="b-detail-form-submit-btn" value="Отправить">-->
<!--                    </div>-->
<!--                    <div class="clear"></div>-->
<!--                </form>-->
<!---->
<!--            </div>-->
<!--            <div class="clear"></div>-->
<!--        </div>-->
<!--        <div class="clear"></div>-->
<!---->
<!--    </div>-->
<!---->
<!--</section>-->

<?php if (isset($this->v->builders['text']) && !empty($this->v->builders['text'])): ?>
<section class="b-seo-block">
    <div class="b-seo-block" <?= jm_Editor::data($this->v->builders['tree_id']) ?>>
        <h1 class="b-seo-title">
            <?= $this->v->builders['h1'] ?>
        </h1>
        <div class="b-seo-block">
            <p class="b-seo-tabul">
                <?= $this->v->builders['text'] ?>
            </p>
        </div>
    </div>
</section>
<?php endif; ?>

@endsection
