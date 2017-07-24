<?php 
if(isset($_POST['id']) && isset($_POST['selecionado'])){



	include ("../../../../BD.php");





	$dados = $_POST['selecionado'];
	$id = $_POST['id'];

	






	$query_inserir = "UPDATE monitorizado SET Tempo_monitorização=? WHERE ID_Monitorizado=?";

	if ($stmt = $sqli_connection -> prepare($query_inserir)) {
		$stmt -> bind_param("ss", $dados, $id);
		$stmt -> execute();
		$stmt -> close();

	} 



}



?>

