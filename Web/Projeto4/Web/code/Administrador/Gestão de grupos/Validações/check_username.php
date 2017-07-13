<?php

include("../../../../BD.php");





$username = mysqli_real_escape_string($sqli_connection, $_POST['username']);
 



$sql_query="SELECT ID_Cuidador FROM cuidador WHERE Username='$username'";
$result=mysqli_query($sqli_connection,$sql_query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);
 
    if($count > 0)
    {
       
        echo ("Já utilizado");
    }
    else
    {
        
        echo ("Disponivel");
    }
?>



