<?php



function existencia_admin($username, $password) {

	$verificação="false";

	if($username=="Admin" && $password=="admin") $verificação="true";
	
	return $verificação;
}

$verifica_credenciais="false";	


?>