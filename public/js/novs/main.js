jQuery(function ($) {

    var screenWidth = $(window).width();

    window.onload = function() {
        console.log('on load work');
        //$('.b-jk-stars-block').prependTo('.mc-rate');
        $('.mc-rate').clone().appendTo('.b-jk-stars-block');
        $('.b-jk-stars-block .mc-rate-schema').remove();
        //console.log(branches);
        // if(branches){
        //     var url ="/ajax/builders/filialContacts";
        //     $.ajax({
        //         beforeSend:function(){
        //         },
        //         method: 'POST',
        //         url: url,
        //         data: {branches: branches},
        //         dataType: "html",
        //         success: function(html){
        //             //console.log(html);
        //             $('html #b-jk-branches-section').html(html);
        //         }
        //     });
        // }

        // var url ="/ajax/forms/load?form=onlineform";
        // setTimeout(function() {
        //     $.ajax({
        //         beforeSend:function(){
        //             // $("#jump_block").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><span class="sr-only">Загрузка...</span>');
        //             //loadInfo(true);
        //             //openModal('/ajax/forms/load?form='+$(this).data('form')+'&'+$(this).data('query')+'&'+$(this).data('rayon'));
        //         },
        //         url: url,
        //         dataType: "html",
        //         success: function(html){
        //             // loadInfo(false);
        //             $("#onlineform").html(html);
        //             $('html #flag_phone').mask("+380(99)999-99-99");
        //             //cb();
        //         }
        //     });
        //     // $.ajax({
        //     //     url: '/ajax/onlineForm/isUser',
        //     //     method: 'post',
        //     //     data: {userId: isUser},
        //     //     dataType: 'HTML'
        //     // }).done(function (res) {
        //     //     if(res){
        //     //         $('#isUser').val(isUser);
        //     //         $('#sign_in_btn, #reg_btn').hide();
        //     //         $('.header-user-block').html(res);
        //     //         $('.header-user-box').show();
        //     //         if(screen.width >1024) {
        //     //             $(".header-user-img").on('mouseover', function () {
        //     //                 userDropTimer = setTimeout(function () {
        //     //                     $(".header-user-drop").show();
        //     //                 }, 400);
        //     //             }).mouseleave(function () {
        //     //                 clearTimeout(userDropTimer);
        //     //                 $(".header-user-drop").hide();
        //     //             });
        //     //         }else{
        //     //             $(".header-user-img").on('click',function (){
        //     //                 $(".header-user-drop").toggle();
        //     //             } );
        //     //         }
        //     //     }
        //     //     console.log(res);
        //     // });
        // }, 100);
    };

    function isPrime(value, index, array) {

        // var start = 2;
        // while (start <= Math.sqrt(value)) {
        //     if (value % start++ < 1) {
        //         return false;
        //     }
        // }
        // return value > 1;
        for( var key in array){
            if(array[key].indexOf(value) !=-1){
                console.log(array[key]);
            }
        }
    }

    function auto(string,arr) {
        strClear = string.replace(/[^a-zA-ZА-Яа-яЁё]/gi,'').replace(/\s+/gi,', ');
        strLower = strClear.toLowerCase();
        var strCut = strLower;
        var cut =0;
        for(i=0;i<=strLower.length; i++){
            if(!isPrime(strCut,'',arr)){
                strCut =strCut.slice(0, strLower.length-i);
                // if(strCut.length>1){
                //
                // }
                console.log(strCut);
            }else{
                //break; // (*)
                return isPrime(strCut,'',arr);
                //console.log(strLower[i]);
            }
        }
        // for( var key in arr){
        //     if(arr[key].indexOf(strLower) !=-1){
        //         console.log(arr[key]);
        //     }
        // }

    }
    console.log(auto('li',['light','lime','slime','ball']));




    if($('#object_map').length>0){
        console.log('map loaf');
        $('#object_map').find('img').each(function (index, value){
            console.log(value);
        });
    }

    var gallery = $('#gallery');

    if (gallery.length > 0) {
        gallery.slick({
            dots: false,
            slidesToShow: 1,
            centerMode: true,
            adaptiveHeight: true,
            centerPadding: "100px",
            mobileFirst: true,
            variableWidth: true,
            prevArrow: "<button type='button' class='slick-arrow prev'>Previous</button>",
            nextArrow: "<button type='button' class='slick-arrow next'>Next</button>",
            focusOnSelect: true,
            // autoplay: true,
            autoplaySpeed: 5000,
        });
        gallery.show();
    }
    setTimeout(function () {

        var fancyBlock = $('[data-fancybox="photo"]');
        if (fancyBlock.length > 0) {

            fancyBlock.fancybox({
                afterShow: function (instance, current) {
                    instance.activate();
                },
                animationEffect: 'fade',
                thumbs: {
                    autoStart: true,
                    axis: 'x'
                },
            });
        }
    }, 500);

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 90) {
                $('.header-fixed').addClass('header-fixed-active');
                $('#back-top').fadeIn();
            } else {
                $('.header-fixed').removeClass('header-fixed-active');
                $('#back-top').fadeOut();
            }

            if(screenWidth > 1280){
                var bottomStop;
                var bodyHeight = $('body').outerHeight();
                var footerHeight = $('.footer-bg').outerHeight();
                bottomStop = footerHeight;
                if($('.b-jk-recommended').length){

                    bottomStop = bottomStop + $('.b-jk-recommended').outerHeight() +100;
                    console.log($('.b-jk-recommended').outerHeight());
                    console.log(bottomStop);
                    console.log(bodyHeight);
                    console.log($(this).scrollTop());
                }
                bottomStop = bodyHeight  - bottomStop;
                if ($(this).scrollTop() >= 400 && $(this).scrollTop() <= bottomStop) {//3500
                    $('.b-jk-form-overlay').addClass('b-jk-form-fixed');
                }else{
                    $('.b-jk-form-overlay').removeClass('b-jk-form-fixed');
                }
            }else{}
            // if(screenWidth > 1280){
            //     if ($(this).scrollTop() >= 900 && $(this).scrollTop() <= 3500) {
            //         $('.b-jk-form-overlay').addClass('b-jk-form-fixed');
            //     }else{
            //         $('.b-jk-form-overlay').removeClass('b-jk-form-fixed');
            //     }
            // }
        });
// scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });


    // СТАРЫЙ UNITEGALLERY SLIDER
    // var jk_slider = $('#jk_slider');
    // if (jk_slider.length > 0) {
    //     var  jk_slider_gal= jk_slider.unitegallery({
    //         gallery_play_interval: 10000,
    //         gallery_theme: "compact",
    //         gallery_width: 960,
    //         gallery_height: 590,
    //         slider_enable_zoom_panel: false,
    //         gallery_images_preload_type: "minimal",
    //         gallery_pause_on_mouseover: true,
    //         slider_control_zoom: false,
    //         slider_scale_mode: "fit",
    //         gallery_autoplay: true
    //     });
    //     $('.ug-gallery-wrapper .ug-slide-wrapper').css({'background-color':'#E7E7E7'});
    //     $('.ug-gallery-wrapper .ug-strip-panel').css({'background-color':'#E7E7E7'});
    //     $('.ug-slider-control.ug-arrow-right').removeClass('ug-skin-default');
    //     $('.ug-slider-control.ug-arrow-left').removeClass('ug-skin-default');
    //     $('.ug-slider-control.ug-arrow-left').addClass('ug-skin-novjk-left');
    //     $('.ug-slider-control.ug-arrow-right').addClass('ug-skin-novjk-right').css({'left':'unset', 'right': '20px'});
    //     $('.ug-item-wrapper').dblclick(function () {
    //         jk_slider_gal.toggleFullscreen();
    //     });
    // }
    // var mainInput = document.getElementById('find-name-input');
    // mainInput.onkeydown = function(e) {
    //     e = e || window.event;
    //     if (e.keyCode == 13) {
    //         alert('Shift + Enter');
    //         // Вместо алерта - ваш код
    //     }
    //     return true;
    // }



    /*                              КНОПКА ПОКАЗАТЬ ИНФУ ПО ОБЪЕКТУ                          */

    // $('#show_jk_info').on('click', function () {
    //     var jkText = $('.b-jk-text');
    //     if( jkText.hasClass('class_hidden') ){
    //         jkText.removeClass('class_hidden');
    //         $(this).html('Свернуть все');
    //     }else{
    //         jkText.addClass('class_hidden');
    //         $(this).html('Читать все');
    //     }
    // });


    /*                              КНОПКА ПОКАЗАТЬ ФИЛЛИАЛЫ                                */

    // $('#show_branches').on('click', function () {
    //     var branchesBlock = $('.b-jk-branches-block');
    //     var branchesBox = $('.b-jk-branches-box');
    //     var branchesChevron = $('.branch-chevron');
    //     var tim;
    //     if( branchesBlock.hasClass('branches_hidden') ){
    //         setTimeout(function () {
    //             branchesBlock.removeClass('branches_hidden');
    //             branchesBox.show(100);
    //             branchesChevron.css({'transform':'rotate(180deg)'});
    //         }, 100);
    //
    //         // $(this).html('Свернуть все');
    //     }else{
    //         branchesBlock.addClass('branches_hidden');
    //         // $(this).html('Читать все');
    //         branchesBox.hide(100);
    //         branchesChevron.css({'transform':'rotate(360deg)'});
    //     }
    // });

    $("#dd-btn").click(function (e) {
        $("#drop_menu_z").toggle();
    });
    $("#drop_menu_z").on('click', function (e) {
        e.stopPropagation();
    });
    $("#dd-btn2").click(function (e) {
        $("#drop_menu_r").toggle();
    });
    $("#drop_menu_r").on('click', function (e) {
        e.stopPropagation();
    });
    $(document).mouseup(function (e) {
        var dropdownBlock = $(".find-name-dropdown-block");
        var dropdownMenu = $(".find-dropdown-menu");
        var builderDropdownMenu = $(".builder-dropdown-menu");
        var dropClass = $('.drop_class');


        if (!dropdownBlock.is(e.target) && dropdownBlock.has(e.target).length === 0) {
            dropdownBlock.hide();
        }
        if (!dropdownMenu.is(e.target) && dropdownMenu.has(e.target).length === 0) {
            dropdownMenu.hide();
        }
        if (!builderDropdownMenu.is(e.target) && builderDropdownMenu.has(e.target).length === 0) {
            builderDropdownMenu.hide();
        }
        if (!dropClass.is(e.target) && dropClass.has(e.target).length === 0) {
            dropClass.hide();
        }
    });

    $('.header-menu-button').on('click',function () {
        var menuIcon = $(this).find('.icon');
        // $('.icon').click(function(){
        // $(this)
        menuIcon
            .toggleClass('menu')
            .toggleClass('close');
        // });
        var headerBox = $('.header-box');
        var headerMenuIcon = $(this).find('i');
        var headerMenuDrop = $('.menu-wraper');
        // var headerLogoBlock = $('.header-logo-block');
        // var headerPhonesUp = $('.header-phones-up');

        // questionDrop.toggle(200);
        if(headerMenuDrop.is(':visible')==true){
            headerMenuDrop.hide();
            // headerLogoBlock.find('.header-logo-link').show();
            // headerPhonesUp.show();
            // headerBox.removeClass('header-box-fixed');
            // // headerLogoBlock.removeClass('header-logo-hidden');
            // // $('.header-menu-button').removeClass('menu-button-pad');
            // console.log('visible');
            headerMenuIcon.removeClass('fa-close');
            headerMenuIcon.addClass('fa-menu');
            // chevron.css({'transform':'rotate(0deg)'});
        }else{
            // $('.question-drop').hide();
            headerMenuDrop.show();
            headerBox.addClass('header-box-fixed');
            headerMenuIcon.removeClass('fa-menu');
            headerMenuIcon.addClass('fa-close');
        }
    });


    $('#mob_tel').mask("+380(99)999-99-99");
    $('#b-detail-form-phone').mask("+380(99)999-99-99");
    $('#b-footer-form-phone').mask("+380(99)999-99-99");


    /////////////////////////   ВЫПАДАЙКА ДЛЯ ЦЕНЫ ЖК ЗА М2 В ГЛАВНОМ ПОИСКЕ    ////////////////////////////

    $("#find-price-chbx").click(function (e) {

        $(".find-dropdown-menu").toggle();

    });


    //////////////////////////////// ОТМЕТКИ ЖК СЕРДЕЧКОМ /////////////////////////////////////////////////////////

    $('#clearFavourites').on('click', function () {
        if (confirm('Очистить избранное?')) {
            $.ajax({
                url: '/ajax/favorites/clearfavourites',
                method: 'post',
                success: function () {
                    location.reload();
                }
            })
        }
    });

    if (screenWidth <= 1024) {
        // $('#fav').appendTo($('.fav-menu-col'));
        $('#fav').appendTo($('.header-mob-fav'));
    }else if(screenWidth <= 750){
        // $('#fav').appendTo($('.header-mob-fav'));
    }else{

    }
    if(screenWidth <= 1280){
        $('.b-jk-form').appendTo($('.b-jk-tours-form'));
        $('.b-jk-box-right').appendTo($('.b-jk-box-right-mobile'));

    }

    $('#finder-open-btn').on('click',function () {
        // console.log('visible');
        if($('.main-bg, .find-page-form-bg').is(':visible')){
            $(this).hide();
            $(this).parent().hide();
        }else{
            $('.main-bg').show();
            $('.find-page-form-bg').show();
            setTimeout(function(){
                $('.main-bg').addClass('opacity_block');
                $('.main-bg').css({'opacity':'1'});
            },100);

            $(this).hide();
            $(this).parent().hide();
        }
    });


    $('html').on('click', '#b-jk-fav', function (e) {
        e.stopPropagation();
        var id = $(this).data('id');

        if ($(this).find('i').hasClass('fa-heart')) {
            var host = location.host.split('.');
            // var test = host.shift();
            console.log(host);
            if (location.pathname != '/favourites.html') {
                location.href =  '//' + host.join('.') + '/favourites.html';
                console.log('//' + host.join('.') + '/favourites.html');
            }
        }

        $(this).find('i').removeClass('fa-heart-o').addClass('fa-heart');
        $(this).find('span').text('В избранном');
        var fav = document.getElementById('fav');
        fav.setAttribute('href','/favourites.html');
        console.log(fav);
        // fav.href = '/favourites.html';

        if (location.pathname == '/favourites.html') {
            $.ajax({
                url: '/fav/destroyFromFavorites',
                method: 'post',
                data: {id: id},
                success: function () {
                    parent.remove();
                }
            })
        } else {
            $.ajax({
                url: '/fav/ajaxAddtoFavorite',
                method: 'post',
                data: {id: id},
                success: function (data) {
                    $('html #box_fav').css({'display':'block'});
                    $('html #count_fav').text(data);
                    $('html .main-menu-icon').removeClass('fa-heart-o').addClass('fa-heart');
                }
            });
        }
    });

    $('body').on('click', '.red-heart', function (e) {
        e.stopPropagation();
         var url = $(this).data('url');
         console.log(url);
        // var countFav;
        // for(countFav = 0; countFav< countFav.length; countFav++){
        //     console.log(countFav.length);
        //     return countFav++;
        // }
        // var host = location.host.split('.');

        if ($(this).find('i').hasClass('red-heart-active')) {
            var host = location.host.split('.');
            // var test = host.shift();
            console.log(host);
            if (location.pathname != '/favourites') {
                location.href =  '//' + host.join('.') + '/favourites';
                console.log('//' + host.join('.') + '/favourites');
            }
        }

        $(this).find('i').addClass("red-heart-active");
        var fav = document.getElementById('fav');
        fav.setAttribute('href','/favourites.html');
        console.log(fav.getAttribute('href'));
        //fav.href = "favourites.html";
        // fav.href = '/favourites.html';
        // console.log($('#fav').prop('href'));
        // $('#fav').addClass('fav_active');
        var id = $(this).data('id');

        var parent = $(this).parents('.b-complex-item');
        // countFav++;

        if (location.pathname == '/favourites') {
            $.ajax({
                url: '/fav/destroy',
                method: 'post',
                data: {id: id},
                success: function () {
                    parent.remove();
                }
            })

        } else {

                $.ajax({
                    url: '/fav/add',
                    method: 'post',
                    data: {id: id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                    // data+='1';
                        console.log(data);
                      $('html #box_fav').css({'display':'block'});
                      $('html #count_fav').text(data);
                        $('html .main-menu-icon').removeClass('fa-heart-o').addClass('fa-heart');
                    }
                });
        }
    });


    $('#fav').on('click',function (e) {
        if($(this).attr('href')){// e.stopPropagation();
        }else{e.preventDefault();}
    });

    $(".b-tab-click").click(function (e) {
        $(".b-tab-click").removeClass("active-plan-tabs");
        $(this).addClass("active-plan-tabs");
        $(".b-jk-plan-content").hide(200);
        /*$(this).removeClass("active-plan-tabs");*/
        $("#" + $(this).data('item')).show("slow");
        e.stopPropagation();
    });
    //////////////////////////////////    СЛАЙДЫ     /////////////////////////////////////////

    // $(".rslides").responsiveSlides({
    //     prevText: "<",
    //     nextText: ">",
    //     auto: false,
    //     pager: true,
    //     nav: true,
    //     speed: 500,
    //     namespace: "centered-btns"
    // });
    var next;
    ////////////////    ОДИНОЧНЫЙ БЛОК ПОКАЗА ЖК НА СТРАНИЦЕ ЗАСТРОЙЩИКА    ////////////////////////

    $(".b-new-build-main-border").on("click", ".b-new-build-img-next", function () {

        var next = $(this).data('next');
        var builder = $(this).data('builder');

        $.ajax({
            method: "POST",
            url: "/ajax/builders/builders",
            data: {next: next + 1, builder: builder}
        })
            .done(function (builderBlock) {
                $(".b-new-build-main-border").html(builderBlock);
                alert("Data Saved: " + msg);
            });
    });

    $(".b-new-build-main-border").on("click", ".b-new-build-img-last", function () {

        var next = $(this).data('next');
        var builder = $(this).data('builder');

        $.ajax({
            method: "POST",
            url: "/ajax/builders/builders",
            data: {next: next - 1, builder: builder}
        })
            .done(function (builderBlock) {
                $(".b-new-build-main-border").html(builderBlock);
                alert("Data Saved: " + msg);
            });

    });


    ////////////////////////ПОИСК ОБЕКТОВ///////////////////////////

    var status, region = '';

    $(".b-complex-box").on("click", ".b-complex-objects-item, .b-complex-districts-item, .pages_number", function (e) {

        var page = '';
        if ($(this).hasClass('b-complex-objects-item')) {
            $(".b-complex-objects-item").removeClass("active-objects-item");
            $(this).addClass("active-objects-item");
            status = $(this).data('status');
            page = 0;
        } else if ($(this).hasClass('b-complex-districts-item')) {
            $(".b-complex-districts-item").removeClass("active-districts-item");
            $(this).addClass("active-districts-item");
            region = $(this).data('region');
            page = 0;
        } else {
            var href = $(this).attr('href');
            if (href) {
                page = href.replace(/\D+/g, "");
            } else {
                return false
            }
            e.preventDefault();
        }
        //$(".b-complex-districts-item").removeClass("active-districts-item");

        //$(this).addClass("active-districts-item");

        $.ajax({
            method: "POST",
            url: "/ajax/builders/objects",
            data: {status: status, builder: developer, region: region, page: page}
        })
            .done(function (complexblock) {
                $(".b-complex-item-block.jk-box").html(complexblock);
            });
    });

    ////////////////////////    ГЛАВНЫЙ ПОИСК FIND    ////////////////////////////////////////////////////////


    $("#find-name-input").keyup(function () {
        if ($(this).val()) {
            $(".find-name-dropdown-block").show();
        } else {
            $(".find-name-dropdown-block").hide();
        }
        var req = $(this).val();
        $.ajax({
            method: "POST",
            url: "/ajax/find/mainfind",
            data: {req: req}
        })
            .done(function (findblock) {
                $(".find-name-dropdown-block").html(findblock);
            });
    });

    ///////////////////////////ПО КЛИКУ НА ЖК, РАЕН В ПОИСКОВОМ БЛОКЕ ЗАПИСЫВАЕТСЯ ПОЛЕ ВВОДА И GET парметры////////////
    $(".find-name-input").on("click", ".find_name_selector_item", function () {

        var value = $(this).data('value');
        var title = $(this).data('title');
        var key = $(this).data('key');
        var id = $(this).data('id');
        clear_all_fields();
        clear_city_region();

        $("#find-name-input").val(title);
        $(".find-invisible-field").html(key);
        $(".find-name-dropdown-block").hide();

        $("#find-req").val(value);
        $("#find-type").val(key);
        $("#find-id").val(id);
        $('#mainRayon').val('');

        $('input[class = find-state]').val('');
        $('.find-state').prop('checked', false);
        $('input[class = main-state]').val('');
        $('.main-state').prop('checked', false);
        $('#main-find-inner').submit();
    });

    $(".find-name-input").on("click", ".find_name_selector_item", function () {
        if ($(this).data('key') == 'likejkregion') {
            var region = $(this).data('value');
            clear_city_region();
            $('input[class = find-state]').val('');
            $('.find-state').prop('checked', false);
            $("#find-region").val(region);
        }
    });


    $('body').on('click','.rooms-check', function(){
        $(this).data('type');
        //$('#rooms-check').val($(this).data('type'));
        var rooms = [];
        var title = [];
        $('.rooms-check').each(function (index, value){
            var elem = $(value);
            if(elem.prop("checked")){
                rooms.push(elem.data('value'));
                // title.push(elem.data('title'));
            }
        });
        console.log(rooms);
        $('#rooms-check').val(rooms);
        // $(this).parent().parent().remove();
    });

    ///////////////////////////////////////////////////////////////////////////////////

    $('.main-state').on('click', function () {
        //$('.main-state').prop('checked', false).val('');
        //$('.main-state').val('');
        $('input[class = main-state]').not( $(this) ).prop('checked', false).val('');
        if($(this).val() == 1){
            $(this).val('')
        }else{
            $(this).val('1');
        }
    });

    $('.find-state').on('click', function () {
        //$('.main-state').prop('checked', false).val('');
        //$('.main-state').val('');
        // $('input[class = find-state]').not( $(this) ).prop('checked', false);
        clear_query_input();
        $('.find-state').not( $(this) ).prop('checked', false);
        $('input[class = find-state]').val('');
        if($(this).val() == 1){
            $(this).val('')
        }else{
            $(this).val('1');
        }
    });

    /*    СТРАНИЦА ПОИСКА                               ВЫПАДАЙКИ ГОРОД  И   РАЙОН                                     */

    var MainCitySpan = $('.main_city_span');
    var MainRayonSpan = $('.main_rayon_span');
    var citySpan = $('.city_span');
    var rayonSpan = $('.rayon_span');

    $('.find-page-city-chbx').on('click', function () {
        $('.drop_class').hide();
        $(".find-page-city-drop").toggle();
    });

    $('.find-page-city-drop-item').on('click', function () {
        var dataCity = $(this).data('city');
        var textCity = $(this).text();
        if($(this).attr('id') == 'city_reset'){
            citySpan.removeClass('class_black');
        }else{
            citySpan.addClass('class_black');
        }
        if(  !$(this).hasClass('act') ){
            $('.find-page-rayon-chbx').removeClass('not_active');
            $('.find-page-rayon-chbx').addClass('not_active');
            rayonSpan.text('Выберите район');
            $('#find-region').val('');
        }else{
            $('.find-page-rayon-chbx').removeClass('not_active');
            // $('.find-page-rayon-chbx').addClass('not_active');
        }
        clear_all_fields();
        $('#find-city').val(dataCity);
        citySpan.html(textCity);
        $(".find-page-city-drop").toggle();
    });


    $('.find-page-rayon-chbx').on('click', function () {
        $('.drop_class').hide();
        $(".find-page-rayon-drop").toggle();

    });

    $('.find-page-rayon-drop-item').on('click', function () {
        var dataRayon = $(this).data('rayon');
        var textRayon = $(this).text();

        if($(this).attr('id') == 'rayon_reset'){
            rayonSpan.removeClass('class_black');
        }else{
            rayonSpan.addClass('class_black');
        }

        if( !$(this).hasClass('act') && $('#find-city').val() != 'г.Одесса'  ){
            $('.find-page-city-chbx').removeClass('not_active');
            $('.find-page-city-chbx').addClass('not_active');
            $('#find-city').val('');
            citySpan.text('Выберите город');
        }else{
            $('.find-page-city-chbx').removeClass('not_active');
        }
        clear_all_fields();
        $('#find-region').val(dataRayon);
        rayonSpan.html(textRayon);
        $(".find-page-rayon-drop").toggle();
    });



    function clear_all_fields() {
        $('#find-name-input').val('');
        $("#find-req").val('');
        $("#find-type").val('');
        $("#find-id").val('');
        $("#find-name-input").val('');
    }
    function clear_city_region() {
        $('#find-region').val('');
        $('#find-city').val('');
        $('.find-page-city-chbx').text('Выберите город');
        $('.find-page-rayon-chbx').text('Выберите район');
    }
    function clear_query_input() {
        $("#find-req").val('');
        $("#find-type").val('');
        $("#find-id").val('');
        $("#find-name-input").val('');
    }
    // $('.find-page-room-chbx').on('click', function () {
    //     $('.drop_class').hide();
    //     $(".find-page-room-drop").toggle();
    // });

    $('.find-page-year-chbx').SumoSelect({
        placeholder: "Год сдачи",
        captionFormat: '{0} выбрано ',
        captionFormatAllSelected: '{0}, все выбраны ',
        forceCustomRendering: true
    });

    $('.find-page-room-chbx').SumoSelect({
        placeholder: "Комнат",
        captionFormat: '{0} выбрано ',
        captionFormatAllSelected: '{0}, все выбраны ',
        forceCustomRendering: true
    });

    $('.main-find-year-btn').SumoSelect({
        placeholder: "Год сдачи",
        captionFormat: '{0} выбрано ',
        captionFormatAllSelected: '{0}, все выбраны ',
        forceCustomRendering: true
    });

    $('.main-find-room-btn').SumoSelect({
        placeholder: "Комнат",
        captionFormat: '{0} выбрано ',
        captionFormatAllSelected: '{0}, все выбраны ',
        forceCustomRendering: true
    });

    $('.find-page-room-chbx, .main-find-room-btn ').on('click',function () {

        $('input[name="complitejk_input"]').prop('checked',false);
        $('input[name="complitejk_input"]').val(0);
        if($(this).val() == 'Сданные'){}
    });
    $(".find-state").on('click',function () {
        // $('.find-page-room-chbx').prop('checked',false);
        $('.find-page-room-chbx').val('');
    });

    /*    ГЛАВНАЯ СТРАНИЦА                               ВЫПАДАЙКИ ГОРОД  И   РАЙОН                                     */

    $('.main-find-city-btn').on('click', function () {
        $('.drop_class').hide();
        $(".main-find-city-drop").toggle();

    });

    $('.main-find-city-drop-item').on('click', function () {
        var dataCity = $(this).data('city');
        var textCity = $(this).text();

        if($(this).attr('id') == 'city_reset'){
            MainCitySpan.removeClass('class_black');
        }else{
            MainCitySpan.addClass('class_black');
        }
        if( !$(this).hasClass('act')  ){
            $('.main-find-rayon-btn').removeClass('not_active');
            $('.main-find-rayon-btn').addClass('not_active');
            $('#mainRayon').val('');
            MainRayonSpan.text('Выберите район');
        }else{
            $('.main-find-rayon-btn').removeClass('not_active');
        }
        $('#mainCity').val(dataCity);
        MainCitySpan.html(textCity);
        $(".main-find-city-drop").toggle();
    });

    $('.main-find-rayon-btn').on('click', function () {
        $('.drop_class').hide();
        $(".main-find-rayon-drop").toggle();
    });

    $('.main-find-rayon-drop-item').on('click', function () {
        var dataRayon = $(this).data('rayon');
        var textRayon = $(this).text();

        if($(this).attr('id') == 'rayon_reset'){
            MainRayonSpan.removeClass('class_black');
        }else{
            MainRayonSpan.addClass('class_black');
        }

        if( !$(this).hasClass('act') && $('#mainCity').val() != 'г.Одесса' ){
            $('.main-find-city-btn').removeClass('not_active');
            $('.main-find-city-btn').addClass('not_active');
            $('#mainCity').val('');
            MainCitySpan.text('Выберите город');
        }else{
            $('.main-find-city-btn').removeClass('not_active');
        }

        $('#mainRayon').val(dataRayon);
        MainRayonSpan.html(textRayon);
        $(".main-find-rayon-drop").toggle();
    });


    // $("#state-new").click(function (e) {
    //     if ($(this).hasClass("find_status_active")) {
    //         $("#newjk_input").val('0');
    //     }
    //     else {
    //         $("#newjk_input").val('1');
    //     }
    //     $(this).toggleClass("find_status_active");
    //     e.stopPropagation();
    // });
    //
    //
    // $("#state-old").click(function (e) {
    //     if ($(this).hasClass("find_status_active")) {
    //         $("#complite_input").val('0');
    //     }
    //     else {
    //         $("#complite_input").val('1');
    //     }
    //     $(this).toggleClass("find_status_active");
    //     e.stopPropagation();
    // });


    $(document).ready(function () {
        if (window.newjk && window.complitejk) {
            if (newjk == "0") {
                $('#find-btn-new').removeClass('find_status_active');
            } else {
                $('#find-btn-new').addClass('find_status_active');
            }
            if (complitejk == "0") {
                $('#find-btn-complite').removeClass('find_status_active');
            } else {
                $('#find-btn-complite').addClass('find_status_active');
            }
        }
    });

    // $(".find-dropdown-field").keypress(function(){
    // });
    $(".find-price-field-1").keyup(function () {
        if ($(this).val() <= 50000) {
            if ($(this).val() || $(".find-price-field-2").val()) {
                $(".m-f-price-text").hide();
                $(".m-f-price-divider").show();
            } else {
                $(".m-f-price-text").show();
                $(".m-f-price-divider").hide();
            }
            $("#m-f-price-first").html($(this).val());
        }
    });

    $(".find-price-field-2").keyup(function () {
        if ($(this).val() <= 50000) {
            if ($(this).val() || $(".find-price-field-1").val()) {
                $(".m-f-price-divider").show();
                $(".m-f-price-text").hide();
            } else {
                $(".m-f-price-text").show();
                $(".m-f-price-divider").hide();
            }
            $("#m-f-price-last").html($(this).val());
        }
    });

     // window.addEventListener("touchstart", func, {passive: true} );
    //window.addEventListener("touchstart", func);

    $(".pages-number").click( function (e) {
        e.stopPropagation();
        $(this).find('a').trigger('click');

    });

    /*                                     GALLERY                                  */

    $('textarea[name="action_text"]').on('keydown',function(e){});
    $('#rayons-drop-btn').on('click', function () {
        setTimeout(function () {
        $('#rayons-drop').toggle();
        }, 200);
    });

    // $(document).ready(function() {
    //
    //     if( typeof timeleft  != 'undefined'){
    //         setInterval(countdown_go,1000);
    //     }
    //     return false;
    //
    // });

    // function countdown_go() {
    //
    //     timeleft_func = timeleft;
    //     id_akcia = akcia_id;
    //
    //      console.log(timeleft_func);
    //     // console.log(id_akcia);
    //
    //     // if( timeleft_func < 10 ){
    //     //     $.ajax({
    //     //         url: "/ajax/admin.php",
    //     //         type: "POST",
    //     //         data: {   func: "deleteAkcia",
    //     //             id: id_akcia},
    //     //         success: function(data){
    //     //             $('.akcia-block').css({'display':'none'})
    //     //         }
    //     //     });
    //     //
    //     // }
    //
    //     // if(countdown_week=='block') {
    //     timevalue = Math.floor(timeleft_func/(7*24*60*60));
    //
    //     //timeleft_func -= timevalue*7*24*60*60;
    //
    //     if(timevalue<10) timevalue = '0'+timevalue;
    //     $("#dayss").html(timevalue);
    //     // }
    //     // if(countdown_day=='block') {
    //
    //     timevalue = Math.floor(timeleft_func/(24*60*60));
    //
    //     timeleft_func -= timevalue*24*60*60;
    //
    //     if(timevalue<10) timevalue = '0'+timevalue;
    //     $("#days").html(timevalue);
    //     // }
    //     // if(countdown_hour=='block') {
    //     timevalue = Math.floor(timeleft_func/(60*60));
    //
    //     timeleft_func -= timevalue*60*60;
    //
    //     if(timevalue<10) timevalue = '0'+timevalue;
    //     $("#hours").html(timevalue);
    //     // }
    //     // if(countdown_minute=='block') {
    //     timevalue = Math.floor(timeleft_func/(60));
    //
    //     timeleft_func -= timevalue*60;
    //
    //     if(timevalue<10) timevalue = '0'+timevalue;
    //     $("#minutes").html(timevalue);
    //     // }
    //     // if(countdown_second=='block') {
    //     timevalue = Math.floor(timeleft_func/1);
    //     timeleft_func -= timevalue*1;
    //     if(timevalue<10) timevalue = '0'+timevalue;
    //     $("#seconds").html(timevalue);
    //     console.log(timevalue);
    //     // }
    //     timeleft-=1;
    //     return false;
    // }


    $('.b-jk-plans-item').on('click', function () {
        console.log('ddd');
        $('.b-jk-plans-item').removeClass('plans-item-active');
        $(this).addClass('plans-item-active');
        var dataName = $(this).data('name');
        var dataSquare = $(this).data('square');
        var dataPriceAll = $(this).data('price-all');
        var dataPriceM = $(this).data('price-m');

        var plansBlock = $(this).parents('.b-jk-plans');
        console.log(plansBlock.data('id'));
        var plansZayavaBtn = plansBlock.find('.plans-zayava-btn');
        plansZayavaBtn.attr('data-name',dataName);
        plansZayavaBtn.attr('data-square',dataSquare);
        plansZayavaBtn.attr('data-price-all',dataPriceAll);
        plansZayavaBtn.attr('data-price-m',dataPriceM);
        var plansForm = $('form[action="/ajax/forms/plans"]');
        var previewImg = $(this).find('input[name="plans_preview"]').val();
        var plansPreview = plansBlock.find('.b-jk-plans-preview');
        var plansMiniFancy = plansBlock.find('.b-jk-plans-mini-fancy');
        var plansMini = plansBlock.find('.b-jk-plans-mini');
        var plansName = plansBlock.find('.b-jk-plans-name');
        plansMiniFancy.attr('href','http://novostroika.od.ua/upload/plans/'+previewImg);
        plansMini.attr('src','http://novostroika.od.ua/upload/plans_preview/'+previewImg);
        plansName.text(dataName);
        plansPreview.data('img',previewImg);
        // $('.b-jk-plans-mini-fancy').attr('href','/upload/plans/'+previewImg);
        // $('.b-jk-plans-mini').attr('src','/upload/plans_preview/'+previewImg);
        // $('.b-jk-plans-name').text(dataName);
        // $('.b-jk-plans-preview').data('img',previewImg);
        console.log($('.b-jk-plans-preview').prop('data-img'));
    });

    $('#plans-zayava').on('click',function () {
        // console.log($(this));
        openModal('/ajax/forms/load?form=plans&name='+$('.plans-item-active').data('name')+'&square='+$('.plans-item-active').data('square')+'&price_all='+$('.plans-item-active').data('price-all')+'&price_m='+$('.plans-item-active').data('price-m')+'&'+$(this).data('query'));
    });

    $('#tours-form').on('click',function () {
        openModal('/ajax/forms/load?form=tours');
    });

    var plansGallery = $('.b-jk-plans-preview');//$("[data-fancybox]");
    if (plansGallery.length > 0) {
        plansGallery.slick({
            dots: false,
            slidesToShow: 1,
            centerMode: true,
            adaptiveHeight: true,
            centerPadding: "100px",
            mobileFirst: true,
            variableWidth: true,
            prevArrow: false,
            nextArrow: false,
            focusOnSelect: true,
            // autoplay: true,
            autoplaySpeed: 5000,
        });
        plansGallery.show();
    }

    setTimeout(function () {

        var fancyPlans = $('[data-fancybox="plans"]');
        if (fancyPlans.length > 0) {

            fancyPlans.fancybox({
                arrows:false,
                 afterShow: function (instance, current) {
                     instance.activate();
                },
                animationEffect: 'fade',
                // thumbs: {
                //     autoStart: false,
                //     axis: 'x',
                //     arrows: false,
                //     loop: false,
                // }
            });
        }
    }, 500);

    // var newjkID = $('#object_question').data('id');

    // $( "#object_question" ).load('/ajax/forms/load?form=object_question&obj_id='+newjkID);

    $( "#footer-handler" ).load('/ajax/forms/load?form=footer_handler');


    $(".van-q-item-icon").on('click',function(){
        //var fullText = $(this).parent().find(".full_text").html();
        var textBlock = $(this).parent().find('.van-q-item-text');
        var questionTitle = $(this).parent().find('.van-q-item-title');
        var chevron = $(this);
        if($(this).parent().hasClass('v-q-full')){
            $(this).parent().removeClass('v-q-full');
            //console.log('open');
            textBlock.hide();
            questionTitle.css({'padding-bottom':'0'});
            // review = review.substring(0, 250);
            // $(this).parent().find('.v-q-item-text').html(review + '...');
            chevron.css({'transform':'rotate(0deg)'});
        }else{
            //console.log('close');
            $(this).parent().addClass('v-q-full');
            questionTitle.css({'padding-bottom':'20px'});
            textBlock.show();
            chevron.css({'transform':'rotate(180deg)'});
            // $(this).parent().find('.v-q-item-text').html( review );
        }
    });
});