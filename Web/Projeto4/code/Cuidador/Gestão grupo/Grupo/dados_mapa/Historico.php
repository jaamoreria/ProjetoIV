<?php


include ("../../../../../BD.php");




if(isset($_POST['id']) && isset($_POST['data_inicio']) && isset($_POST['data_fim']) && isset($_POST['hora_inicio']) && isset($_POST['hora_fim'])){


	
	$coordenadas = [];
	$monitorizado=$_POST['id'];
	$data_inicio=$_POST['data_inicio'];
	$data_fim=$_POST['data_fim'];
	$hora_inicio=$_POST['hora_inicio'];
	$hora_fim=$_POST['hora_fim'];
	$inicio = date("Y-m-d", strtotime($data_inicio))." ".$hora_inicio;
	$fim = date("Y-m-d", strtotime($data_fim))." ".$hora_fim;;




	$query2 = "SELECT Latitude, Longitude FROM historico_localizacao WHERE DataHora BETWEEN '$inicio' AND '$fim' AND ID_Monitorizado=".$monitorizado;
	$results2 = mysqli_query($sqli_connection,$query2);

	while($row= mysqli_fetch_assoc($results2)){
    

		
		

		$lat = $row['Latitude'];
		$latFinal = str_replace(",",".",$lat);
		$long = $row['Longitude'];
		$longFinal = str_replace(",",".",$long);
		
		array_push($coordenadas, array(
			'lat' => $latFinal,
			'lng' => $longFinal
			));
		
		

		
		


		


	}
}

echo json_encode($coordenadas,JSON_NUMERIC_CHECK);




?>







