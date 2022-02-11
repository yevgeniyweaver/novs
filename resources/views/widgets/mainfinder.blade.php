<?php use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;

//vd1(Input::get('rooms'));

Input::get('rooms',[]);

//vd1(Input::get('rooms'));
?>




<div class="finder-open-bg">
    <div id="finder-open-btn" class="finder-open-btn" onclick="">
        <div class="finder-open-btn-box">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.6342 22.8675L16.4778 14.7053L16.4624 14.7207C17.8705 12.8709 18.5233 10.5552 18.2886 8.24231C18.054 5.9294 16.9494 3.79202 15.1984 2.26275C13.4474 0.733482 11.1808 -0.0734525 8.85733 0.00526132C6.53387 0.0839752 4.3271 1.04246 2.68362 2.68672C1.04014 4.33099 0.0827141 6.53823 0.00511352 8.86172C-0.072487 11.1852 0.735533 13.4514 2.26564 15.2017C3.79575 16.9519 5.93366 18.0555 8.24668 18.2891C10.5597 18.5226 12.8751 17.8687 14.7242 16.4597L14.7113 16.4726L22.8664 24.6336C23.1008 24.868 23.4186 24.9998 23.75 24.9998C24.0815 24.9999 24.3994 24.8683 24.6338 24.634C24.8682 24.3997 24.9999 24.0819 25 23.7504C25.0001 23.419 24.8685 23.1011 24.6342 22.8667V22.8675ZM9.17192 15.8366C7.85382 15.8366 6.56533 15.4457 5.46937 14.7134C4.37342 13.9811 3.51922 12.9403 3.01481 11.7225C2.51039 10.5048 2.37842 9.16478 2.63556 7.87201C2.89271 6.57924 3.52744 5.39176 4.45947 4.45972C5.39151 3.52769 6.57899 2.89297 7.87176 2.63582C9.16453 2.37867 10.5045 2.51065 11.7223 3.01506C12.94 3.51948 13.9809 4.37367 14.7132 5.46963C15.4455 6.56558 15.8363 7.85408 15.8363 9.17217C15.8361 10.9396 15.1339 12.6346 13.8841 13.8844C12.6344 15.1342 10.9394 15.8364 9.17192 15.8366Z" fill="white"></path>
            </svg>
            <div class="finder-open-btn-word">Поиск новостроев</div>
        </div>
    </div>
</div>

