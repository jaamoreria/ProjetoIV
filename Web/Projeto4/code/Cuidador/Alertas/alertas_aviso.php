<?php


include ("../../../BD.php");




if(isset($_POST['id'])){


	
	$dados = [];
	$id=$_POST['id'];



	$query2 = "SELECT ID_Alerta, ID_Monitorizado, Data_Hora as data, Estado from alertas WHERE Estado='0' AND ID_Monitorizado in (SELECT ID_Monitorizado from grupo WHERE ID_Cuidador='$id')";
	$results2 = mysqli_query($sqli_connection,$query2);

	while($row= mysqli_fetch_assoc($results2)){

		$grupo_dados_query = "SELECT Nome from monitorizado WHERE ID_Monitorizado=".$row['ID_Monitorizado'];
		$result = mysqli_query($sqli_connection,$grupo_dados_query);
		$monitorizado = mysqli_fetch_assoc($result);

		
		

		
		$nome = $monitorizado['Nome'];
		$data = $row['data'];
		$id_alerta = $row['ID_Alerta'];
		array_push($dados, array(
			'id' => $id_alerta,
			'nome' => $nome,
			'data' => $data

			));
		
		

		
		


		


	}
}

echo json_encode($dados,JSON_NUMERIC_CHECK);




?>







