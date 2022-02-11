


function showModal(){
    $('#jump_block').css('top', window.pageYOffset + 50);
    $('#jump_block, #blackout').fadeIn(200);
}

function showPlansModal(img) {
    //$('#jump_block').css('top', window.pageYOffset + 50);
    // $('#jump_block, #blackout').fadeIn(200);
    // console.log(img);
    // $('#blackout').css({'z-index': '999'});
    // $('#jump_block').css({'top': window.pageYOffset + 20, 'text-align': 'center'});
    // $('#jump_block').html('');
    // $('#jump_block .plans-img-box').remove();
    //
    // /*  '<div class="plans-close-block"><div class="plans-close-box"><div class="form_close jump_block_close"></div></div>' +
    //     '</div>' + */
    // $('#jump_block').append(
    //     '<div class="plans-img-box">' +
    //
    //     '<img data-funcybox="image" src="' + img + '"/>' +
    //     '</div>');
    //
    // var gallery = $('html .plans-img-box');//$("[data-fancybox]");

    // if (gallery.length > 0) {
    //     gallery.slick({
    //         dots: false,
    //         slidesToShow: 1,
    //         centerMode: true,
    //         adaptiveHeight: true,
    //         centerPadding: "100px",
    //         mobileFirst: true,
    //         variableWidth: true,
    //         prevArrow: "<button type='button' class='slick-arrow prev'>Previous</button>",
    //         nextArrow: "<button type='button' class='slick-arrow next'>Next</button>",
    //         focusOnSelect: true,
    //         // autoplay: true,
    //         autoplaySpeed: 5000,
    //     });
    //     gallery.show();
    // }

}

// function showPlansModal(img){
//     //$('#jump_block').css('top', window.pageYOffset + 50);
//     $('#jump_block, #blackout').fadeIn(200);
//     console.log(img);
//     $('#blackout').css({'z-index':'999'});
//     $('#jump_block').css({'top':window.pageYOffset+20,'text-align':'center'});
//     $('#jump_block').html('');
//     $('#jump_block .plans-img-box').remove();
//     $('#jump_block').append('<div class="plans-img-box">' +
//         '<div class="plans-close-block"><div class="plans-close-box"><div class="form_close jump_block_close"></div></div></div>' +
//         '<img src="'+img+'"/></div>');
// }
// $("body").on("click", ".b-jk-plans-zoom", function(){
//     var img_prop = $(this).parent().data('img');
//     //var img_attr = $(this).parent().attr('data-img');
//     console.log(img_prop);
// });


$("body").on("click", ".b-jk-plans-zoom", function(){
    var img_prop = $(this).parent().data('img');
    //var img_attr = $(this).parent().attr('data-img');
    //  if(img_attr){
    //      img_data = img_attr;
    //  }else if(img_prop){
    //      img_data = img_prop;
    //  }
    img_data = img_prop;
    var plansPath = '/upload/plans/';
    showPlansModal(plansPath+img_data);
    //$('body').css({'overflow':'hidden'});
});



function hideModal(){

    $('#jump_block, #blackout').hide();

    $("#jump_block, #blackout").trigger("hideModal");

}

function loadModal(url,cb){
    $.ajax({
        beforeSend:function(){
            // $("#jump_block").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><span class="sr-only">Загрузка...</span>');
            loadInfo(true);
        },
        url: url,
        dataType: "html",
        success: function(html){
            loadInfo(false);
            $("#jump_block").html(html);
            cb();
        }
    });
}


function openModal(url){
    loadModal(url,function(){showModal()});
}



function loadInfo(show){

}


// Показывет флеш сообщение и убирает его через 20 секунд
function showFormNote(nSelector, nClass, msg){
    //console.log(msg);
    nSelector = nSelector.toString();
    var nNote = $(nSelector);
    console.log(msg);
    nNote.hide().removeClass('note_vlidation note_ok').addClass(nClass);
    nNote.find('.form_note_label').html(msg);
    nNote.fadeIn();

    if (typeof nNoteHideTimeout != "undefined") {
        clearTimeout(nNoteHideTimeout);
    }
    var nNoteHideTimeout = setTimeout(function (n) {
        nNote.fadeOut("slow");
    }, 20000);
}

