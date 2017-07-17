var area_antes;
  
  function editar_confirmar() {

    area_antes=$('#nome_area').val();

    var name=$('#editar').attr('name');
    if(name=="editar"){
      var $this = $(this);
      $('#editar').removeClass('btn btn-primary');
      $('#editar').addClass('btn btn-success');
      $('#editar').text('Confirmar'); 

      
      $('#apagar').hide();
      $('#cancelar').show();
      $('#editar').attr('name', "confirmar");

      $("#nome_area").each( function(){
        var bla = $('#nome_area').val();
        var content = $( "<input>" );
        var content_final=$( "</input>" );

        $.each( this.attributes, function(){ 
         content.attr( this.name, this.value, content_final );
       } );

        $( this ).replaceWith( content );
        $('#nome_area').val(bla);
      } );

    }else{

      var desc=$('#nome_area').val();

      $.ajax({
        type: 'POST',
        url: "dados_mapa/editar_area.php",

        data:{"id":id_shape, "info":desc},
        success:function(data){

          $('#editar').removeClass('btn btn-success');
          $('#editar').addClass('btn btn-primary');
          $('#editar').text('Editar'); 

          $('#apagar').show();
          $('#cancelar').hide();
          $('#editar').attr('name', "editar");

          $("#nome_area").each( function(){
            var bla = $('#nome_area').val();
            var content = $( "<output>" );
            var content_final=$( "</output>" );

            $.each(this.attributes, function(){ 
              content.attr(this.name, this.value, content_final );
            });

            $(this).replaceWith( content );
            $('#nome_area').val(bla);

          });



        }

      });
    }
  }

  function cancelar() {




    $('#editar').removeClass('btn btn-success');
    $('#editar').addClass('btn btn-primary');
    $('#editar').text('Editar'); 

    $('#apagar').show();
    $('#cancelar').hide();

    $('#editar').attr('name', "editar");

    $("#nome_area").each( function(){
      var bla = $('#nome_area').val();
      var content = $( "<output>" );
      var content_final=$( "</output>" );

      $.each(this.attributes, function(){ 
        content.attr(this.name, this.value, content_final );
      });

      $(this).replaceWith( content );
      $('#nome_area').val(area_antes);

    });
    
    
  }

  function apagar_shape() {

    if (selectedShape) {
      var id_apagar=selectedShape.get("id");
      selectedShape.setMap(null);

      $.ajax({
        type: 'POST',
        url: "dados_mapa/apagar_shape.php",

        data:{"id":id_apagar},
        success:function(data){
          $('#label_botões').hide(); 
          $('#label_nome').hide(); 
          $('#label_autor').hide(); 
          $('#aviso').show();
          $.scojs_message('Apagado com sucesso', $.scojs_message.TYPE_OK); 
        }
      });
    }



    
  }




  var id_shape;
  var map;
  var map2;
  var selectedShape;
  var poligonos;
  var circulos;
  var id_selecionado;
  var id_edit;
  var shapeArray=[];
  
  function clearSelection() {

    if (selectedShape) {

      if(selectedShape.type=="poly"){
        selectedShape.setEditable(false);
        selectedShape = null;
      }else{
        selectedShape.set('editable',true);
      }
      

    }


    
  }
  function clearSelection2() {



    if (selectedShape) {


      selectedShape.setEditable(false);
      selectedShape = null;
      $('#label_botões').hide(); 
      $('#label_nome').hide(); 
      $('#label_autor').hide(); 
      $('#aviso').show();

    }


    
  }

  $(window).load(function () {
    BindResizeEvent();

  });

  function setSelection(shape, controlo) {




    /*google.maps.event.addListener(shape.getPath(), 'set_at', function() {
      var id_edit=shape.get("id");

      $.each(shape.getPath().getArray(), function (key, latlng) {
        var lat = latlng.lat();
        var lon = latlng.lng();
        var item = { "lat" : lat, "lng":lon};
        latlon.push(item);

      });

      $.ajax({
        type: 'POST',
        url: "dados_mapa/editar_shape.php",
        data: {"id":id_edit, "coordenadas":latlon},

      });

    });*/



    clearSelection();
    selectedShape = shape;
    
    if(shape.type=="poly"){
      shape.setEditable(true);
    }else{
      shape.set('editable',true);
    }
    
    id_shape=shape.get("id");



    
    
    if(controlo=="true"){







      $.ajax({
        type: 'POST',
        url: "dados_mapa/obter_detalhes.php",
        data: {"idd":id_shape},
        success:function(data){
          var dados=JSON.parse(data);


          $('li').show();
          $('#nome_autor').val(dados[0].Nome);
          $('#nome_area').val(dados[0].Descricao);    
          $('#aviso').hide(); 

        }
      });


    }



  }

  function BindResizeEvent() {
    $("a[href='#tab2']").on('shown.bs.tab', function () {

      lastCenter=map.getCenter();
      google.maps.event.trigger(map, 'resize');
      map.setCenter(lastCenter);

    });

    $("a[href='#tab3']").on('shown.bs.tab', function () {

      lastCenter=map2.getCenter();
      google.maps.event.trigger(map2, 'resize');
      map2.setCenter(lastCenter);

    });

  }

  function deleteSelectedShape() {
    if (selectedShape) {
      selectedShape.setMap(null);

      $('#myModal').modal('hide');
      $('#er').trigger("reset");
    }
  }



  function ShowGoogleMap() {



// function add(polygon) {


//       google.maps.event.addListener(polygon, 'click', function (event) {
//         setSelection(polygon, "true");

//         //var vertices = polygon.getPath();
//         var contents = polygon.get("info");


//         var aaaa= $('#apagar').attr('name');

//         for (var i = 0; i < shapeArray.length; i++) {
//           console.log();
//           if(shapeArray[i].id==2){
//             var vertices = shapeArray[i].getPath();
//             var bounds = new google.maps.LatLngBounds();

//             vertices.forEach(function(xy,i){
//               bounds.extend(xy);
//             });
//             map.fitBounds(bounds);
//           }
//         }






//       }); 









//     }

function add(polygon) {
  var latlon=[];


  google.maps.event.addListener(polygon, 'click', function (event) {
    setSelection(polygon, "true");

    var vertices = polygon.getPath();

    var contents = polygon.get("info");
    var bounds = new google.maps.LatLngBounds();
    
    vertices.forEach(function(xy,i){
      bounds.extend(xy);
    });

    var aaaa= $('#apagar').attr('name');

    

    
    
    
    map.fitBounds(bounds);


  }); 

  google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
    var id_edit=polygon.get("id");


    $.each(polygon.getPath().getArray(), function (key, latlng) {
      var lat = latlng.lat();
      var lon = latlng.lng();
      var item = { "lat" : lat, "lng":lon};
      latlon.push(item);

    });



    $.ajax({
      type: 'POST',
      url: "dados_mapa/editar_shape.php",
      data: {"id":id_edit, "coordenadas":latlon},
      success:function(data){
          $.scojs_message('Área editada com sucesso', $.scojs_message.TYPE_OK);  
        }

      

    });

  });





  

  

}

