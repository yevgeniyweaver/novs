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
        url: '/usr/img/orange_marker.png',
        scaledSize: new google.maps.Size(14, 14)
    },
    previousInfowindow: '',
    map: '',
    olat: 46.484583,
    olng: 30.7326,
    init: function (mapElement) {
        this.bigIcon = '/usr/img/orange_marker_big.png';
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
                            });
                            // console.log(data);

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
            value.setMap(null);
            // value.icon = this.bigIcon;
            // console.log(value);
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
