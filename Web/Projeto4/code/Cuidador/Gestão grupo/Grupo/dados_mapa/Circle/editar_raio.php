<?php


include ("../../../../../../BD.php");




if(isset($_POST['id']) &&  isset($_POST['raio'])){

$raio=$_POST['raio'];
$id=$_POST['id'];






$query = "UPDATE area_segura SET Raio=? WHERE ID_Area=?";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("ss", $raio, $id);
    $result = $stmt -> execute();
    $stmt -> close();

    
    

}
  


}





?>







