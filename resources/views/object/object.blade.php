@extends('layouts.layout')
{{--@section('title', 'Главная Новостройки')--}}
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

<div class="newjk-bg">
    <section class="b-jk-info">
        <div class="b-jk-box">
            <div class="b-jk-box-left">
                <div class="bg_white st-pad">
                    <section>
                        <div class="b-jk-up-overlay">
                            <div class="b-jk-up-block">
                                <div class="b-jk-up-box ">
                                    <div class="b-jk-up-left">

                                        <div class="b-jk-up-info">
                                            <h1 itemprop="name" class="b-jk-up-name">{{$object['orient']}}</h1>
                                            <div class="b-jk-up-srok" style="color: <?= $dev['color'] ? $dev['color'] : '#9d9d9c'?>;"></div>
                                            <div class="b-jk-up-adress">
                                                <i class="fa fa-map-marker b-jk-up-adress-marker">
                                                </i>
                                                <span><?=str_replace("г.", '', $object['city'])?>/</span>
                                                <span class=""><?=str_replace("г.", '', $object['region'])?>/</span>
                                                <span class=""><?=$object['street']?></span>
                                            </div>

                                            <div class="b-jk-stars-block">

                                            </div>
                                            <div class="b-jk-m2-price" style="color: <?= $dev['color'] ?>">от <?= $object['price']; ?> <?=$object['price_cur_word'];?>/м</div>
                                            <?php if(isset($this->v->updatePrice)){?>
                                            <div class="b-jk-price-date">
                                                Цена от <?=$this->v->updatePrice?> по данным компании застрощика
                                            </div>
                                            <?php }?>

                                        </div>
                                    </div>

                                    <div class="b-jk-up-right">

                                        <div class="b-jk-up-logo">
                                            <a href="/"><img class="b-jk-up-img"  src="http://novostroika.od.ua/upload/<?= $dev['logo']? $dev['logo'] : $itemlogo['type_partner_logo'] ?>"></a>
                                        </div>
                                        <a class="jlink flink b-jk-up-another-jk" data-link="/">
                                            На страницу застройщика
                                        </a>
                                        <div id="b-jk-fav"  class="b-jk-up-fav-box" data-id="<?=$object['id']?>">
                                            <i class="fa b-jk-up-fav-icon"></i>
                                            <span class="b-jk-up-fav-span"></span>
                                        </div>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </section>


                    <div class="clear"></div>

                    <?php

                    if($object['action'] == 1 && strtotime($object['action_start'])<time() && (strtotime($object['action_date'])>time() || $object['action_permanent']) ){?>
                    <section>
                        <div id="action-block" class="b-jk-action">
                            <div class="b-jk-action-img">
                            </div>
                            <div class="b-jk-action-text">
                                <?=$object['action_text']?>
                            </div>

                        <?php if($object['action'] == 1){?>

                            <?php } ?>

                        </div>
                    </section>
                    <?php } ?>



                    <div class="b-jk-navi-block">
                        <?php if($actionCount>0){?>
                        <div data-link="#newjk-akcii" class="b-jk-navi-item jlink flink">
                            Акции
                        </div>
                        <?php } if(!empty($jk_plans)){?>
                        <div data-link="#newjk-plans" class="b-jk-navi-item jlink flink">
                            Планировки
                        </div>
                        <?php } if(!empty($jk_options['constructive'])){?>
                        <div data-link="#newjk-options" class="b-jk-navi-item jlink flink">
                            Характеристики
                        </div>
                        <?php }?>
                        <div data-link="#newjk-map" class="b-jk-navi-item jlink flink">
                            ЖК на карте
                        </div>
                        <?php if(!empty($jk_build_status['content'])){?>
                        <div data-link="#newjk-status" class="b-jk-navi-item jlink flink">
                            Состояние
                        </div>
                        <?}?>
                        <div data-link="#newjk-about" class="b-jk-navi-item jlink flink">
                            Описание
                        </div>
                        <?if(!empty($object['documents'])){?>
                        <div  data-link="#newjk-docs" class="b-jk-navi-item jlink flink">
                            Документы
                        </div>
                    <?}?>

                        <div class="clear"></div>
                    </div>

                    <section>
                        <div id="novjk_slider" class="builders-slider-bg">
                            @include('object._gallery')