// Формирует сообщение и выводит ошибки валидации
function showFormErrorsArray(errorsArray, nSelector) {

    console.debug(errorsArray);
    console.log(nSelector);
    var items = [];

    $.each(errorsArray, function (id, msg) {
        console.log(msg[0]);
       // msg= msg.replace(/[\[\]']+/g, '');
        items.push('<strong>"' + msg[0] + '"</strong> - ' )//msg msg.label + msg.error

    });
    console.log(items);
    //items = items.replace(/[\[\]']+/g, '');
    //items = items.replace(/[{()}]/g, '');
    //items.join('<br />');
    showFormNote(nSelector, 'note_vlidation', items.join('<br />'));
    console.log(items);
}

function ajaxSendFormSuccess(form, data){

    if (data.setCookie !== undefined){
        $.each(data.setCookie, function(k, v){
            $.cookie(k, v.value,{expires:v.time});
        });
    }

    if (data.cleanForm == true) form.trigger('reset');
    if (data.hideForm == true)  form.hide('1000');
    if (data.redirect !== undefined) {

        var rdTime = 5000;

        if (data.redirectTimeout !== undefined) {
            var rdTime = data.redirectTimeout;
        }
        setTimeout(function () {
            if(data.redirect==""){
                location.reload();
            }else {
                location.href = data.redirect;
            }
        }, rdTime);

        if(rdTime==0){
            return;
        }
    }

    if (data.msgid !== undefined) {
        var msgId = data.msgid;
    } else {
        var msgId = '#_form_note';
    }

    if (data.error == true) { // случай ошибки валидации

        if (data.errorsArray !== undefined) {
            // вывод набора ошибок
            console.log(msgId);
            showFormErrorsArray(data.errorsArray, msgId);
        } else {
            var msgclass = 'note_vlidation';
            if (data.msgclass !== undefined) {
                var msgclass = data.msgclass;
            }
            // вывод простого сообщения если нет набора ошибок
            showFormNote(msgId, msgclass, data.msg);
        }
        if (typeof(data.callback) == "string") {
            eval(data.callback);
            callback();
        }

    } else {

        var msgclass = 'note_ok';

        if (data.msgclass !== undefined) {
            var msgclass = data.msgclass;
        }

        showFormNote(msgId, msgclass, data.msg);

    }

    if (typeof(data.callback) == "string") {
        eval(data.callback);
        callback();
    }

    return false;

}

var ajaxSendFormSending = false;

function ajaxSendForm(form, extraData){

    console.debug('form-go');

    if(ajaxSendFormSending){

        return false;

    }

    ajaxSendFormSending = true;

    if(extraData !== undefined){
        extraData = {};
    }

    var form = $(form);

    $(form).ajaxSubmit({
        semantic: true,
        dataType: 'json',
        data: extraData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){

            ajaxSendFormSuccess(form, data);
            console.log(data);

            ajaxSendFormSending = false;

        }
    }, "json");

    return false;

}

$(function (){

    $('body').on('click', '.jump_block_close,#blackout,#jump_block', function() {
        hideModal();
    });

    $('body').on('click', '#jump_block *', function(e) {
        e.stopPropagation();
    });

    $('body').on('click', '.jlinkn', function () {
        window.open($(this).data('link'));
        return false;
    });

    $('body').on('click', '.jlink', function () {

        window.location.href = $(this).data('link');
        return false;

    });

    $('body').on('submit', '.ajax_form', function (e){

        e.preventDefault();
        ajaxSendForm(this);
        return false;

    });


    // на редактирование
    var editIt = $('main [data-jmtreeedit]');

    if(editIt.length>0){
        $('main').prepend('<div class="jlinkn flink" id="jmtreeedit">Edit</div>');
        editIt.addClass('jmtreeedit_hover');
    };

    $('main').on('mouseenter', '.jmtreeedit_hover', function(){

        $('#jmtreeedit').css({
            left:$(this).offset().left,
            top:$(this).offset().top
        });

        $('#jmtreeedit').data('link',$(this).data('jmtreeedit'));
        $('#jmtreeedit').show();

    });

});
