<?php


include ("../../../../../BD.php");




if(isset($_POST['id'])){


$id=$_POST['id'];






$query = "DELETE FROM area_segura WHERE ID_Area=?";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("s",$id);
    $result = $stmt -> execute();
    $stmt -> close();

    
    

}
  


}





?>







