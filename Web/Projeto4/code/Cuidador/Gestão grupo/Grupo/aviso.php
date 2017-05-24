<?php


include ("../../../../BD.php");


$id=$_POST['id'];
$estado=$_POST['estado'];
$monitorizado=$_POST['id_monitorizado'];






 

    $query = "UPDATE grupo SET Aviso_SMS_MAIL=? WHERE ID_Monitorizado=? AND ID_Cuidador=?";

    if ($stmt = $sqli_connection -> prepare($query)) {
      $stmt -> bind_param("sss", $estado, $monitorizado, $id);
      $result = $stmt -> execute();
      $stmt -> close();

      echo ("Ok");

    }else{
      echo ("Erro");
    }
  

    ?>