function addCircle(Circle) {


  google.maps.event.addListener(Circle, 'click', function (event) {
    setSelection(Circle, "true");

    
    var contents = Circle.get("info");

    

    var aaaa= $('#apagar').attr('name');

        //console.log(poligonos);
        //console.log(polygon);
        
        map.fitBounds(Circle.getBounds());

      }); 

  google.maps.event.addListener(Circle, 'center_changed', function (event) {
    var id_edit=Circle.get("id");
    alert(id_edit);
    var latlng = Circle.getCenter();
    var latlon=[];

    var lat = latlng.lat();
    var lon = latlng.lng();
    var item = { "lat" : lat, "lng":lon};
    latlon.push(item);



    $.ajax({
      type: 'POST',
      url: "dados_mapa/circle/editar_centro.php",
      data: {"id":id_edit, "coordenadas":latlon},
      success:function(data){

      }

    });

  });

  google.maps.event.addListener(Circle, 'radius_changed', function (event) {
    var id_edit=Circle.get("id");
    
    var newRaio = Circle.getRadius();

    $.ajax({
      type: 'POST',
      url: "dados_mapa/circle/editar_raio.php",
      data: {"id":id_edit, "raio":newRaio},

    });

    
  });

  



  

  

}

function abreModalPoly(poly, current_id) {


  setSelection(poly, "false");

  $('#er').off('submit').on('submit', function(e){
    e.preventDefault();

    polygonArray.push(poly);


    var bla = $('#r').val();
    $('#myModal').modal('hide');

    $('#er').trigger("reset");



    poly.set("info", bla);
    poly.set("id", current_id);
    poly.set("type", "poly");
    addListenersOnPolygon(poly);
    var latlon=[];

    

    $.each(poly.getPath().getArray(), function (key, latlng) {
      var lat = latlng.lat();
      var lon = latlng.lng();

      var item = { "lat" : lat, "lng":lon};
      latlon.push(item);



    });
    
    add(poly);
    var id_monitorizado = '<?php echo $id; ?>';
    var id_cuidador = '<?php echo $id_cuidador; ?>';
    $.ajax({
      type: 'POST',
      url: "guarda_area_poly.php",
      data: {"id":current_id, "coordenadas":latlon, "info":bla, "id_monitorizado":id_monitorizado, "id_cuidador":id_cuidador},
      success:function(data){

        setSelection(selectedShape, "true");


      }
    });
  });

}


