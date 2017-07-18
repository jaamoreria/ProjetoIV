

<?php

  include ("../../../../BD.php"); // ligação à BD

  
  
  $query_obterDados="SELECT isPrincipal from grupo WHERE ID_Cuidador='$id_cuidador' AND ID_Monitorizado=".$id;

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  $permissões = mysqli_fetch_assoc($dados);

  $principal = $permissões['isPrincipal'];



 ?>

