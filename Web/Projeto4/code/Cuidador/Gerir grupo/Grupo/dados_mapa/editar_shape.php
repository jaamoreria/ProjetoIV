<?php


include ("../../../../../BD.php");




if(isset($_POST['id']) &&  isset($_POST['coordenadas'])){

$latlon=$_POST['coordenadas'];
$id=$_POST['id'];

$serialized_array = serialize($latlon); 




$query = "UPDATE area_segura SET LatLong=? WHERE ID_Area=?";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("ss", $serialized_array, $id);
    $result = $stmt -> execute();
    $stmt -> close();

    
    

}
  


}





?>







