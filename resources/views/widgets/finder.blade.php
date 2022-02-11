<?php
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
$rooms = array('Сданные', 2018, 2019, 2020, '2021+');
foreach ($rooms as $key =>$value){
    //vd1($key);
    //vd1((Input::has('year') && in_array($value, Input::get('year'))) ? "selected='selected'" : "");
}

//vd1(in_array(2018,Input::get('year')));
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

<div class="find-page-form-bg">

    <div class="find-page-form-content">
        <div class="find-page-form-cont">
            <form action="" id="main-find-inner" method="get">
                <div class="find-form-box">
                    <script type="text/javascript">
                        var newjk = <?= Input::has('newjk_input') ? 1 : 0 ?>;
                        var complitejk = <?= Input::has('complitejk_input') ? 1 : 0 ?>;
                    </script>

                    <div class="find-page-cont-one">

                        <div class="find-name-input">
                            <div class="find-name-input-box">
                                <input id="find-req" name="req" type="hidden"
                                       value="{{ Input::get('req') or '' }} ">
                                <input id="find-type" name="type" type="hidden"
                                       value="{{ Input::get('type') or '' }}">
                                <input id="find-id" name="id" type="hidden" value="{{ Input::get('id') or '' }}">

                                <input id="find-name-input" class="m-inpt bd-params" name="query" type="text"
                                       placeholder="Название ЖК, район города, улица или застройщик"
                                       value="{{ Input::has('query')? htmlspecialchars(Input::get('query')) : '' }}"
                                       autocomplete="off">
                                <div class="find-name-dropdown-block">

                                </div>
                                <div class="find-invisible-field">

                                </div>
                            </div>
                        </div>


                        <div  class="find-page-city">
                            <input id="find-city" name="city" type="hidden"
                                   value="<?= Input::has('city')? Input::get('city') :'' ?>">
                            <div class="find-page-city-chbx bd-params">
                                <span class="city_span">

                                    @if (Input::has('city'))
                                        <?= Input::get('city') ?>
                                    @else
                                        Выберите город
                                    @endif

                                </span>
                                <i class="find_icon fa fa-chevron-down"></i>
                            </div>

                            <div class="find-page-city-drop drop_class">

                                <div id="city_reset" class="find-page-city-drop-item">
                                    Выберите город
                                </div>
                                <div class="find-page-city-drop-item act" data-city="г.Одесса">
                                    Одесса
                                </div>
                                <div class="find-page-city-drop-item" data-city="г.Черноморск">
                                    Черноморск
                                </div>
                                <div class="find-page-city-drop-item" data-city="пгт Таирово">
                                    пгт Таирово
                                </div>
                                <div class="find-page-city-drop-item" data-city="Авангард">
                                    пгт Авангард
                                </div>

                                <div class="find-page-city-drop-item" data-city="пгт. Великодолинское">
                                    Великодолинское
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="find-page-cont-two">


                        <!--                        <div class="find-checkbox">-->
                        <!---->
                        <!--                            <button id="find-price-chbx" class="find-price-chbx bd-params" type="button">-->
                        <!--                                <div id="find-price-first">-->
                        <!---->
                        <!--                                </div>-->
                        <!---->
                        <!--                                <div class="find-price-divider"></div>-->
                        <!---->
                        <!--                                <div id="find-price-last">-->
                        <!---->
                        <!--                                </div>-->
                        <!---->
                        <!--                                <div class="find-price-text">Цена за м2-->
                        <!--                                    <span class="caret"></span>-->
                        <!--                                </div>-->
                        <!--                            </button>-->
                        <!---->
                        <!--                            <div class="batva">-->
                        <!---->
                        <!--                            </div>-->
                        <!---->
                        <!--                            <div class="find-dropdown-menu">-->
                        <!---->
                        <!--                                <div class="find-dropdown-group">-->
                        <!---->
                        <!---->
                        <!--                                    <input class="find-price-field-1" name="price-first" type="text" placeholder="от"-->
                        <!--                                           value="--><?//= $_GET['price-first'] ?><!--">-->
                        <!---->
                        <!--                                    <hr>-->
                        <!---->
                        <!--                                    <input class="find-price-field-2" name="price-last" type="text" placeholder="до"-->
                        <!--                                           value="--><?//= $_GET['price-last'] ?><!--">-->
                        <!--                                </div>-->
                        <!---->
                        <!--                                <div class="find-dropdown-option">-->
                        <!---->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div  class="find-page-rayon">
                            <input id="find-region" name="region" type="hidden"
                                   value="<?= (Input::has('region')) ? Input::get('region') : '' ?>">
                            <div class="find-page-rayon-chbx bd-params <?=Input::has('region')? '' : 'not_active'?>">
                                <span class="rayon_span">
                                    @if (Request::has('region'))
                                        <?= Input::get('region') ?>
                                    @else
                                        Выберите район
                                    @endif
                                </span>
                                <i class="find_icon fa fa-chevron-down"></i>
                            </div>
                            <div class="find-page-rayon-drop drop_class">

                                <div id="rayon_reset" class="find-page-rayon-drop-item act">
                                    Выберите район
                                </div>
                                <div class="find-page-rayon-drop-item" data-rayon="Центр">
                                    Центр
                                </div>
                                <div class="find-page-rayon-drop-item" data-rayon="Приморский">
                                    Приморский
                                </div>
                                <div class="find-page-rayon-drop-item" data-rayon="Киевский">
                                    Киевский
                                </div>
                                <div class="find-page-rayon-drop-item" data-rayon="Малиновский">
                                    Малиновский
                                </div>
                                <div class="find-page-rayon-drop-item" data-rayon="Слободка">
                                    Слободка
                                </div>
                                <div class="find-page-rayon-drop-item" data-rayon="Суворовский">
                                    Суворовский
                                </div>
                            </div>
                        </div>

                        <div class="find-page-room">

                            <select class="find-page-room-chbx bd-params" multiple name="rooms[]" title="">

                                <?php

                                $rooms = array(1=>'1-комнатные',2=>'2-комнатные', 3=>'3-комнатные', 4=>'4-комнатные', 5=>'5+-комнатные');

                                foreach ($rooms as $key =>$value){
                                    ?>
                                    <option <?= (Input::has('rooms') && in_array($key, Input::get('rooms'))) ? "selected='selected'" : ""; ?> value="<?= $key ?>">
                                        <?= $value ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="find-page-cont-three">
                        <div class="find-page-price-box">
                            <div class="find-page-price-f">
                                <input  class="f-p-price-input" name="price_min" type="text" placeholder="Цена от"
                                        value="{{ Input::has('price_min')? Input::get('price_min'): '' }}">
                            </div>

                            <div class="find-page-hr-box">
                                <hr class="find-page-hr">

                            </div>

                            <div class="find-page-price-l">
                                <input  class="f-p-price-input" name="price_max" type="text" placeholder="Цена до"
                                        value="{{ Input::has('price_max')? Input::get('price_max'): '' }}">
                            </div>
                        </div>

                    </div>

                    <div class="find-page-cont-four">



                        <div  class="find-page-year">

                            <select class="find-page-year-chbx bd-params" multiple name="year[]">

                                <?php

                                $rooms = array('Сданные', 2018, 2019, 2020, '2021+');
//                                print_r(in_array(2018, Input::get('year')));
                                foreach ($rooms as $value) : ?>
                                    <option <?= (Input::has('year') && in_array($value, Input::get('year'))) ? "selected='selected'" : ""; ?> value="<?= $value ?>">
                                        <?= $value ?>
                                    </option>
                                <?php endforeach; ?>
                                <!--                                <i class="find_icon glyphicon glyphicon-chevron-down"></i>-->
                            </select>

                        </div>

                        <div class="find-page-state">
                            <div class="find-page-state-box">
                                <div class="find-state-new-checkbox find_state_check">
                                    <input id="state_new" class="find-state" name="newjk_input" {{ Input::has('newjk_input') ? 'checked="checked"' : '' }}  type="checkbox"  value="<?=  Input::has('newjk_input') ? 1 : 0 ?>">
                                    <label for="state_new">Новый</label>
                                </div>
                                <div class="find-state-old-checkbox find_state_check">
                                    <input id="state_old" class="find-state" name="complitejk_input" {{ Input::has('complitejk_input') ? 'checked="checked"' : '' }}  type="checkbox" value="<?= Input::has('complitejk_input') ? 1 : 0 ?>">
                                    <label for="state_old">Сдан</label>
                                </div>
                            </div>

                            <div class="clear"></div>
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="find-page-cont-five">

                        <div class="find-page-map-box jlink flink" data-link="/map.html">
                            <div class="find-page-map-btn">
                                <i class="map-one-icon fa fa-map-marker"></i>Поиск на карте
                            </div>
                        </div>

                        <div class="find-page-submit">
                            <input class="m-sbmt bd-params" type="submit" value="Найти">
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>






                <!--                <div class="flat-box">-->
                <!--                    <div class="find-block-2">-->
                <!--                        <div class="find-block-box">-->
                <!---->
                <!--                            <div class="word-sostojanie">Состояние</div>-->
                <!--                            <div class="find-block-sostojanie">-->
                <!--                                <input id="newjk_input" name="newjk_input" type="hidden"-->
                <!--                                       value="--><?//= $_GET['newjk_input'] ? 1 : 0 ?><!--">-->
                <!---->
                <!--                                <button-->
                <!--                                        id="find-btn-new"-->
                <!--                                        type="button"-->
                <!--                                        name="newjk_btn"-->
                <!--                                        class="btn-new-old bd-params --><?//= $_GET['newjk_input'] ? 'find_status_active' : '' ?><!--">-->
                <!--                                    Новый-->
                <!--                                </button>-->
                <!---->
                <!--                                <input id="complite_input" name="complitejk_input" type="hidden"-->
                <!--                                       value="--><?//= $_GET['complitejk_input'] ? 1 : 0 ?><!--">-->
                <!---->
                <!--                                <button-->
                <!--                                        id="find-btn-complite"-->
                <!--                                        type="button"-->
                <!--                                        name="complitejk_btn"-->
                <!--                                        class="btn-new-old bd-params --><?//= $_GET['complitejk_input'] ? 'find_status_active' : '' ?><!--">-->
                <!--                                    Сдан-->
                <!--                                </button>-->
                <!---->
                <!--                            </div>-->
                <!---->
                <!--                            <div class="date-checkbox">-->
                <!--                                <select class="date-chbx bd-params" type="checkbox" name="year_complite">-->
                <!--                                    --><?php
                //                                    if ($_GET['year_complite']):?>
                <!--                                        <option>--><?//= $_GET['year_complite'] ?><!--</option>-->
                <!--                                    --><?php //else :
                //                                        ?>
                <!--                                        <option>Год завершения</option>-->
                <!--                                    --><?php //endif; ?>
                <!--                                    --><?php //for ($yearComplite = 2005; $yearComplite < 2030; $yearComplite++): ?>
                <!--                                        <option>--><?//= $yearComplite ?><!--</option>-->
                <!--                                    --><?php //endfor; ?>
                <!--                                </select>-->
                <!--                            </div>-->
                <!--                            <div class="find-block-clean">-->
                <!--                                <button id="find-btn-clean" value="">Очистить фильтры</button>-->
                <!--                            </div>-->
                <!--                            -->
                <!--                            <div class="clear"></div>-->
                <!--                        </div>-->
                <!--                        <div class="clear"></div>-->
                <!--                    </div>-->
                <!--                    -->
                <!--                    <div class="clear"></div>-->
                <!--                </div>-->

            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>