<?php


include ("../../../../../BD.php");




if(isset($_POST['idd'])){


	
	
	$desc;
	$area=$_POST['idd'];
	$desc;
	$nome;
	$dados=[];

	


	$query = "SELECT Descricao, ID_Cuidador FROM area_segura  WHERE ID_Area=".$area;
	$results = mysqli_query($sqli_connection,$query);

	$row=mysqli_fetch_assoc($results);
	$desc=$row['Descricao'];


	$query2 = "SELECT Nome FROM cuidador  WHERE ID_Cuidador=".$row['ID_Cuidador'];
	$results2 = mysqli_query($sqli_connection,$query2);
	

	$row2=mysqli_fetch_assoc($results2);
	$nome=$row2['Nome'];

	array_push($dados, array(
		'Descricao' => $desc,
		'Nome' => $nome
		));

	
	echo json_encode($dados,JSON_NUMERIC_CHECK);
}





?>







