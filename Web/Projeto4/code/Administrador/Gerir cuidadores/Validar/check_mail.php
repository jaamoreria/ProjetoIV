<?php

include("../../../../BD.php");





$mail = mysqli_real_escape_string($sqli_connection, $_POST['email']);
 



$sql_query="SELECT ID_Cuidador FROM cuidador WHERE Email='$mail'";
$result=mysqli_query($sqli_connection,$sql_query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);
 
    if($count > 0)
    {
        // username is already exist 
        echo ("Já utilizado");
    }
    else
    {
        // username is avaialable to use.
        echo ("Disponivel");
    }
?>