function abreModalCircle(circle, current_id) {


  setSelection(circle, "false");

  $('#er').off('submit').on('submit', function(e){
    e.preventDefault();

    circleArray.push(circle);


    var bla = $('#r').val();
    $('#myModal').modal('hide');

    $('#er').trigger("reset");



    circle.set("info", bla);
    circle.set("id", current_id);
    circle.set("type", "circle");
    addListenersOnCircle(circle);
    var latlon=[];
    lat=circle.getCenter().lat();
    lon=circle.getCenter().lng();
    var raio=circle.getRadius()
    

    var item ={"lat" : lat, "lng":lon}
    latlon.push(item);
    

      /* $.each(circle.getPath().getArray(), function (key, latlng) {
          var lat = latlng.lat();
          var lon = latlng.lng();

          var item = { "lat" : lat, "lng":lon};
          latlon.push(item);



        });*/
        
        addCircle(circle);
        var id_monitorizado = '<?php echo $id; ?>';
        var id_cuidador = '<?php echo $id_cuidador; ?>';
        $.ajax({
          type: 'POST',
          url: "guarda_area_circle.php",
          data: {"id":current_id, "coordenadas":latlon, "info":bla, "id_monitorizado":id_monitorizado, "id_cuidador":id_cuidador, "raio":raio},
          success:function(data){



            setSelection(selectedShape, "true");


          }
        });
      });

}

function addListenersOnPolygon(polygon) {


  google.maps.event.addListener(polygon, 'click', function (event) {


    var vertices = polygon.getPath();
    var contents = polygon.get("id");
    var bounds = new google.maps.LatLngBounds();
    vertices.forEach(function(xy,i){
      bounds.extend(xy);
    });



  });  
}

function addListenersOnCircle(circle) {


  google.maps.event.addListener(circle, 'click', function (event) {



   var alat=circle.getCenter().lat();
   var along=circle.getCenter().lng();



 });  
}






var polygonArray=[];
var id;
var bla;
var poly;
var circle;
var circleArray=[];
var current_id;

var myOptions = {
  center: {lat: -33.8688, lng: 151.2195},
  zoom: 11,
  myLocationcontrol: true
}

map = new google.maps.Map(document.getElementById("mapDiv"), myOptions);

map2 = new google.maps.Map(document.getElementById("map2Div"), myOptions);

///////////////////////////////////////////Mapa 2 (localizações) ///////////////////////////////////////////////////////////////////////////
$.getScript('Mapa_localização.js', function()
{
   
});
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var input = /** @type {!HTMLInputElement} */(
  document.getElementById('input-4'));

var types = document.getElementById('type-selector');

map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

var geoloccontrol = new klokantech.GeolocationControl(map);


var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.bindTo('bounds', map);


var marker = new google.maps.Marker({
  map: map,
  anchorPoint: new google.maps.Point(0, -29)
});
var infowindow = new google.maps.InfoWindow();

