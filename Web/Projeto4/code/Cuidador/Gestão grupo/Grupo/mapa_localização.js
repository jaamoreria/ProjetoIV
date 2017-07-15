
var marker2 = new google.maps.Marker({
  map: map2,
  anchorPoint: new google.maps.Point(0, -29)
});
var infowindow2 = new google.maps.InfoWindow();
var input2 = /** @type {!HTMLInputElement} */(
  document.getElementById('input-5'));

var types2 = document.getElementById('type-selector');

map2.controls[google.maps.ControlPosition.TOP_LEFT].push(types2);

var geoloccontrol2 = new klokantech.GeolocationControl(map2);


var autocomplete2 = new google.maps.places.Autocomplete(input2);
autocomplete2.bindTo('bounds', map2);


var marker2 = new google.maps.Marker({
  map: map2,
  anchorPoint: new google.maps.Point(0, -29)
});
var infowindow2 = new google.maps.InfoWindow();

google.maps.Polygon.prototype.my_getBounds=function(){
  var bounds2 = new google.maps.LatLngBounds()
  this.getPath().forEach(function(element,index){bounds2.extend(element)})
  return bounds2
}

autocomplete2.addListener('place_changed', function() {
  infowindow2.close();
  marker2.setVisible(false);
  var place2 = autocomplete2.getPlace();
  if (!place2.geometry) {

    window.alert("No details available for input: '" + place2.name + "'");
    return;
  }


  if (place2.geometry.viewport) {
    map2.fitBounds(place2.geometry.viewport);
  } else {
    map2.setCenter(place2.geometry.location);
    map2.setZoom(45);  
  }
  marker2.setIcon(({
    url: place2.icon,
    size: new google.maps.Size(71, 71),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(17, 34),
    scaledSize: new google.maps.Size(35, 35)
  }));
  marker2.setPosition(place2.geometry.location);
  marker2.setVisible(true);

  var address2 = '';
  if (place2.address_components) {
    address2 = [
    (place2.address_components[0] && place2.address_components[0].short_name || ''),
    (place2.address_components[1] && place2.address_components[1].short_name || ''),
    (place2.address_components[2] && place2.address_components[2].short_name || '')
    ].join(' ');
  }

  infowindow2.setContent('<div><strong>' + place2.name + '</strong><br>' + address2);
  infowindow2.open(map2, marke2r);
  map2.setCenter(place2.geometry.location);
  map2.setZoom(17);  
});


var infoWindow2 = new google.maps.InfoWindow({map: map2});



if (navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(function(position) {
    var pos2 = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };

    console.log(pos2);
    
    infoWindow2.setPosition(pos2);
    infoWindow2.setContent('Localização encontrada.');
    map2.setZoom(17);
    map2.setCenter(pos2);
  }, function() {
    handleLocationError(true, infoWindow2, map2.getCenter());
  });
} else {


  handleLocationError(false, infoWindow2, map2.getCenter());
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow2.setPosition(pos2);
  infoWindow2.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
}




//41.664238, -8.489075



var flightPath="";


$("#clicado").click(function(){
  var inicio=$("input[name=daterangepicker_start]").val();

  var inicio_split = inicio.split(" ");
  var data_inicio = inicio_split[0];
  var hora_inicio = inicio_split[1];


  var fim=$("input[name=daterangepicker_end]").val();
  var fim_split = fim.split(" ");
  var data_fim = fim_split[0];
  var hora_fim = fim_split[1];

  $.ajax({
    type: 'POST',
    url: "dados_mapa/Historico.php",

    data:{"id":id_monitorizado, "data_inicio":data_inicio, "data_fim":data_fim, "hora_inicio": hora_inicio, "hora_fim": hora_fim},
    success:function(data){

      
      var result=eval(data);

      if(flightPath!=""){
        flightPath.setMap(null);
      }


      


//           var flightPlanCoordinates = [
// {lat:41.664316, lng:-8.489436},
// {lat:41.664356, lng:-8.488868},
// {lat:41.664633, lng:-8.489060},
// {lat:41.664730, lng:-8.489216}
// ];
if(result!=""){
flightPath = new google.maps.Polyline({
  path: result,
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
  }else{
      $.scojs_message('Sem dados para a data e hora selecionada', $.scojs_message.TYPE_ERROR);
  }
}

});
});


