<?php


include ("../../../../BD.php");



$id=$_POST['id_data'];



$query4 = "SELECT Imagem from monitorizado WHERE ID_Monitorizado=".$id;
$results4 = mysqli_query($sqli_connection,$query4);
$rows4 = mysqli_fetch_array($results4);

echo '<img class="img-circle" alt="User Avatar" src="data:image/jpeg;base64,' . base64_encode( $rows4['Imagem'] ) . '" />';

?>





