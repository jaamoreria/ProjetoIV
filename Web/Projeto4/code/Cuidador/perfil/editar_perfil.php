<?php


$id=$_POST["id"];
$nomeEdit=$_POST["nome"];
$usernameEdit=$_POST["username"];
$mailEdit=$_POST["email"];
$passEdit=$_POST["password"];
$telemovelEdit=$_POST["telemovel"];





include ("../../../BD.php");



$query = "UPDATE  cuidador SET Nome=?,Email=?,Username=?, Password=?, Telemovel=? WHERE ID_Cuidador=?";


//QUERIE IS CORRECT


if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("ssssss", $nomeEdit, $mailEdit, $usernameEdit, $passEdit, $telemovelEdit, $id);
    $result = $stmt -> execute();
    $stmt -> close();


    /*echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i></h4>
                Dados do utilizador alterado com sucesso
              </div>';*/



$_SESSION['login_user_username']=$usernameEdit;
$_SESSION['login_user_mail']=$mailEdit;
$_SESSION['login_user_nome']=$nomeEdit;


              

    

}


?>





