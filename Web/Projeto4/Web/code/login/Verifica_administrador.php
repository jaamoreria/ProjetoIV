<?php



function existencia_admin($username, $password) {

	$verificação;

	if($username=="Admin" && $password=="admin"){
		$verificação="true";
	}else{
		$verificação="false";
	}
	
	return $verificação;
}




?>