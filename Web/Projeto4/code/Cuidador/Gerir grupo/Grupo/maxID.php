<?php


include ("../../../../BD.php");


$last_id;

$query_max = "SELECT Max(ID_Area) as max from area_segura";
$results_max = mysqli_query($sqli_connection,$query_max);

$id=mysqli_fetch_array($results_max);

if($id['max']==null){
  $last_id=1;

}else{
  $last_id=$id['max']+1;
}

echo $last_id;


?>