<section class="main-bg">
    <div class="main-find-overlay">
        <div class="main-content">
            <div itemscope="" itemtype="http://schema.org/WebSite" class="main-find">
                <link itemprop="url" href="<?=config('url')?>">
                <div class="main-title">
                    Все новострои Одессы и Черноморска по ценам от застройщика
                </div>

                <form id="main-find-inner" action="/find"  itemprop="potentialAction"
                      itemscope
                      itemtype="http://schema.org/SearchAction">
                    <meta itemprop="target" content="<?=config('url')?>/find?{query}"/>
                    <div class="main-input-cont">

                        <div class="main-find-cont-one">
                            <div class="main-input find-name-input">
                                <div class="find-name-input-box">
                                    <input id="find-req" name="req" type="hidden" value="">
                                    <input id="find-type" name="type" type="hidden" value="">
                                    <input id="find-id" name="id" type="hidden" value="">
                                    <input itemprop="query-input" id="find-name-input" class="m-inpt bd-params" name="query" type="text"
                                           placeholder="Название ЖК, или компании"
                                           value="{{ Input::get('req') or '' }}   " autocomplete="off">
                                    <div class="find-name-dropdown-block"></div>
                                    <div class="find-invisible-field"></div>
                                </div>
                            </div>

                            <div  class="main-find-city">
                                <input id="mainCity" name="city" type="hidden"
                                       value="{{ $_GET['city'] or '' }}">
                                <div class="main-find-city-btn bd-params">
                                    <span class="main_city_span">
                                    <?php
                                    if (isset($_GET['city'])):?>
                                        {{ $_GET['city'] or '' }}
                                    <?php else :?>
                                        Выберите город
                                    <?php endif; ?>
                                    </span>
                                    <i class="find_icon fa fa-chevron-down"></i>

                                </div>
                                <div class="main-find-city-drop drop_class">

                                    <div id="city_reset" class="main-find-city-drop-item act">
                                        Выберите город
                                    </div>
                                    <div class="main-find-city-drop-item act" data-city="г.Одесса">
                                        Одесса
                                    </div>
                                    <div class="main-find-city-drop-item" data-city="г.Черноморск">
                                        Черноморск
                                    </div>
                                    <div class="main-find-city-drop-item" data-city="пгт Таирово">
                                        пгт Таирово
                                    </div>
                                    <div class="main-find-city-drop-item" data-city="Авангард">
                                        пгт Авангард
                                    </div>
                                    <div class="main-find-city-drop-item" data-city="пгт. Великодолинское">
                                        Великодолинское
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="main-find-cont-two">



                            <!--                            <div class="main-find-price">-->
                            <!--                                <button id="m-f-price-chbx" class="m-f-price-btn bd-params" type="button">-->
                            <!--                                    <div id="m-f-price-first"></div>-->
                            <!--                                    <div class="m-f-price-divider"></div>-->
                            <!--                                    <div id="m-f-price-last"></div>-->
                            <!--                                    <div class="m-f-price-text">Цена за м2-->
                            <!--                                        <span class="caret"></span>-->
                            <!--                                    </div>-->
                            <!--                                </button>-->
                            <!--                                <div class="batva"></div>-->
                            <!--                                <div class="m-f-price-dropdown-menu">-->
                            <!--                                    <div class="m-f-price-dropdown-group">-->
                            <!--                                        <input class="find-price-field-1" name="price-first" type="text" placeholder="от"-->
                            <!--                                               value="--><?//= $_GET['price-first'] ?><!--">-->
                            <!--                                        <hr>-->
                            <!--                                        <input class="find-price-field-2" name="price-last" type="text" placeholder="до"-->
                            <!--                                               value="--><?//= $_GET['price-first'] ?><!--" autocomplete="off">-->
                            <!--                                    </div>-->
                            <!--                                    <div class="find-dropdown-option"></div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <!--                        <input id="complite_input" name="complitejk_input" type="hidden"-->
                            <!--                               value="--><?//= $_GET['complitejk_input'] ? 1 : 0 ?><!--">-->


                            <div  class="main-find-rayon">
                                <input id="mainRayon" name="region" type="hidden"
                                       value="<?= (Input::has('region')) ? Input::get('region') : '' ?>">
                                <div class="main-find-rayon-btn bd-params not_active">
                                    <span class="main_rayon_span">

                                        @if (Input::has('region'))
                                            <?= Input::get('region') ?>
                                        @else
                                            Выберите район
                                        @endif

                                    </span>
                                    <i class="find_icon fa fa-chevron-down"></i>
                                </div>

                                <div class="main-find-rayon-drop drop_class">
                                    <div id="rayon_reset" class="main-find-rayon-drop-item act">
                                        Выберите район
                                    </div>
                                    <div class="main-find-rayon-drop-item" data-rayon="Центр">
                                        Центр
                                    </div>
                                    <div class="main-find-rayon-drop-item" data-rayon="Приморский">
                                        Приморский
                                    </div>
                                    <div class="main-find-rayon-drop-item" data-rayon="Киевский">
                                        Киевский
                                    </div>
                                    <div class="main-find-rayon-drop-item" data-rayon="Малиновский">
                                        Малиновский
                                    </div>
                                    <div class="main-find-rayon-drop-item" data-rayon="Слободка">
                                        Слободка
                                    </div>
                                    <div class="main-find-rayon-drop-item" data-rayon="Суворовский">
                                        Суворовский
                                    </div>
                                </div>
                            </div>

                            <!--                            <div  class="main-find-room">-->
                            <!--                                <select class="main-find-room-btn bd-params" multiple name="room[]">-->
                            <!--                                    --><?php
                            //
                            //                                    $rooms = array(1, 2, 3, 4, 'котеджный поселок',);
                            //
                            //                                    foreach ($rooms as $value) : ?>
                            <!--                                        <option --><?//= in_array($value, $_GET['room']) ? "selected='selected'" : ""; ?><!-- value="--><?//= $value ?><!--">-->
                            <!--                                            --><?//= $value ?>
                            <!--                                        </option>-->
                            <!--                                    --><?php //endforeach; ?>
                            <!--                                </select>-->
                            <!--                            </div>-->

                            <div  class="main-find-room">
                                <select class="main-find-room-btn  bd-params" multiple name="rooms[]">

                                    <?php

                                    $rooms = array(1=>'1-комнатные',2=>'2-комнатные', 3=>'3-комнатные', 4=>'4-комнатные', 5=>'5+-комнатные');

                                    foreach ($rooms as $key =>$value) : ?>
                                        <option <?= (Input::has('rooms') && in_array($key, Input::get('rooms'))) ? "selected='selected'" : ""; ?> value="<?= $key ?>">
                                            <?= $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <!--                            <div class="">-->
                            <!--                            --><?php //$rooms_array = explode(',',$_GET['year']); ?>
                            <!--                            <label><input class="rooms-check" data-value="1" --><?//= in_array('1',$rooms_array)? 'checked="checked"' : "" ?><!-- type="checkbox">1 комнатные </label>-->
                            <!--                            <label><input class="rooms-check" data-value="2" --><?//= in_array('2',$rooms_array)? 'checked="checked"' : "" ?><!-- type="checkbox">2 комнатные </label>-->
                            <!--                            <label><input class="rooms-check" data-value="3" --><?//= in_array('3',$rooms_array)? 'checked="checked"' : "" ?><!-- type="checkbox">3 комнатные </label>-->
                            <!--                            <label><input class="rooms-check" data-value="4" --><?//= in_array('4',$rooms_array)? 'checked="checked"' : "" ?><!-- type="checkbox">4 комнатные </label>-->
                            <!--                            <label><input class="rooms-check" data-value="5" --><?//= in_array('5',$rooms_array)? 'checked="checked"' : "" ?><!-- type="checkbox">5+ комнатные </label>-->
                            <!--                                <input id="rooms-check" name="rooms" type="hidden" value="">-->
                            <!--                            </div>-->

                            <div class="clear"></div>

                        </div>


                        <div class="main-find-cont-three">

                            <div class="main-find-price-box">
                                <div class="main-find-price-f">
                                    <input  class="m-f-price-input" name="price_min" type="text" placeholder="Цена от"
                                            value="{{ Input::has('price_min')? Input::get('price_min'): '' }}">
                                </div>

                                <div class="main-find-hr-box">
                                    <hr class="main-find-hr">
                                </div>

                                <div class="main-find-price-l">
                                    <input  class="m-f-price-input" name="price_max" type="text" placeholder="Цена до"
                                            value="{{ Input::has('price_max')? Input::get('price_max'): '' }}">
                                </div>
                            </div>

                        </div>

                        <div class="main-find-cont-four">

                            <div  class="main-find-year">
                                <select class="main-find-year-btn  bd-params" multiple name="year[]">

                                    <?php

                                    $years = array('Сданные', 2018, 2019, 2020,  '2021+');

                                    foreach ($years as $value) : ?>
                                        <option <?= (Input::has('year') && in_array($key, Input::get('year'))) ? "selected='selected'" : ""; ?> value="<?= $value ?>">
                                            <?= $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                    <!--                                <i class="find_icon glyphicon glyphicon-chevron-down"></i>-->
                                </select>
                            </div>

                            <div class="main-find-state">
                                <div class="main-find-state-box">
                                    <div class="state-new-checkbox state_check">
                                        <input id="state_new" class="main-state" name="newjk_input" type="checkbox" value="">
                                        <label for="state_new">Новый</label>
                                    </div>
                                    <div class="state-old-checkbox state_check">
                                        <input id="state_old" class="main-state" name="complitejk_input" type="checkbox" value="">
                                        <label for="state_old">Сдан</label>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="main-find-cont-five">

                            <div class="main-map-find">
                                <a href="/map" class="btn-find-map">
                                    <i class="icon-map fa fa-map-marker"></i>Поиск на карте
                                </a>
                                <div class="clear"></div>
                            </div>

                            <div class="main-submit">
                                <input class="sbmt" type="submit" value="Найти">
                            </div>

                        </div>

                        <div class="clear"></div>
                    </div>
                </form>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>