<?php


include ("../../../../BD.php");




if(isset($_POST['id']) && isset($_POST['info']) && isset($_POST['coordenadas']) && isset($_POST['id_monitorizado']) && isset($_POST['id_cuidador']) && isset($_POST['raio'])){
	$desc=$_POST['info'];
	$latlon=$_POST['coordenadas'];
	$monitorizado=$_POST['id_monitorizado'];
	$cuidador=$_POST['id_cuidador'];
	$id=$_POST['id'];
	$raio=$_POST['raio'];

	$serialized_array = serialize($latlon); 

	$tipo="circle";
	$data = date('Y-m-d G:i:s');



	
	$query = "INSERT INTO area_segura (ID_Area, ID_Monitorizado, LatLong, Descricao, ID_Cuidador, Tipo, Raio, Data) VALUES (?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("ssssssss",$id, $monitorizado, $serialized_array, $desc, $cuidador, $tipo, $raio, $data);
		$result = $stmt -> execute();
		$stmt -> close();

		
		

	}

}





?>







