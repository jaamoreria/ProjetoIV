<?php


include ("../../../../BD.php");



if(isset($_POST['id']) && isset($_POST['monitorizado'])){

  $cuidador=$_POST['id'];
  $monitorizado=$_POST['monitorizado'];


  $query = "DELETE FROM grupo WHERE ID_Cuidador='$cuidador' AND ID_Monitorizado='$monitorizado'";

  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("ss", $cuidador, $monitorizado);
    $result = $stmt -> execute();
    $stmt -> close();
  }
}
?>





