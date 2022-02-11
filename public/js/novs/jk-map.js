setTimeout(function () {
    // MAP.init('b-map');// MAP.showInfoWindow = true;// MAP.setMarkers(objects);
    MAP.init('b-map'); MAP.showInfoWindow = true; MAP.setMarkers(objects);
},500);

// setTimeout(function () {
//     var olat = 46.484583;var olng = 30.7326; var mark_title ='тест';
//     var myOptions = {
//         styles:[
//             {
//                 "featureType": "administrative",
//                 "elementType": "labels.text.fill",
//                 "stylers": [
//                     {
//                         "color": "#444444"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "landscape",
//                 "elementType": "all",
//                 "stylers": [
//                     {
//                         "color": "#f2f2f2"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "poi",
//                 "elementType": "all",
//                 "stylers": [
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road",
//                 "elementType": "all",
//                 "stylers": [
//                     {
//                         "saturation": -100
//                     },
//                     {
//                         "lightness": 45
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.highway",
//                 "elementType": "all",
//                 "stylers": [
//                     {
//                         "visibility": "simplified"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.arterial",
//                 "elementType": "labels.icon",
//                 "stylers": [
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "transit",
//                 "elementType": "all",
//                 "stylers": [
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "water",
//                 "elementType": "all",
//                 "stylers": [
//                     {
//                         "color": "#1e88e5"
//                     },
//                     {
//                         "visibility": "on"
//                     }
//                 ]
//             }
//         ],
//         center: new google.maps.LatLng(olat, olng),
//         zoom: 13,
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//     }
//     var map = new google.maps.Map(document.getElementById("object_map"), myOptions);
//     marker = new google.maps.Marker({
//         position: new google.maps.LatLng(olat, olng),
//         map: map,
//         title: mark_title
//     });
//     marker.setIcon('http://mt.google.com/vt/icon/name=icons/spotlight/spotlight-ad.png');
// },500);/**
//  * Created by Admin on 14.07.2017.
//  */
