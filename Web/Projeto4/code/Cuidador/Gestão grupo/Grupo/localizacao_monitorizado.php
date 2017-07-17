<?php



if(isset($_POST['id'])){
include ("../../../../BD.php");
$coordenadas = [];
$id=$_POST['id'];

$query_local = "SELECT MAX(ID_Historico) as max, Latitude, Longitude from historico_localizacao WHERE ID_Monitorizado='$id'";
$results_local = mysqli_query($sqli_connection,$query_local);

$local=mysqli_fetch_assoc($results_local);
$count=mysqli_num_rows($results_local);







if($count!=0){
	$lat = $local['Latitude'];
	
	$latFinal = str_replace(",",".",$lat);
	$long = $local['Longitude'];
	$longFinal = str_replace(",",".",$long);

	

	array_push($coordenadas, array(
		'lat' => $latFinal,
		'lng' => $longFinal
		));
echo json_encode($coordenadas,JSON_NUMERIC_CHECK);
	
}

}


?>





