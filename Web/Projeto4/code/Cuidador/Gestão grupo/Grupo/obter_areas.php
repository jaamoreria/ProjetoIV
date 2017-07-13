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

  $principalControlo_query = "SELECT isPrincipal from grupo WHERE ID_Monitorizado='$id' AND ID_Cuidador=".$id_cuidador;
    $result_principal = mysqli_query($sqli_connection,$principalControlo_query);
    $principal = mysqli_fetch_assoc($result_principal);
  
  $query_obterDados="SELECT ID_Cuidador, Username, Nome, Email, Telemovel from cuidador WHERE ID_Cuidador in (SELECT ID_Cuidador from grupo WHERE ID_Monitorizado='$id')";

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($monitorizado = mysqli_fetch_array($dados)){

    $grupo_dados_query = "SELECT isPrincipal, Aviso_SMS_MAIL, Definir_Areas from grupo WHERE ID_Monitorizado='$id' AND ID_Cuidador=".$monitorizado['ID_Cuidador'];
    $result = mysqli_query($sqli_connection,$grupo_dados_query);
    $grupo = mysqli_fetch_assoc($result);

    ?>
    <tr>
      <td><?php echo $monitorizado['Nome']; ?></td>
      <td><?php echo $monitorizado['Email']; ?></td>
          
</tr>

<?php
}
?>





          

          

          

          


        </body>
        </html>



