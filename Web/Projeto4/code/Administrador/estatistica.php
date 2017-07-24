<?php

  include ("../../BD.php"); // ligação à BD

  

  $query1 = "SELECT COUNT(*) as conta FROM cuidador";
  $results1 = mysqli_query($sqli_connection,$query1);
  $contagem_cuidador=mysqli_fetch_assoc($results1);


  $query2 = "SELECT COUNT(*) as conta FROM monitorizado";
  $results2 = mysqli_query($sqli_connection,$query2);
  $contagem_monitorizado=mysqli_fetch_assoc($results2);

  $query3 = "SELECT sum(a.cnt) as conta from ( SELECT count(*) as cnt from grupo group by ID_Monitorizado ) as a";
  $results3 = mysqli_query($sqli_connection,$query3);
  $contagem_grupo=mysqli_fetch_assoc($results3);



  ?>