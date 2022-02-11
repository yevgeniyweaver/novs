var MAP = {
    mapElement: "find-map",
    showInfoWindow: true,
    tempMarks: [],
    options: {
        scrollwheel: false,
        styles: [
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#444444"
                    }
                ]
            },
            // {
            //     "featureType": "landscape",
            //     "elementType": "all",
            //     "stylers": [
            //         {
            //             "color": "#f2f2f2"
            //         }
            //     ]
            // },
            // {
            //     "featureType": "poi",
            //     "elementType": "all",
            //     "stylers": [
            //         {
            //             "visibility": "off"
            //         }
            //     ]
            // },
            // {
            //     "featureType": "road",
            //     "elementType": "all",
            //     "stylers": [
            //         {
            //             "saturation": -100
            //         },
            //         {
            //             "lightness": 45
            //         }
            //     ]
            // },
            // {
            //     "featureType": "road.highway",
            //     "elementType": "all",
            //     "stylers": [
            //         {
            //             "visibility": "simplified"
            //         }
            //     ]
            // },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            }
            // {
            //     "featureType": "water",
            //     "elementType": "all",
            //     "stylers": [
            //         {
            //             "color": "#1e88e5"
            //         },
            //         {
            //             "visibility": "on"
            //         }
            //     ]
            // }
        ],
        center: '',
        zoom: 11,
        mapTypeId: '',
        init: function () {
            this.center = new google.maps.LatLng(MAP.olat, MAP.olng);
            this.mapTypeId = google.maps.MapTypeId.ROADMAP;
        }
    },
    marks: [],
    icon: {
        url: '/img/orange_marker.png',
    scaledSize: new google.maps.Size(14, 14)
    },
    previousInfowindow: '',
    map: '',
    olat: 46.484583,
    olng: 30.7326,
    init: function (mapElement) {
        this.bigIcon = '/img/orange_marker_big.png';
        this.mapElement = mapElement || "find-map";
        this.options.init();
        this.map = new google.maps.Map(document.getElementById(this.mapElement), this.options);
        this.map.addListener('zoom_changed', function () {
            if (MAP.map.getZoom() > 14) {
                MAP.changeMarks(MAP.bigIcon);
            } else {
                MAP.changeMarks(MAP.icon);
            }
        });
    },
    setMarkers: function (array) {
        this.tempMarks = array;
        $.each(array, function (key, value) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(value.map_lat, value.map_lng),
                map: MAP.map,
                title: value.orient,
                id: value.id,
                infowindow: ''
            });
            marker.setIcon(MAP.icon);
            var id = MAP.marks.push(marker);
            id = id - 1;
            MAP.marks[id].addListener('click', function () {
                $.ajax({
                    url: '/ajax/find/ajaxInfoWindow',
                    method: 'post',
                    data: {id: this['id']},
                    success: function (data) {
                        if (MAP.showInfoWindow) {
                            if (MAP.previousInfowindow.toString() && MAP.marks.length > 1) {
                                MAP.marks[MAP.previousInfowindow].infowindow.close();
                            }
                            MAP.marks[id].infowindow = new google.maps.InfoWindow({
                                content: data
                            });// console.log(data);
                            MAP.marks[id].infowindow.open(MAP.map, MAP.marks[id]);
                        } else {
                            // Доработка для вывода всплывающего окна при выборе обекта
                            MAP.marks[id].infowindow = new google.maps.InfoWindow({
                                content: data
                            });
                            MAP.marks[id].infowindow.open(MAP.map, MAP.marks[id]);
                        }
                        MAP.previousInfowindow = id;
                    }
                });
            });
        });
        if (MAP.marks.length == 1) {
            MAP.map.setZoom(13);
            MAP.showInfoWindow = false;
            MAP.map.setCenter(MAP.marks[0].getPosition());
        }
    },
    destroyMarkers: function () {
        $.each(this.marks, function (key, value) {
            value.setMap(null);
        });
        this.marks = [];
    },
    changeMarks: function (icon) {
        $.each(this.marks, function (key, value) {
            value.setMap(null);// value.icon = this.bigIcon;// console.log(value);
        });
        this.icon = icon;
        this.setMarkers(this.tempMarks);
    },
    setMouseOutHidden: function () {
        $.each(this.marks, function (key, value) {
            value.addListener('mouseout', function () {
                value.infowindow.close();
            });
        });
    }
};
// setTimeout(function () {
//     // MAP.init('b-map');
//     // MAP.showInfoWindow = true;
//     // MAP.setMarkers(objects);
//     MAP.init('builders-map');
//     MAP.showInfoWindow = true;
//     MAP.setMarkers(objects);
// },200);
//let map_height = window.innerHeight - document.querySelector('#top').offsetHeight - 1;
//document.querySelector('#map').style.height = map_height + 'px';
var mapFormBlock = document.getElementById('map_form_bg');
if(mapFormBlock){
    var findHeight = document.documentElement.querySelector('.find-form-bg').offsetHeight;
    var headerHeight = document.documentElement.querySelector('.header').offsetHeight;
    var findUpHeight = window.innerHeight - (findHeight  + headerHeight);
    document.querySelector('#find-map').style.height = findUpHeight + 'px';
}
$(window).scroll(function () {
    var scrollHeight = $(document).scrollTop();//console.log(scrollHeight);
    var fullHeight = document.documentElement.scrollHeight;
    var sliderBlock = document.getElementById('novjk_slide');
    if(sliderBlock){
        var sliderHeight = document.documentElement.querySelector('.builders-slider-bg').offsetTop;
        if(scrollHeight > sliderHeight){
            $('.b-jk-up-block').addClass('b-jk-up-block-fixed');//$('.b-jk-up-block').css({'position':'fixed','top':'0'});
        }else{
            $('.b-jk-up-block').removeClass('b-jk-up-block-fixed');//$('.b-jk-up-block').css({'position':'unset','top':'unset'});
        }
    }
    // var footerComerse = fullHeight-1550;//Крайняя точка для фиксирования формы по футеру
    // var planHeight = $('.full_container').height();
    // var formPos = top+370;
    // //$('.repair-form-block').addClass('repair-form-block-fixed');
    // if(top > footerComerse){
    //     $('.repair-form-block').addClass('repair-form-block-clean');
    //     $('.repair-form-block').css({bottom:top-320});
    // }else{
    //     $('.repair-form-block').removeClass('repair-form-block-clean');
    // }
    // if(formPos>planHeight) {
    //     $('.plan-form-block').addClass('repair-form-block-bottom');
    //     $('.plan-form-block').css({bottom: '650px'});
    // }else{
    //     $('.plan-form-block').removeClass('repair-form-block-bottom');
    //     $('.repair-form-block').addClass('repair-form-block-top');
    // }
});