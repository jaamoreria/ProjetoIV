<HTML>
  <body>
    <?php 
    session_start();
    $id_cuidador= $_SESSION['login_user_id'];
    ?>

    <style>
      td {
        font-weight: normal;
      }
    </style>


    <?php

  include ("../../../../BD.php"); // ligação à BD

 

  
  
  $query_obterDados="SELECT ID_Monitorizado, Data_Hora as data from alertas WHERE Estado = '1' AND ID_Monitorizado in (SELECT ID_Monitorizado from grupo WHERE ID_Cuidador='$id_cuidador')";

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($area = mysqli_fetch_array($dados)){


   include("conversoes.php");
   $dados_query = "SELECT Nome from monitorizado WHERE ID_Monitorizado=".$area['ID_Monitorizado'];
   $result = mysqli_query($sqli_connection,$dados_query);
   $monitorizado = mysqli_fetch_assoc($result);

   ?>
   <tr>
    <td><?php echo $monitorizado['Nome']; ?></td>
    <td>O monitorizado saiu da área segura</td>
    <td><?php echo $data; ?></td>

  </tr>


  <?php

}
?>












</body>
</html>




