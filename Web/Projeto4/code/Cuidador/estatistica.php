<?php

  include ("../../BD.php"); // ligação à BD

  

  $query1 = "SELECT COUNT(*) as conta FROM grupo WHERE ID_Cuidador='$id_cuidador'";
  $results1 = mysqli_query($sqli_connection,$query1);
  $contagem_grupos=mysqli_fetch_assoc($results1);


  $query2 = "SELECT COUNT(*) as conta FROM `grupo` WHERE ID_Cuidador='$id_cuidador' AND isPrincipal='Sim'";
  $results2 = mysqli_query($sqli_connection,$query2);
  $contagem_principal=mysqli_fetch_assoc($results2);


  

  

  ?>