<?php 
if(isset($_POST['idEdit']) && isset($_POST['nomeEdit']) && isset($_POST['imeiEdit']) && isset($_POST['descEdit']) && isset($_POST['nascEdit'])){



	include ("../../../BD.php");




	$id=$_POST['idEdit'];
	$nome = $_POST['nomeEdit'];
	$imei = $_POST['imeiEdit'];
	$desc = $_POST['descEdit'];
	$nasc = $_POST['nascEdit'];
	

	






	$query_inserir = "UPDATE monitorizado SET Nome=?, IMEI=?, Descricao=?, Data_Nascimento=? WHERE ID_Monitorizado=?";

//QUERIE IS CORRECT


	if ($stmt = $sqli_connection -> prepare($query_inserir)) {
		$stmt -> bind_param("sssss", $nome, $imei, $desc, $nasc, $id);
		$stmt -> execute();
		$stmt -> close();


	} 


}




?>


