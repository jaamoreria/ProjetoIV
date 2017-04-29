<?php 
if(isset($_POST['nome']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['telemovel']) && isset($_POST['password'])){



	include ("../../../BD.php");





	$nome = $_POST['nome'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$telemovel = $_POST['telemovel'];
	$email = $_POST['email'];
	$data=date("Y-m-d");

	






	$query_inserir = "INSERT INTO cuidador (Nome, Username, Password, Telemovel, Email, Data_Admissao) VALUES (?,?,?,?,?,?)";

//QUERIE IS CORRECT


	if ($stmt = $sqli_connection -> prepare($query_inserir)) {
		$stmt -> bind_param("ssssss", $nome,$username, $password, $telemovel, $email, $data);
		$stmt -> execute();
		$stmt -> close();


		$img = file_get_contents("../vazio.jpg");

		$sql = "UPDATE  cuidador SET Imagem=? WHERE ID_Cuidador=?";
		$id=mysqli_insert_id($sqli_connection);

		$stmt = mysqli_prepare($sqli_connection,$sql);

		mysqli_stmt_bind_param($stmt, "ss",$img, $id);
		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		mysqli_close($sqli_connection);

		mysqli_insert_id($sqli_connection);

		//include("criar_pastas.php");





} 


}




?>