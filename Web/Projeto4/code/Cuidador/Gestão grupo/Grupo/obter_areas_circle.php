<?php


include ("../../../../BD.php");




if(isset($_POST['id'])){


	
	$coordenadas = [];
	$monitorizado=$_POST['id'];



	$query2 = "SELECT ID_Area, LatLong, Raio, Descricao FROM area_segura  WHERE Tipo='Circle' AND ID_Monitorizado=".$monitorizado;
	$results2 = mysqli_query($sqli_connection,$query2);

	while($row= mysqli_fetch_assoc($results2)){
    

		
		

		$rray = unserialize($row['LatLong']); 
		$desc = $row['Descricao'];
		$id = $row['ID_Area'];
		$raio = $row['Raio'];
		array_push($coordenadas, array(
			'coordenadas' => $rray,
			'desc' => $desc,
			'id' => $id,
			'raio' => $raio

			));
		
		

		
		


		


	}
}

echo json_encode($coordenadas,JSON_NUMERIC_CHECK);




?>







