<?php


include ("../../../BD.php");


$id=$_POST['id'];
$estado="1";




$query4 = "SELECT Estado from alertas WHERE ID_Alerta=".$id;
$results4 = mysqli_query($sqli_connection,$query4);
$rows4 = mysqli_fetch_array($results4);

if($rows4['Estado']=='1'){
  echo ("Erro");
}else{

$query = "UPDATE alertas SET estado=? WHERE ID_Alerta=?";

    if ($stmt = $sqli_connection -> prepare($query)) {
      $stmt -> bind_param("ss", $estado,$id);
      $result = $stmt -> execute();
      $stmt -> close();

      echo ("Ok");

    }


}






 

    
  

    ?>





