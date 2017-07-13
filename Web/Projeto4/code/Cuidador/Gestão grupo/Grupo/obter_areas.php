<HTML>
  <body>
    <?php 
    session_start();
    $id_cuidador= $_SESSION['login_user_id'];
    ?>

    <style>
      td {
        font-weight: normal;
      }
    </style>


    <?php

  include ("../../../../BD.php"); // ligação à BD

  
  
  $query_obterDados="SELECT ID_Area, ID_Cuidador, Descricao, LatLong, Data from area_segura WHERE ID_Monitorizado=".$id;

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($area = mysqli_fetch_array($dados)){

    $dados_query = "SELECT Nome from cuidador WHERE ID_Cuidador=".$area['ID_Cuidador'];
    $result = mysqli_query($sqli_connection,$dados_query);
    $cuidador = mysqli_fetch_assoc($result);

    ?>
    <tr>
      <td><?php echo $area['Descricao']; ?></td>
      <td><?php echo $cuidador['Nome']; ?></td>
      <td><?php echo $area['Data']; ?></td>
      <td>
        <span class="btn glyphicon glyphicon-fullscreen btn btn-box-tool" data-widget="collapse"  style="position: relative; float: right; margin-right: -5px" id="ver" onclick='ver(<?php echo $area['ID_Area']; ?>)'></span></td>

    </tr>

    <?php
  }
  ?>

  <script>
    function ver(id_area) {
      
      clearSelection();



      for (var i = 0; i < shapeArray.length; i++) {
        

        
          
        if(shapeArray[i].id==id_area){
          if(shapeArray[i].type=="poly"){
          
          var vertices = shapeArray[i].getPath();
          var bounds = new google.maps.LatLngBounds();

          vertices.forEach(function(xy,i){
            bounds.extend(xy);
          });
          map.fitBounds(bounds);
          setSelection(shapeArray[i], "true");
          
        }else{

        map.fitBounds(shapeArray[i].getBounds());
        setSelection(shapeArray[i], "true");
      }
      }
      
    }

//verificar para citrcle e poly
     
      // this.removeClass("btn glyphicon glyphicon-fullscreen fa-plus");
      // this.addClass("btn glyphicon glyphicon-fullscreen fa-plus fa-plus");  

      
    }
  </script>














</body>
</html>



