<?php 


$id=$_SESSION['monitorizado'];
$id_cuidador=$_SESSION['login_user_id'];

?>


<input id="input" class="controls pac-input" type="text" placeholder="Localização" required>
<div class="row">
  <div class="col-md-8">  
    <div id="mapDiv" style="height: 600px;">
    </div>
  </div>
  <div class="col-md-4">       
    <div class="box box-widget widget-user-2">   
      <div class="widget-user-header" style="background-color:#00619B;">
        <h3 class="widget-user-username" style="color:white;">Detalhes</h3>
      </div>
      <div class="box-footer">
        <ul class="nav nav-stacked">
          <label id="aviso">Selecione uma área segura</label>
          <li style="display:none;" id="label_nome"><label>Nome:</label><a><output id="nome_area"></output></a></li>
          <li style="display:none;" id="label_autor"><label style="margin-top: 20px;">Autor:</label><a><output id="nome_autor"></output></a></li>
          <li style="display:none;" id="label_botões"><a><button class="btn btn-danger"  name="apagar" id="apagar" onclick="apagar_cancelar()">Apagar</button><button class="btn btn-primary" id="editar" name="editar" onclick="editar_confirmar()" style="position: relative; float: right; margin-right: -5px">Editar</button></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0sMN4oZv0arXqQMn53OqpN5O2s_WjqzM&libraries=places,drawing&callback=ShowGoogleMap"></script>



<script>
  $("#editar").click(function(){

  });

  function editar_confirmar() {

    var name=$('#editar').attr('name');
    if(name=="editar"){
      var $this = $(this);
      $('#editar').removeClass('btn btn-primary');
      $('#editar').addClass('btn btn-success');
      $('#editar').text('Confirmar'); 

      $('#apagar').text('Cancelar');
      $('#apagar').attr('name', "cancelar");
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

        data:{"id":id_poly, "info":desc},
        success:function(data){

          $('#editar').removeClass('btn btn-success');
          $('#editar').addClass('btn btn-primary');
          $('#editar').text('Editar'); 

          $('#apagar').text('Apagar');
          $('#apagar').attr('name', "apagar");
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

  function apagar_cancelar() {

    var name=$('#apagar').attr('name');
    if(name=="cancelar"){


      $('#editar').removeClass('btn btn-success');
      $('#editar').addClass('btn btn-primary');
      $('#editar').text('Editar'); 

      $('#apagar').text('Apagar');
      $('#apagar').attr('name', "apagar");
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
  }

  function apagar_poly() {

    if (selectedShape) {
      var id_apagar=selectedShape.get("id");
      selectedShape.setMap(null);

      $.ajax({
        type: 'POST',
        url: "dados_mapa/apagar_poly.php",

        data:{"id":id_apagar},
        success:function(data){
          $('#label_botões').hide(); 
          $('#label_nome').hide(); 
          $('#label_autor').hide(); 
          $('#aviso').show();

        }
      });
    }



    
  }




  var id_poly;
  var map;
  var selectedShape;
  var bermudaTriangle;
  var id_selecionado;
  var id_edit;
  
  function clearSelection() {

    if (selectedShape) {


      selectedShape.setEditable(false);
      selectedShape = null;

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
    var latlon=[];
    google.maps.event.addListener(shape.getPath(), 'set_at', function() {
      var id_edit=shape.get("id");

      $.each(shape.getPath().getArray(), function (key, latlng) {
        var lat = latlng.lat();
        var lon = latlng.lng();
        var item = { "lat" : lat, "lng":lon};
        latlon.push(item);

      });

      $.ajax({
        type: 'POST',
        url: "dados_mapa/editar_poly.php",
        data: {"id":id_edit, "coordenadas":latlon},

      });

    });

    clearSelection();
    selectedShape = shape;
    shape.setEditable(true);
    id_poly=shape.get("id");
    
    
    if(controlo=="true"){
      $.ajax({
        type: 'POST',
        url: "dados_mapa/obter_detalhes.php",
        data: {"idd":id_poly},
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

  }

  function deleteSelectedShape() {
    if (selectedShape) {
      selectedShape.setMap(null);

      $('#myModal').modal('hide');
      $('#er').trigger("reset");
    }
  }



  function ShowGoogleMap() {

    function add(polygon) {


      google.maps.event.addListener(polygon, 'click', function (event) {
        setSelection(polygon, "true");

        var vertices = polygon.getPath();
        var contents = polygon.get("info");
        var bounds = new google.maps.LatLngBounds();
        vertices.forEach(function(xy,i){
          bounds.extend(xy);
        });

        var aaaa= $('#apagar').attr('name');

      });  

      

      

    }

    function abreModal(poly, current_id) {


      setSelection(poly, "false");

      $('#er').off('submit').on('submit', function(e){
        e.preventDefault();

        polygonArray.push(poly);


        var bla = $('#r').val();
        $('#myModal').modal('hide');

        $('#er').trigger("reset");



        poly.set("info", bla);
        poly.set("id", current_id);
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
          url: "guarda_area.php",
          data: {"id":current_id, "coordenadas":latlon, "info":bla, "id_monitorizado":id_monitorizado, "id_cuidador":id_cuidador},
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






    var polygonArray=[];
    var id;
    var bla;
    var poly;
    var current_id;


    map = new google.maps.Map(document.getElementById('mapDiv'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 11
    });
    var input = /** @type {!HTMLInputElement} */(
      document.getElementById('input'));

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
      url: "obter_areas.php",

      data:{"id":id_monitorizado},

      success:function(data){
        var result=eval(data);


        for (var i = 0; i < result.length; i++) {

          bermudaTriangle = new google.maps.Polygon({
            paths: result[i].coordenadas,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            info: result[i].desc,
            id:result[i].id
          });

          

          id_selecionado=bermudaTriangle.get("id");
          bermudaTriangle.setMap(map);
          add(bermudaTriangle); 



        }


      }

    });





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

    var drawingManager = new google.maps.drawing.DrawingManager({



      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['polygon']
      },
      markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
      circleOptions: {
        fillColor: '#ffff00',
        fillOpacity: 1,
        strokeWeight: 5,
        clickable: false,
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

          abreModal(poly, current_id);


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
    google.maps.event.addDomListener(document.getElementById('apagar'), 'click', apagar_poly);
    google.maps.event.addListener(map, 'click', clearSelection2);


  }


</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModal">Detalhes</h4>
      </div>
      <div class="modal-body">
        <form id="er" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
          <div class="form-group">
            <label for="recipient-nome" class="control-label">Nome:</label>
            <input name="nome" type="text" class="form-control" id="r" required="">
          </div>
          <button type="button" name="a" id="can" class="btn btn-danger">Cancelar</button>
          <button type="submit" name="a" id="sub" class="btn btn-success">Adicionar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
</script>
