<?php 
if(isset($_POST['nomeEdit']) && isset($_POST['usernameEdit']) && isset($_POST['emailEdit']) && isset($_POST['telemovelEdit']) && isset($_POST['passwordEdit'])
 && isset($_POST['id'])){



	include ("../../../BD.php");





	$nome = $_POST['nomeEdit'];
	$username = $_POST['usernameEdit'];
	$password = $_POST['passwordEdit'];
	$telemovel = $_POST['telemovelEdit'];
	$email = $_POST['emailEdit'];
	$id = $_POST['id'];

	






	$query_inserir = "UPDATE cuidador SET Nome=?, Username=?, Email=?, Password=?, Telemovel=? WHERE ID_Cuidador=?";

	if ($stmt = $sqli_connection -> prepare($query_inserir)) {
		$stmt -> bind_param("ssssss", $nome, $username, $email, $password, $telemovel, $id);
		$stmt -> execute();
		$stmt -> close();

	} 



}



?>

