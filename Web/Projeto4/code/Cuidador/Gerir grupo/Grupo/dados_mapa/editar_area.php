<?php


include ("../../../../../BD.php");




if(isset($_POST['info']) && isset($_POST['id'])){

$desc=$_POST['info'];
$id=$_POST['id'];






//fazer update
  
  $query = "UPDATE area_segura SET Descricao=? WHERE ID_Area=?";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("ss",$desc, $id);
    $result = $stmt -> execute();
    $stmt -> close();

    
    

}

}





?>







