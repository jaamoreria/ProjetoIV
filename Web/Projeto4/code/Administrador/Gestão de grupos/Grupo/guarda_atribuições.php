<?php


include ("../../../../BD.php");

if(isset($_POST['check'])){
if(isset($_POST['checked'])){
$count=0;
$check = $_POST['checked'];
$data= date("Y-m-d");
$estado='Atribuido';

foreach ($check as $key=>$value) {

  
  
  $query = "INSERT INTO grupo (ID_Cuidador, ID_Monitorizado) VALUES (?,?)";
  if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("ss",$value, $id);
    $result = $stmt -> execute();
    $stmt -> close();
    
  }

}
}
}
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=Listar_Grupo.php'>";

?>







