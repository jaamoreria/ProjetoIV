<?php

include ("../../../../BD.php");


if(isset($_POST['id'])){

	
	$id=$_POST['id'];

	$query_obterDados="SELECT Tempo_monitorização from monitorizado WHERE ID_Monitorizado=".$id;

	$dados = mysqli_query($sqli_connection,$query_obterDados);
	$tempo = mysqli_fetch_array($dados);

	echo $tempo['Tempo_monitorização'];

}






?>