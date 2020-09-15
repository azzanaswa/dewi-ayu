var map;
var myLatLng;
$(document).ready(function() {
    geoLocationInit();
});
    function geoLocationInit() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }

    function success(position) {
        console.log(position);
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;
        myLatLng = new google.maps.LatLng(latval, lngval);
        createMap(myLatLng);
        // nearbySearch(myLatLng, "school");
        // document.getElementById("lat").innerHTML = latval;
        // document.getElementById("lng").innerHTML = lngval;
        // searchGuru(latval,lngval);
    }

    function fail() {
        alert("it fails");
    }
    //Create Map
    function createMap(myLatLng) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 13.5
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
        console.log(myLatLng);
    }
    //Create marker
    function createMarker(latlng, icn, name) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: name
        });
    }

    function searchGuru(lat,lng){
        $.post('http://localhost:8000/api/getGuru',{lat:lat,lng:lng},function(match){

            $.each(match,function(i,val){
                var glatval=val.lat;
                var glngval=val.lng;
                var gname=val.nama;
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                createMarker(GLatLng,gicn,gname);
                console.log(match);
            });

              // $.each(match, function(i, val) {
              //   console.log(val.name);
              // });
        });
    }