var id_monitorizado = '<?php echo $id; ?>';
var result;

$.ajax({
  type: 'POST',
  url: "obter_areas_poly.php",

  data:{"id":id_monitorizado},

  success:function(data){
    var result=eval(data);


    for (var i = 0; i < result.length; i++) {

      poligonos = new google.maps.Polygon({
        paths: result[i].coordenadas,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        info: result[i].desc,
        id:result[i].id,
        type:"poly"
      });

      

      id_selecionado=poligonos.get("id");
      poligonos.setMap(map);
      add(poligonos);
      shapeArray.push(poligonos);
      



    }


  }

});

$.ajax({
  type: 'POST',
  url: "obter_areas_circle.php",

  data:{"id":id_monitorizado},

  success:function(data){
    var result=eval(data);


    for (var i = 0; i < result.length; i++) {




      circulos = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map: map,
        info: result[i].desc,
        id:result[i].id,
        center: result[i].coordenadas[0],
        radius: result[i].raio,
        type:"circle"
      });




      

      id_selecionado=circulos.get("id");
      circulos.setMap(map);
      addCircle(circulos);
      shapeArray.push(circulos);



    }


  }

});





google.maps.Polygon.prototype.my_getBounds=function(){
  var bounds = new google.maps.LatLngBounds()
  this.getPath().forEach(function(element,index){bounds.extend(element)})
  return bounds
}

autocomplete.addListener('place_changed', function() {
  infowindow.close();
  marker.setVisible(false);
  var place = autocomplete.getPlace();
  if (!place.geometry) {

    window.alert("No details available for input: '" + place.name + "'");
    return;
  }


  if (place.geometry.viewport) {
    map.fitBounds(place.geometry.viewport);
  } else {
    map.setCenter(place.geometry.location);
    map.setZoom(45);  
  }
  marker.setIcon(({
    url: place.icon,
    size: new google.maps.Size(71, 71),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(17, 34),
    scaledSize: new google.maps.Size(35, 35)
  }));
  marker.setPosition(place.geometry.location);
  marker.setVisible(true);

  var address = '';
  if (place.address_components) {
    address = [
    (place.address_components[0] && place.address_components[0].short_name || ''),
    (place.address_components[1] && place.address_components[1].short_name || ''),
    (place.address_components[2] && place.address_components[2].short_name || '')
    ].join(' ');
  }

  infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
  infowindow.open(map, marker);
  map.setCenter(place.geometry.location);
  map.setZoom(17);  
});


var infoWindow = new google.maps.InfoWindow({map: map});



if (navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(function(position) {
    var pos = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };
    
    infoWindow.setPosition(pos);
    infoWindow.setContent('Localização encontrada.');
    map.setZoom(17);
    map.setCenter(pos);
  }, function() {
    handleLocationError(true, infoWindow, map.getCenter());
  });
} else {


  handleLocationError(false, infoWindow, map.getCenter());
}
/////

var drawingManager = new google.maps.drawing.DrawingManager({



  drawingControl: true,
  drawingControlOptions: {
    position: google.maps.ControlPosition.TOP_CENTER,
    drawingModes: ['polygon', 'circle']
  },
  markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
  circleOptions: {
    clickable: true,
    editable: true,
    zIndex: 1
  }
});

drawingManager.setMap(map);

google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {



  $.ajax({
    type: 'POST',
    url: "maxID.php",
    success:function(data){


      current_id = $.trim(data);
      
      $('#myModal').modal('show');
      poly=polygon;

      abreModalPoly(poly, current_id);


    }

  });


});


google.maps.event.addListener(drawingManager, 'circlecomplete', function (circle) {


//Web service para guardar o circle.
$.ajax({
  type: 'POST',
  url: "maxID.php",
  success:function(data){


    current_id = $.trim(data);

    $('#myModal').modal('show');
    circle=circle;

    abreModalCircle(circle, current_id);


  }

});


});



function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
}










google.maps.event.addDomListener(document.getElementById('can'), 'click', deleteSelectedShape);
google.maps.event.addDomListener(document.getElementById('apagar'), 'click', apagar_shape);
google.maps.event.addListener(map, 'click', clearSelection2);


}