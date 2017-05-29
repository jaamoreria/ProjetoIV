<?php


if(isset($_POST["username"]) && isset($_POST["password"])){

	//QUERY QUE VERIFICA O USERNAME E PASSWORD
	$query_credenciais = "SELECT ID_Cuidador, Nome, Email, Imagem FROM  Cuidador WHERE Username=? AND Password=?";

	if ($stmt = $sqli_connection -> prepare($query_credenciais)){

		$stmt -> bind_param("ss", $username, $password);
		$result = $stmt -> execute();


		$stmt->bind_result($id, $Nome, $Email, $Imagem);
		$stmt->store_result();
		$conta=$stmt->num_rows;

		

		if($conta!=0){
			
			$cuidador=[];

			while($dados= $stmt->fetch()){

				$id_cuidador=$id;
				$nome=$Nome;
				$mail=$Email;
				$imagem=$Imagem;
				
			}

			$stmt -> close();
			$verifica_credenciais="true";

		}else{
			$verifica_credenciais="false";
		}

	}else{

	}



}




?>