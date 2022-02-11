
        //console.log('map main');
        setTimeout(function () {
            MAP.init('object_map');
            MAP.showInfoWindow = true;
            MAP.setMarkers(mapAllObjects);
        }, 500);