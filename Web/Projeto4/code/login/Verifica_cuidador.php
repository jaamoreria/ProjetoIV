<?php


if(isset($_POST["username"]) && isset($_POST["password"])){

	//QUERY QUE VERIFICA O USERNAME E PASSWORD
	$query_credenciais = "SELECT ID_Cuidador, Nome, Email, Imagem FROM  Cuidador WHERE Username=? AND Password=?";

	if ($stmt = $sqli_connection -> prepare($query_credenciais)){

		$stmt -> bind_param("ss", $username, $password);
		$result = $stmt -> execute();

		$stmt -> bind_result($id, $nome, $mail);

		$resultados = $stmt->get_result();
		$cuidador=[];

		while($dados= $resultados->fetch_array(MYSQLI_ASSOC)){

			$id_cuidador=$dados['ID_Cuidador'];
			$nome=$dados['Nome'];
			$mail=$dados['Email'];
			$imagem=$dados['Imagem'];	
		}

		$stmt -> close();
		$verifica_credenciais="true";



	}else{
	 	
	 }



}




?>