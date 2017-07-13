<?php 
if(isset($_POST['nome']) && isset($_POST['imei']) && isset($_POST['desc']) && isset($_POST['nasc'])){



	include ("../../../BD.php");





	$nome = $_POST['nome'];
	$imei = $_POST['imei'];
	$desc = $_POST['desc'];
	$nasc = $_POST['nasc'];
	$data=date("d/m/Y");

	






	$query_inserir = "INSERT INTO monitorizado (Nome, IMEI, Descricao, Data_Nascimento, Data_Admissao) VALUES (?,?,?,?,?)";

//QUERIE IS CORRECT


	if ($stmt = $sqli_connection -> prepare($query_inserir)) {
		$stmt -> bind_param("sssss", $nome, $imei, $desc, $nasc, $data);
		$stmt -> execute();
		$stmt -> close();


		$img = file_get_contents("../vazio.jpg");

		$sql = "UPDATE monitorizado SET Imagem=? WHERE ID_Monitorizado=?";
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