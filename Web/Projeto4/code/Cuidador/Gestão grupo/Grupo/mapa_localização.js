
var marker2 = new google.maps.Marker({
  map: map2,
  anchorPoint: new google.maps.Point(0, -29)
});
var infowindow2 = new google.maps.InfoWindow();
var input2 = /** @type {!HTMLInputElement} */(
  document.getElementById('input-5'));

var types2 = document.getElementById('type-selector');

map2.controls[google.maps.ControlPosition.TOP_LEFT].push(types2);


//41.664238, -8.489075
var flightPlanCoordinates = [
{lat:41.664316, lng:-8.489436},
{lat:41.664356, lng:-8.488868},
{lat:41.664633, lng:-8.489060},
{lat:41.664730, lng:-8.489216}
];
var flightPath = new google.maps.Polyline({
  path: flightPlanCoordinates,
  geodesic: true,
  strokeColor: '#FF0000',
  strokeOpacity: 2.0,
  strokeWeight: 4
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

  //loc = new google.maps.LatLng(centro);

  map2.setZoom(20);
  map2.setCenter(centro);
  var service = new google.maps.DirectionsService(),polys,snap_path=[];               
  flightPath.setMap(map2);

  for(j=0;j<points.length-1;j++){            
    service.route({origin: points[j],destination: points[j+1],travelMode: google.maps.DirectionsTravelMode.DRIVING},function(result, status) {                
      if(status == google.maps.DirectionsStatus.OK) {                 
        snap_path = snap_path.concat(result.routes[0].overview_path);
        flightPath.setPath(snap_path);
      }        
    });
  }
    //map2.fitBounds(bounds2.getCenter()); 
    //map2.setCenter(new google.maps.LatLng(29.5315, -140.01750000000004));
    
  }





  zoomToObject(flightPath);


