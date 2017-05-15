<?php


include ("../../../../BD.php");


$id=$_POST['id'];
$estado=$_POST['estado'];
$monitorizado=$_POST['id_monitorizado'];
$check;

$query_controlo = "SELECT isPrincipal from grupo WHERE ID_Monitorizado='$monitorizado' AND ID_Cuidador!='$id'";
$results_controlo = mysqli_query($sqli_connection,$query_controlo);
$contagem=mysqli_num_rows($results_controlo);

if($contagem!=0){
while($controlo=mysqli_fetch_array($results_controlo)){
  if($controlo['isPrincipal']=="Sim"){
    $check="erro";
  }else{
    $check="ok";
  }

}

}else{
  $check="ok";
}


if($check=="ok"){
 

    $query = "UPDATE grupo SET isPrincipal=? WHERE ID_Monitorizado=? AND ID_Cuidador=?";

    if ($stmt = $sqli_connection -> prepare($query)) {
      $stmt -> bind_param("sss", $estado, $monitorizado, $id);
      $result = $stmt -> execute();
      $stmt -> close();

      echo ("Ok");

    }
  }else{
    echo ("Erro");
  }

    ?>





