<?php


include ("../../../../BD.php");




if(isset($_POST['checked'])){
$count=0;
$check = $_POST['checked'];
$data= date("Y-m-d");
$estado='Não';
$areas="Não";
session_start();
$id=$_SESSION['monitorizado'];
$aviso="Não definido";


foreach ($check as $key=>$value) {

  
  $query = "INSERT INTO grupo (ID_Cuidador, ID_Monitorizado, isPrincipal, Definir_Areas, Aviso_SMS_MAIL) VALUES (?,?,?,?,?)";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("sssss",$value, $id, $estado, $areas, $aviso);
    $result = $stmt -> execute();
    $stmt -> close();

    
    
  }

}

}





?>







