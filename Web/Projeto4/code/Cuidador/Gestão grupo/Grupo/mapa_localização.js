
var marker2 = new google.maps.Marker({
  map: map2,
  anchorPoint: new google.maps.Point(0, -29)
});
var infowindow2 = new google.maps.InfoWindow();
var input2 = /** @type {!HTMLInputElement} */(
  document.getElementById('input-5'));

var types2 = document.getElementById('type-selector');

map2.controls[google.maps.ControlPosition.TOP_LEFT].push(types2);



var flightPlanCoordinates = [
{lat: 29.5315, lng: -140.01750000000004}
];
var flightPath = new google.maps.Polyline({
  path: flightPlanCoordinates,
  geodesic: true,
  strokeColor: '#FF0000',
  strokeOpacity: 1.0,
  strokeWeight: 2
});

function zoomToObject(obj){

    var bounds2 = new google.maps.LatLngBounds();
    var points = obj.getPath().getArray();
    
    for (var n = 0; n < points.length ; n++){
        bounds2.extend(points[n]);
    }

    flightPath.setMap(map2);

    var centro = bounds2.getCenter();
    console.log(centro);

      loc = new google.maps.LatLng(centro);
      
      map2.setZoom(17);
      map2.setCenter(centro);
    //map2.fitBounds(bounds2.getCenter()); 
    //map2.setCenter(new google.maps.LatLng(29.5315, -140.01750000000004));
    
}




flightPath.setMap(map);
zoomToObject(flightPath);


