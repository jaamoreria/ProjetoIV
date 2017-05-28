<?php


include ("../../../../BD.php");




if(isset($_POST['id']) && isset($_POST['info']) && isset($_POST['coordenadas']) && isset($_POST['id_monitorizado']) && isset($_POST['id_cuidador'])){
$desc=$_POST['info'];
$latlon=$_POST['coordenadas'];
$monitorizado=$_POST['id_monitorizado'];
$cuidador=$_POST['id_cuidador'];
$id=$_POST['id'];

$serialized_array = serialize($latlon); 





  
  $query = "INSERT INTO area_segura (ID_Area, ID_Monitorizado, LatLong, Descricao, ID_Cuidador) VALUES (?,?,?,?,?)";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("sssss",$id, $monitorizado, $serialized_array, $desc, $cuidador);
    $result = $stmt -> execute();
    $stmt -> close();

    
    

}

}





?>