<!--                            --><?php //require __DIR__. '_gallery.blade.php' ?>
                        </div>
                    </section>
                </div>


                <?php if(!empty($jk_plans) && !empty($jk_plans[0]['plans_img'] )){?>

                <div id="newjk-plans" class="bg_white st-pad">
                    <section>
                        <h2 class="b-jk-block-title">
                            Планировки <?= $object['orient']; ?>
                        </h2>
                        <div  class="b-jk-plans">
                            <div class="b-jk-plans-left">
                                <div class="b-jk-plans-head">
                                    <div class="plans-h b-jk-plans-h-type">
                                        Тип<i class="jk-plans-icon fa fa-chevron-down"></i>
                                    </div>
                                    <div class="plans-h b-jk-plans-h-square">
                                        Площадь<i class="jk-plans-icon fa fa-chevron-down"></i>
                                    </div>
                                    <div class="plans-h b-jk-plans-h-price">
                                        Цена<i class="jk-plans-icon fa fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="b-jk-plans-body">

                                    <?php
                                    $n = 0;
                                    foreach ($jk_plans as $item){ ?>

                                    <div class="b-jk-plans-item <?= $n== 0? 'plans-item-active':''?>" data-name="<?=$item['types']?>" data-square="<?=$item['square']?> м2" data-price-all="<?=$item['price_all']?> грн." data-price-m="<?=$item['price_m']?> грн/м2" >
                                        <div class="plans-i b-jk-plans-type">
                                            <div class="plans-type-img">
                                                <img src="http://novostroika.od.ua/upload/plans_preview/<?=$item['plans_img']?>">
                                            </div>
                                            <div class="plans-type-name-box">
                                                <div class="plans-type-name"><?=$item['types']?></div>
                                                <div class="plans-type-more"> <?=$item['floor']?></div>
                                            </div>
                                        </div>
                                        <div class="plans-i b-jk-plans-square">
                                            <?=$item['square']?> м<sup>2</sup>
                                        </div>
                                        <div class="plans-i b-jk-plans-price">
                                            <div class="plans-price-all">
                                                <?=$item['price_all']?>
                                            </div>
                                            <div class="plans-price-m">
                                                <?=$item['price_m']?>/м<sup>2</sup>
                                            </div>
                                        </div>
                                        <input type="text"  hidden="hidden" name="plans_preview" value="<?=$item['plans_img']?>"/>
                                    </div>

                                    <?php  $n++; } ?>
                                </div>
                            </div>
                            <div class="b-jk-plans-right">
                                <input type="text" hidden="hidden" class="plans_prev" name="plah">
                                <div class="b-jk-plans-preview" data-img="<?=$jk_plans[0]['plans_img']?>">
                                    <a data-fancybox="plans" class="b-jk-plans-mini-fancy" href="http://novostroika.od.ua/upload/plans/<?=$jk_plans[0]['plans_img']?>">
                                        <img data-img=""  class="b-jk-plans-mini" src="http://novostroika.od.ua/upload/plans_preview/<?=$jk_plans[0]['plans_img']?>">
                                    </a>

                                    <!--                                        <img class="b-jk-plans-zoom" src="/usr/img/zoom.png"/>-->
                                </div>
                                <div class="b-jk-plans-name"><?=$jk_plans[0]['types']?></div>

                                <div class="b-jk-plans-zayava">
                                    <div id="plans-data" data-name="" data-square="" data-price-all="" data-price-m=""></div>
                                    <div id="plans-zayava" class="plans-zayava-btn" data-form="plans" data-query="obj_id=<?=$object['id']?>" data-name="" data-square="" data-price-all="" data-price-m="">
                                        Заявка на осмотр
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </section>
                </div>

                <?php } ?>


                <div class="b-jk-box-right-mobile"></div>


                <?if(!empty($this->v->options['global']) || !empty($this->v->options['engineering']) || !empty($this->v->options['insideparams'])){?>
                <div class="bg_white st-pad">
                    <section id="newjk-options" class="b-jk-params-block">

                        <h2 class="b-jk-block-title">
                            Характеристики <?= $object['orient']; ?>
                        </h2>
                        <div class="b-jk-params">

                            <? if(!empty($this->v->options['global']) ) {
                            $construct = $this->v->options['global'];

                            if(isset($construct['options_build_start_1']) || isset($construct['options_build_end_1'])){?>

                            <div class="b-jk-params-box b-jk-params-data">
                                <div class="b-jk-params-cont">
                                    <div class="b-jk-params-col">

                                        <? if (isset($construct['options_build_start_1'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Начало строительства:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_build_start_1'] ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (isset($construct['options_build_end_1'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Окончание строительства:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_build_end_1'] ?>
                                            </div>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? }?>

                            <? }

                            if(!empty($this->v->options['global']) ) {
                            $construct = $this->v->options['global'];
                            ?>

                            <div class="b-jk-params-box">
                                <div class="b-jk-params-header">
                                    Конструктив дома
                                </div>
                                <div class="b-jk-params-cont">
                                    <div class="b-jk-params-col">

                                        <? if (isset($construct['options_class'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Класс:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_class'] ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (!empty($construct['options_floors'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Этажность:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_floors'] ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (!empty($construct['options_constructive'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Конструктив:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_constructive'] ?>
                                            </div>
                                        </div>

                                        <?} if (!empty($construct['options_house_count'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Кол-во домов:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_house_count'] ?>
                                            </div>
                                        </div>

                                        <?}

                                        if (!empty($construct['options_thermal_insulation'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Утепление:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_thermal_insulation'] ?>
                                            </div>
                                        </div>

                                        <? }

                                        if (!empty($construct['options_inner_walls'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Межквартирные:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_inner_walls'] ?>
                                            </div>
                                        </div>

                                        <? }

                                        if (!empty($construct['options_flats_count'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Кол-во квартир
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_flats_count'] ?>
                                            </div>
                                        </div>

                                        <?}

                                        if (!empty($construct['options_build_start'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Начало строительства:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_build_start'] ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (!empty($construct['options_build_end'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Окончание строительства:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_build_end'] ?>
                                            </div>
                                        </div>
                                        <? } ?>

                                    </div>
                                </div>
                            </div>
                            <? }?>

                            <? if(!empty($this->v->options['engineering']) ) {
                            $state = $this->v->options['engineering']; ?>

                            <div class="b-jk-params-box">
                                <div class="b-jk-params-header">
                                    Состояние квартир
                                </div>
                                <div class="b-jk-params-cont">
                                    <div class="b-jk-params-col">

                                        <!--            Инженерные системы              -->

                                        <?   if (!empty($construct['options_section_count'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Кол-во секций:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $construct['options_section_count'] ?>
                                            </div>
                                        </div>
                                        <? } ?>

                                        <? if (isset($state['options_project_type'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Тип проекта:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_project_type'] ?>
                                            </div>
                                        </div>

                                        <? }

                                        if (!empty($state['options_interior_facing'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Отделка:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_interior_facing'] ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (!empty($state['options_windows'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Окна:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_windows'] ?>
                                            </div>
                                        </div>

                                        <?
                                        }

                                        if (isset($state['options_lift']) && !empty($state['options_lift'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Лифт:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_lift']?>
                                            </div>
                                        </div>
                                        <?
                                        }

                                        if (!empty($state['options_height'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Высота помещения:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_height'] ?>
                                            </div>
                                        </div>

                                        <? }

                                        if (!empty($state['options_foundation'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Фундамент:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_foundation'] ?>
                                            </div>
                                        </div>

                                        <? }


                                        if (!empty($state['options_roof'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Перекрытия, Кровля:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_roof'] ?>
                                            </div>
                                        </div>
                                        <? }
                                        if (!empty($state['options_floor_screed'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Пол:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_floor_screed'] ?>
                                            </div>
                                        </div>
                                        <? }
                                        if (!empty($state['options_facade'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Наружная отделка фасада:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_facade'] ?>
                                            </div>
                                        </div>
                                        <? }


                                        if (!empty($state['options_boiler_room'])) { ?>

                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Отопления:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $state['options_boiler_room'] ?>
                                            </div>
                                        </div>

                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <? }?>

                            <? if(!empty($this->v->options['insideparams']) ) {
                            $inside = $this->v->options['insideparams']; ?>

                            <div class="b-jk-params-box">
                                <div class="b-jk-params-header">
                                    Инженерные системы
                                </div>
                                <div class="b-jk-params-cont">
                                    <div class="b-jk-params-col">

                                        <?php
                                        if (!empty($inside['options_electro'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Электроснабжение:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_electro']?>
                                            </div>
                                        </div>
                                        <?
                                        }
                                        if (!empty($inside['options_water'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Водопровод:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_water']?>
                                            </div>
                                        </div>
                                        <?
                                        }

                                        if (isset($inside['options_flats_count'])&& !empty($inside['options_flats_count'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Кол-во квартир:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_flats_count']  ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (isset($inside['options_flat_health']) && !empty($inside['options_flat_health'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Состояние квартир:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_flat_health'] ?>
                                            </div>
                                        </div>
                                        <? }

                                        if (isset($inside['options_lift']) && !empty($inside['options_lift'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Лифт:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_lift']?>
                                            </div>
                                        </div>
                                        <?
                                        }

                                        if (isset($inside['options_security'])  && !empty($inside['options_security'])) {
                                        ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Безопасность:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_security'] ?>
                                            </div>
                                        </div>
                                        <? }
                                        if (isset($inside['options_parking']) && !empty($inside['options_parking'])) { ?>
                                        <div class="b-jk-params-item">
                                            <div class="b-jk-params-title">
                                                Паркинг:
                                            </div>
                                            <div class="b-jk-params-value">
                                                <?= $inside['options_parking']?>
                                            </div>
                                        </div>
                                        <?
                                        } ?>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        <? }?>

                            <div class="clear"></div>
                        </div>
                    </section>
                </div>

                <? } ?>

                <div id="newjk-map" class="bg_white st-pad">

                    <h2 class="b-jk-block-title">
                        <?= $object['orient']; ?> на карте
                    </h2>
                    <div  class="b-jk-map-bg">
                        <script type="text/javascript">
                            var objects = <?=$mapPoint;?>;
                        </script>
                        <div id="b-map" class="map">

                        </div>
                        <div class="clear"></div>
                    </div>
                </div>


                <?if(!empty($this->v->build_status['content'])){?>
                <div  id="newjk-status" class="bg_white st-pad">
                    <section>
                        <h2 class="b-jk-block-title">
                            Состояние строительства
                        </h2>
                        <div class="b-jk-state">
                            <div class="b-jk-state-box">
                                <div class="b-jk-state-cont">
                                    <div class="b-jk-state-col">
                                        <? foreach($this->v->build_status['content'] as $v) {?>

                                        <div class="b-jk-state-item">
                                            <div class="b-jk-state-title">
                                                <?=$v['bstatus_name']?>
                                            </div>
                                            <div class="b-jk-state-value">
                                                <?=$v['bstatus_value']?>
                                            </div>
                                        </div>

                                        <?}?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <?}?>


                <div class="bg_white st-pad">
                    <h2 class="b-jk-block-title">
                        Описание <?= $object['orient']; ?>
                    </h2>

                    <div id="newjk-about" class="b-jk-text">
                        <div class="b-jk-text">
                            <p class="b-tabul"><?= $object_desc?></p>
                        </div>
                    </div>

                    <div class="bg_white social-block">

                        <div class="flat-social-icons social-likes">
                            <i class="dark-blue-icon fa fa-facebook-square facebook"></i>
                            <i class="blue-icon fa fa-twitter twitter"></i>
                        </div>
                        <div class="flat-social-word">Поделиться</div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <?if(!empty($object['documents'])){
                $docs_array = explode(',',$object['documents']);?>
                <div id="newjk-docs" class="bg_white st-pad">
                    <h2 class="b-jk-block-title">
                        Документы
                    </h2>
                    <div class="b-jk-doc-box">
                        <?php if(in_array('1',$docs_array)){?>
                        <div class="b-jk-doc-item">
                            <div class="b-jk-doc-icon">
                                <img src="/usr/img/icons/document-41.svg"/>
                            </div>
                            <div class="b-jk-doc-word">
                                Есть документы на
                                земельный участок
                            </div>
                        </div>
                        <?}if(in_array('2',$docs_array)){?>
                        <div class="b-jk-doc-item">
                            <div class="b-jk-doc-icon">
                                <img src="/usr/img/icons/document-42.svg"/>
                            </div>
                            <div class="b-jk-doc-word">
                                Есть документы
                                на строительство
                            </div>
                        </div>
                        <?}if(in_array('3',$docs_array)){?>
                        <div class="b-jk-doc-item">
                            <div class="b-jk-doc-icon">
                                <img src="/usr/img/icons/document-43.svg"/>
                            </div>
                            <div class="b-jk-doc-word">
                                Есть лицензия
                                генподрядчика
                            </div>
                        </div>
                        <?}?>
                    </div>
                </div>
                <?}?>

                <? if($actionCount>0){?>
                <div  id="newjk-akcii" class="bg_white st-pad b-jk-akcii-block">
                    <section>
                        <h2 class="b-jk-block-title">
                            Акции от застройщика
                        </h2>
                        <div class="b-jk-action-block">
                            @foreach($action as $rec)
                                @include('chunk.jk', ['rec' => $rec])
                            @endforeach
                            <div class="clear"></div>
                        </div>
                    </section>
                </div>
                <? }?>
            </div>


            <div class="b-jk-box-right">

                <?php if(isset($branches)){?>
                <section id="b-jk-branches-section">
                    <div class="b-jk-branches-block branches_hidden">
                        <div id="show_branches" class="branches-btn">
                            Контакты менеджеров по продаже
                            <!--                    <img style=" margin-left: 20px; width: 20px; height: 20px;" src="/usr/img/branch_chevron.png" class="branch-chevron">-->
                        </div>

                        <div class="b-jk-branches-box ">
                            <?php foreach($branches as $branch){?>
                            <div class="b-jk-branches-item">
                                <div class="branches-icon-bg"><i class="fa fa-phone  branches-icon"></i></div>
                                <div class="branches-cont">
                                    <div class="branches-row">
                                        <div class="branches-address">
                                            <?=$branch['address']?>
                                        </div>
                                        <div class="branches-city">
                                            <?=$branch['city']?>
                                        </div>
                                    </div>
                                    <?php $branch_phones = explode(',',$branch['phone']);?>
                                    <div  class="branches-phone">
                                        <a  class="branches-phone-link" href="tel:<?=$branch_phones[0]?>"> <?=$branch_phones[0]?></a>
                                        <?php if($branch_phones[1]){?>
                                        <a  href="tel:<?=$branch_phones[1]?>">, <?=$branch_phones[1]?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </section>

                <script type="text/javascript">
                    var branches;
                    branches='<?=json_encode($branches)?>';
                </script>
                <?php }?>






                <div class="b-jk-form">
                    <div class="b-jk-form-overlay">
                        <div class="b-jk-input-box">
                            <div class="b-jk-form-head">
                                Запрос информации по объекту
                            </div>
                            <div id="object_question" data-id="<?=$object['id']?>">
                                <form action="{{ route('getObjInfo') }}" class="ajax_form prodaj_form" method="post">

                                    <div class="b-jk-form-field">
                                        <input type="text" name="name" placeholder="Ваше имя" class="jk-input">
                                    </div>
                                    <div class="b-jk-form-field" id="otdelprodaj_q_form_input_second">
                                        <input type="text" id="mob_tel" name="phone" placeholder="Контактный телефон" class="jk-input">
                                    </div>

                                    <input type="hidden" name="obj_id" value="<?=$object['id']?>" >
                                    <div class="clear"></div>

                                    <div id="_form_note_otdelprodaj" class="_form_note">
                                        <div class="form_note_label"></div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="submit">
                                        <input type="submit" class="otdelprodaj-submit-btn" value="Запросить" style="color:<?= $dev['color'] ?>;border-color: <?= $dev['color'] ?>">
                                    </div>
                                    <div class="clear"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>


            <div class="clear"></div>
        </div>
    </section>



    <? if(count($recomended)>0){?>
    <section>
        <div class="b-jk-recommended">
            <div class="b-jk-recommended-block">

                <div class="b-jk-recommended-title">
                    Рекомендуем также посмотреть
                </div>
                <div class="jk-box">
                    @foreach($recomended as $rec)
                        @include('chunk.jk', ['rec' => $rec])
                    @endforeach
                </div>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <?}?>

    <section class="b-jk-map-section">
        <script async type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJayBbXrok0QV_ccteOE-EVycW7mNHDD4"></script>
        <script defer type="text/javascript" src="/js/novs/map.js"></script>
        <script defer type="text/javascript" src="/js/novs/jk-map.js"></script>
        <div class="clear"></div>
    </section>
</div>

@endsection


