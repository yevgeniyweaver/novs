
$(document).ready(function(){

    var screenWidth = $(window).width();

    $(window).resize(function(e) {
        var screenWidth = $(window).width();

        // if (screenWidth <= 1130 && screenWidth >780) {
        //     $('#nt_headone_more_drop').addClass('headone_drop');
        //
        // }else if(screenWidth > 1130){
        //     $('#nt_headone_more_drop').removeClass('headone_drop');
        // }
        if (screenWidth <= 780) {

            // $('.header-menu-phones-box').appendTo($('.header-menu-phones-up'));

            $('.header-zayavka-btn').appendTo($('.header-zayavka-mob'));
            // $('.headone_transport').appendTo( $('#nt-headmain-headone') );


        }else{
            $('.header-zayavka-btn').appendTo($('.header-zayavka-block'));
            // //  ВОЗВРАЩАЕМ ВСЕ СТИЛИ И ПЕРЕМЕЩАЕМ БЛОК ВЕРХНЕГО МЕНЮ В ИСХОДНОЕ ПОЛОЖЕНИЕ В ВЕРХНЕЕ МЕНЮ
        }

    });

    if (screenWidth <= 780) {
        $('.header-zayavka-btn').appendTo($('.header-zayavka-mob'));

        // $('#nt-headone-contact').appendTo($('#nt-headone-small'));
        // $('.headone_transport').appendTo( $('#nt-headmain-headone') );
        //
        // $('#nt-headone-big').removeClass('nt-headone-big').removeClass('nt_headone_menu');
        // $('#nt_headone_adaptiv').removeClass('headone_adaptiv');
        // $('#nt_headone_more_drop').removeClass('nt_headone_more_drop').removeClass('headone_drop');
        // $('.headone_transport a').removeClass('nt_headone_menu_item').addClass('nt_headone_dop_item');

    }else{
        $('.header-zayavka-btn').appendTo($('.header-zayavka-block'));
        //  ВОЗВРАЩАЕМ ВСЕ СТИЛИ И ПЕРЕМЕЩАЕМ БЛОК ВЕРХНЕГО МЕНЮ В ИСХОДНОЕ ПОЛОЖЕНИЕ В ВЕРХНЕЕ МЕНЮ
        // $('.headone_transport').appendTo( $('#nt-headone-big ') );
        // $('#nt-headone-contact').appendTo( $('#nt_headone_more_drop') );
        // $('#nt-headone-big').addClass('nt-headone-big').addClass('nt_headone_menu');
        // $('#nt_headone_adaptiv').addClass('headone_adaptiv');
        // $('#nt_headone_more_drop').addClass('nt_headone_more_drop');
        // $('.headone_transport a').removeClass('nt_headone_dop_item').addClass('nt_headone_menu_item');
    }


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
        var headerMenuDrop = $('.header-drop-mob');
        var headerLogoBlock = $('.header-logo-block');
        var headerPhonesUp = $('.header-phones-up');

        // questionDrop.toggle(200);
        if(headerMenuDrop.is(':visible')==true){
            headerMenuDrop.hide();
            headerLogoBlock.find('.header-logo-link').show();
            headerPhonesUp.show();
            headerBox.removeClass('header-box-fixed');
            // headerLogoBlock.removeClass('header-logo-hidden');
            // $('.header-menu-button').removeClass('menu-button-pad');
            console.log('visible');
            headerMenuIcon.removeClass('fa-close');
            headerMenuIcon.addClass('fa-menu');
            // chevron.css({'transform':'rotate(0deg)'});
        }else{
            // $('.question-drop').hide();
            headerMenuDrop.show();
            headerLogoBlock.find('.header-logo-link').hide();
            headerPhonesUp.hide();
            // headerLogoBlock.addClass('header-logo-hidden');
            headerBox.addClass('header-box-fixed');
            // $('.header-menu-button').addClass('menu-button-pad');
            headerMenuIcon.removeClass('fa-menu');
            headerMenuIcon.addClass('fa-close');
        }
    });







    $(".feedback-comment").each(function(){
        var textBlock = $(this).find('.feedback-text');
        var textShort = $(this).find('.feedback-btn');
        var review_full = textBlock.html();
        var review = review_full;
        if( review.length > 200 )
        {
            review = review.substring(0, 180);
            textBlock.html( review + '...'  );
            $(this).append('<div class="read-more"><div class="read-more-btn"><span>Читать полностью</span><i class="fa fa-comments-o read-more-icon"></i></div> </div>');
        }
        $(this).append('<div class="full_text" style="display: none;">' + review_full + '</div>');
    });

    $(".read-more").on('click',function(){
        var fullText = $(this).parent().find(".full_text").html();
        var review = fullText;
        console.log($(this).parent()[0]);
        if($(this).parent().hasClass('feedback-full')){
            review = review.substring(0, 180);
            $(this).find('span').html('Читать далее');
            $(this).parent().removeClass('feedback-full');
            $(this).parent().find('.feedback-text').html(review + '...');
        }else{
            $(this).parent().addClass('feedback-full');
            $(this).parent().find('.feedback-text').html( review );
            $(this).find('span').html('Свернуть');

        }
    });


    $('#menu-item-uslugi').on('click',function () {
        var uslugiDrop  = $(this).find('.header-menu-drop');
        // var questionDrop = $(this).find('.question-drop');
        if(uslugiDrop.is(':visible')){
            uslugiDrop.hide();
            console.log('visible');
        }else{
            uslugiDrop.show();
            console.log('no visible');
        }
    });


    $(document).mouseup(function (e) {
        var radioDropBlock = $(".st-radio-select-drop");
        var uslugiDrop  = $('.header-menu-drop');
        // var dropdownMenu = $(".find-dropdown-menu");
        // var builderDropdownMenu = $(".builder-dropdown-menu");
        // var dropClass = $('.drop_class');


        if (!radioDropBlock.is(e.target) && radioDropBlock.has(e.target).length === 0) {
            radioDropBlock.hide();
        }
        //
            //console.log(e.target);
        // console.log(uslugiDrop.has(e.target).length);
        if (uslugiDrop.has(e.target).length===0) {
            uslugiDrop.hide();
            console.log('sss');
        }
        // if (!builderDropdownMenu.is(e.target) && builderDropdownMenu.has(e.target).length === 0) {
        //     builderDropdownMenu.hide();
        // }
        // if (!dropClass.is(e.target) && dropClass.has(e.target).length === 0) {
        //     dropClass.hide();
        // }
    });

    $('.question-item-box').on('click',function () {
        var chevron = $(this).find('.question-chevron');
        var questionDrop = $(this).find('.question-drop');

        // questionDrop.toggle(200);
        if(questionDrop.is(':visible')==true){
            $('.question-drop').hide();
            console.log('visible');
            //questionDrop.hide(200);
            chevron.css({'transform':'rotate(0deg)'});
        }else{
            $('.question-drop').hide();
            questionDrop.show();
            $('.question-item .question-chevron').css({'transform':'rotate(0deg)'});
            chevron.css({'transform':'rotate(-180deg)'});
        }
    });


    window.onload = function() {
        var url ="/ajax/forms/load?form=onlineform";
            setTimeout(function() {
                $.ajax({
                    beforeSend:function(){
                        // $("#jump_block").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><span class="sr-only">Загрузка...</span>');
                        //loadInfo(true);
                        //openModal('/ajax/forms/load?form='+$(this).data('form')+'&'+$(this).data('query')+'&'+$(this).data('rayon'));
                    },
                    url: url,
                    dataType: "html",
                    success: function(html){
                         //loadInfo(false);
                        // https://some.site/?id=123
                        var parsedUrl = new URL(window.location.href);
                        var type = parsedUrl.searchParams.get("type");
                        // console.log(parsedUrl.searchParams.get("type")); // 123
                        //  console.log(window.location.search);
                        $("#onlineform").html(html);
                        $('html #flag_phone').mask("+380(99)999-99-99");
                        if(type){
                            $('.zaya-type-item input[data-type="'+type+'"]').prop('checked',true);
                            $('.zaya-type-item[data-type="'+type+'"]').addClass('zaya-type-item-active');
                        }
                        //cb();
                    }
                });
                // $.ajax({
                //     url: '/ajax/onlineForm/isUser',
                //     method: 'post',
                //     data: {userId: isUser},
                //     dataType: 'HTML'
                // }).done(function (res) {
                //     if(res){
                //         $('#isUser').val(isUser);
                //         $('#sign_in_btn, #reg_btn').hide();
                //         $('.header-user-block').html(res);
                //         $('.header-user-box').show();
                //         if(screen.width >1024) {
                //             $(".header-user-img").on('mouseover', function () {
                //                 userDropTimer = setTimeout(function () {
                //                     $(".header-user-drop").show();
                //                 }, 400);
                //             }).mouseleave(function () {
                //                 clearTimeout(userDropTimer);
                //                 $(".header-user-drop").hide();
                //             });
                //         }else{
                //             $(".header-user-img").on('click',function (){
                //                 $(".header-user-drop").toggle();
                //             } );
                //         }
                //     }
                //     console.log(res);
                // });
            }, 1000);
    };








    $('#radio-phone').mask("+380(99)999-99-99");


    $('#radio-phone').focus();
    $('#radio-phone').focus(function () {
        $(this).addClass('radio-phone-active');
    }).blur(function(){
        $(this).removeClass('radio-phone-active');
    });
    $('#flag_phone').focus(function () {
        $(this).addClass('radio-phone-active');
    }).blur(function(){
        $(this).removeClass('radio-phone-active');
    });


    $('.st-radio').on('click','.radio',function () {
        $('._form_note').hide();
        var radioInput = $(this).attr('data-input');
        var radioId = $(this).attr('id');
        // console.log(radioId);
        $('.radio').prop('checked',false);
        $(this).prop('checked',true);
        $('.st-radio-select, .st-radio-input').hide().removeClass('st-opacity');
        $('#'+radioInput).show();
        var nNoteHideTimeout = setTimeout(function (n) {
            $('#'+radioInput).addClass('st-opacity');
        }, 250);
        $('.st-radio-btn').val(radioId==='radio_3'? 'Отправить' : 'Далее');

    });

    $('.st-radio-select').on('click',function () {
        var radioCursor = $('.st-radio-cursor');
        radioCursor.hide();
        var targetDrop = $(this).find('.st-radio-select-drop');
        targetDrop.toggle();
        //targetDrop.toggleClass('target-drop-visible');
    });

    function stVipadTitle(self,title){
        var dropItemTitle = self.data('title');
        $(title).text(dropItemTitle);
    }

    $('.st-radio-select-item').on('click',function () {
        stVipadTitle($(this),'.st-radio-select-title .select-title-word');
        $('.st-radio-select-item').removeClass('.st-radio-select-item-active');
        $(this).addClass('.st-radio-select-item-active');
        $('#radio-type').val($(this).data('title'));
        // var targetTitle = $(this).data('title');
        // $('.st-radio-select-title').text(targetTitle);
    });


    function preventDefault(e) {
        e.preventDefault();
        console.log('prevent');
    }

    var preventFlag;

    // if($('._form_note').is(':visible')){
    //     console.log('visible');
    // }else{
    //     console.log('not visible');
    // }



    $('#radio-submit').on('click',function (e) {

        var radioSub = $('.st-radio-input[name="subject"]');
        var radioName = $('.st-radio-input[name="name"]');
        var radioPhone = $('.st-radio-input[name="phone"]');
        var radioInput = $(this).attr('data-input');
        var radioId = $(this).attr('id');

        // if(preventFlag===true){
        //     e.preventDefault();
        // }else{
        //
        // }
       $('.st-radio-input, .st-radio-select').removeClass('field_error');

        $(this).parent().find('.radio').each(function (index, value){
            var elem = $(value);

            //$('.st-radio-input').removeClass('field_error');
            if(elem.prop("checked")){

                if($('#'+elem.data('input')).val().length ==0){

                    $('#'+elem.data('input')).addClass('field_error');
                    console.log('1');
                }else{
                    console.log('2');
                }
            }else{
                console.log('3');
                //$('.st-radio-input').removeClass('field_error');
               //$('#'+elem.data('input')).removeClass('field_error');
            }
        });
        // $("#question").bind("submit", preventDefault);
        // $("form#question").unbind("submit", preventDefault);

        // later, now switching back

        if($('#radio_1').prop('checked')===true && radioSub.val().length != 0){
           if(radioName.val().length == 0 || radioPhone.val().length == 0){
               e.preventDefault();
               console.log('1 full 2 - 3 empty');
           }
            console.log('1 full 2 - 3 full');

        }else if($('#radio_2').prop('checked')===true && radioName.val().length != 0){
            if(radioSub.val().length == 0 || radioPhone.val().length == 0){
                e.preventDefault();
                console.log('2 full 1 - 3 empty');
            }
            console.log('2 full 1 - 3 full');

        }else if($('#radio_3').prop('checked')===true && radioPhone.val().length != 0){
            // e.preventDefault();
            if(radioSub.val().length == 0 || radioName.val().length == 0){
                e.preventDefault();
                console.log('3 full 1 - 2 empty');
            }
            console.log('3 full 1 - 3 full');
        }else{

        }


        if( radioSub.val() ===''){

            $('#radio_1').trigger('click');

        }else if(radioName.val() ===''){

            $('#radio_2').trigger('click');
            // $('#'+$('#radio_2').data('input')).addClass('field_error');

        }else if(radioPhone.val() ===''){

            $('#radio_3').trigger('click');

        }else{

            $('.st-radio-btn').text(radioId==='radio_3'? 'Отправить' : 'Далее');

        }
        if(radioSub.val()!='' && radioName.val()!='' && radioPhone.val()!=''){
            console.log('submit');
            // $('._form_note').show();

        }

    });









    $('html').on('click','.zaya-target-item',function () {
        var word = $(this).find('.target-title-word');
        var targetDrop = $(this).find('.target-drop');
        targetDrop.toggle();
        //targetDrop.toggleClass('target-drop-visible');
    });


    $('html').on('click','.target-drop-item',function () {
        var word = $(this).find('.target-title-word');
        var targetInput = $('#target-input');
        var targetTitle = $(this).data('title');
        $('.target-title-word').text( targetTitle.length>30 ? targetTitle.substring(0, 30)+'...' : targetTitle );// обрезаем строку чтобы галочка не слетала
        targetInput.val( targetTitle.length>30 ? targetTitle.substring(0, 30)+'...' : targetTitle );
    });


    $('html').on('click','.zaya-type-item label',function () {
        console.log('cclick');
        var subject = $(this).find('input[type="checkbox"]').data('subject');
        $('.zaya-type-item input[type="checkbox"]').prop('checked',false);
        $(this).find('input[type="checkbox"]').prop('checked',true);
        $('.zaya-type-item').removeClass('zaya-type-item-active');
        $(this).parent().addClass('zaya-type-item-active');
        $('#subject-input').val(subject);

        //targetDrop.toggleClass('target-drop-visible');
    });


    $('html').on('click', '.online_app_upload_btn',function () {

        var div = document.createElement("div");
        div.className = "upload_files_item";
        div.style = 'display:none;';

        var input = document.createElement("input");
        input.type = "file";
        input.className = "upload_input"; // set the CSS class
        input.name = "upload_doc[]";
        input.value = "";
        input.style = "width:0px; height:0px;";

        var div1 = document.createElement("div");
        div1.className = "upload_photo_box";

        var span = document.createElement("span");
        span.className = "upload_photo_remove"; // set the CSS class

        var i_div = document.createElement("i");
        i_div.className = 'fa fa-close icon_close';

        div.append(input);
        div1.append(span);
        span.append(i_div);
        div.append(div1);

        $('.online_app_upload_files').append(div);

        $(input).trigger('click');

    });


    $('html').on('change', ".online_app_upload_files .upload_input", function () {

        var name_str = $(this).val();
        console.log(name_str);



        var re = '\\';
        var name_arr = name_str.split(re);

        var lastName = name_arr.pop().split('.');
        if (lastName[0].length >= 6) {
            ocenkafileName = lastName[0].substring(0, 14);
        }else{
            ocenkafileName = lastName[0];
        }
        fullFileName = ocenkafileName+'.'+lastName[1];
        $(this).next().append(fullFileName);
        // $(this).next().append(name_arr.pop());

        $(this).parent().css({display: 'block'});
        // ocenkafileName = lastName[0].substring(0, 6);
        //$(this).next().css({display: 'block',  width: '100%'});
        //$(this).next().children().css({display: 'block'});
    });

    $('.online_app_upload_files').on('click', '.upload_photo_remove', function () {
        confirm('Вы уверенны что хотите удалить фото?');
        $(this).parent().parent().remove();
    });


    $('.st-input').on('keypress',function(){

        $('.st-input').removeClass('field_error');

    });

    function warningBorder(element) {
        $('.st-input').removeClass('field_error');
        element.addClass('field_error');
        setTimeout(function () {

            element.removeClass('field_error');
            // nNote.parents('form').find('.radio').each(function (index, value){
            //     var elem = $(value);
            //     if(elem.prop("checked")){
            //
            //         if($('#'+elem.data('input')).val().length ==0){
            //             $('#'+elem.data('input')).addClass('field_error');
            //             console.log('input empty');
            //         }else{
            //             console.log('input full');
            //         }
            //     }else{
            //
            //     }
            // });
        }, 8000);
    }


    function warningGoToField(field) {
        top = field.offset().top;

        //анимируем переход на расстояние - top за 1500 мс

        $('body,html').animate({scrollTop: top}, 1500);
    }






    $('#online-submit').on('click', function () {


        var onlineName = $('.st-input[name="name"]');
        var onlineSurname = $('.st-input[name="surname"]');
        var onlinePhone = $('.st-input[name="phone"]');
        var onlineEmail = $('.st-input[name="email"]');

        // var radioInput = $(this).attr('data-input');
        // var radioId = $(this).attr('id');

        //$('#'+elem.data('input')).addClass('field_error');

        if( onlineName.val().length ===0){
            //onlineName.addClass('field_error');
            warningBorder(onlineName);
            onlineName.focus();
            warningGoToField(onlineName);
            // var id  = onlineName.attr('href');
            // console.log(id);
            // //узнаем высоту от начала страницы до блока на который ссылается якорь
            //
            // top = onlineName.offset().top;
            //
            // //анимируем переход на расстояние - top за 1500 мс
            //
            // $('body,html').animate({scrollTop: top}, 1500);


            console.log('name is empty');
        }else if(onlineSurname.val().length ===0){
            warningBorder(onlineSurname);
            warningGoToField(onlineSurname);
            onlineSurname.focus();
            console.log('surname is empty');
        }else if(onlinePhone.val().length ===0){
            warningBorder(onlinePhone);
            warningGoToField(onlinePhone);
            onlinePhone.focus();
            console.log('phone is empty');
        }else if(onlineEmail.val().length ===0){
            warningBorder(onlineEmail);
            warningGoToField(onlineEmail);
            onlineEmail.focus();

            console.log('email is empty');
        }else{

            // $('.st-radio-btn').text(radioId==='radio_3'? 'Отправить' : 'Далее');

        }


    });






    setTimeout(function () {
        // MAP.init('b-map');
        // MAP.showInfoWindow = true;
        // MAP.setMarkers(objects);

        // MAP.init('b-map');
        // initMap();
        // MAP.showInfoWindow = true;
        // MAP.setMarkers(objects);
    },500);


    function initMapBG(filial) {
        var coord1;
        var coord2;

            coord1 = 46.456760;
            coord2 = 30.73348;


        let mapCanvas = document.getElementById('map-contacts');
        let mapOptions = {
            center: new google.maps.LatLng(coord1, coord2),
            zoom: 17,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        let mapContacts = new google.maps.Map(mapCanvas, mapOptions);
        let myLatlng = new google.maps.LatLng(coord1, coord2);
        let m = new google.maps.Marker({
            position: myLatlng,
            map: mapContacts,
            title: 'Premier realty master "Бургас"'
        });
        let contentString = '<div id="content"><img src="/usr/img/logo.png"></div>';
        let infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        google.maps.event.addListener(m, 'click', function () {
            infowindow.open(mapContacts, m);
        });
    }





    // function showMap(elem,filial) {
    //
    //     let wrapper_map = document.getElementById('wrapper-map');
    //     wrapper_map.style.display = 'flex';
    //     console.log(filial);
    //     if (elem === 'map-bg') {
    //         initMapBG(filial);
    //     }
    //     else if (elem === 'map-ua') {
    //         initMapUa(filial);
    //     }
    // }



});