setTimeout(function () {
    MAP.init();
    MAP.showInfoWindow = true;
    MAP.setMarkers(mapAllObjects);

    $(document).on('click', '[data-key="likejk"]', function () {
        let id = $(this).data('id');//console.log(id);
        $.ajax({
            url: '/ajax/find/ajaxmap',
            method: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (result) {
                MAP.destroyMarkers();
                MAP.setMarkers(result);//console.log(result);
                MAP.map.setZoom(13);
                MAP.map.setCenter(MAP.marks[0].getPosition());//MAP.setMouseOutHidden(result);
            }
        })
    });
    /*
    $(document).on('click', '[data-key="likejkregion"]', function () {
        var value = $(this).data('value');
        $.ajax({
            url: '/ajax/find/ajaxmapregion', method: 'POST', dataType: 'json',
            data: {value: value},
            success: function (result) {MAP.destroyMarkers();MAP.setMarkers(result);console.log(result);MAP.map.setZoom(13);MAP.map.setCenter(MAP.marks[0].getPosition());
                //MAP.setMouseOutHidden(result);
            }
        })
    });
    */
}, 700);
/**
 * Created by Admin on 20.07.2017.
 */
