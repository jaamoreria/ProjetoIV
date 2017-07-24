<?php


include ("../../../../BD.php");




if(isset($_POST['checked'])){
$count=0;
$check = $_POST['checked'];
$data= date("Y-m-d");
$estado='Não';
session_start();
$id=$_SESSION['monitorizado'];


foreach ($check as $key=>$value) {

  
  $query = "INSERT INTO grupo (ID_Cuidador, ID_Monitorizado, isPrincipal) VALUES (?,?,?)";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("sss",$value, $id, $estado);
    $result = $stmt -> execute();
    $stmt -> close();

    
    
  }

}

}





?>







