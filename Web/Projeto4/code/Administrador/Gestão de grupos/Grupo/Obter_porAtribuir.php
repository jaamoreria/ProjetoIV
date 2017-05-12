<HTML>
  <body>




    <?php
    
  include ("../../../../BD.php"); // ligação à BD
  


  $query_obterDados = "SELECT ID_Cuidador, Nome, Username, Telemovel, Email, Data_Admissao, Imagem, Password from cuidador WHERE ID_Cuidador not in (SELECT ID_Cuidador from grupo WHERE ID_Monitorizado='$id')";
  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($cuidador = mysqli_fetch_array($dados)){

    ?>
    <tr>
      <td><input class="user" type="checkbox" name="checked[]" value="<?php echo $cuidador['ID_Cuidador']?>"/></td>
      <td><?php echo $cuidador['ID_Cuidador']; ?></td>
      <td><?php echo $cuidador['Email']; ?></td>
      <td><?php echo $cuidador['Telemovel']; ?></td>
    </td>
    <td>
      <span class="btn glyphicon glyphicon-trash"  style="position: relative; float: right; margin-right: -5px"></span>

      <span class="btn glyphicon glyphicon-pencil"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalEdit" data-id="<?php echo $cuidador['ID_Cuidador']; ?>" data-nome="<?php echo $cuidador['Nome']; ?>" data-username="<?php echo $cuidador['Username']; ?>" data-telemovel="<?php echo $cuidador['Telemovel']; ?>" data-email="<?php echo $cuidador['Email']; ?>" data-password="<?php echo $cuidador['Password']; ?>"></span>

      <span class="btn glyphicon glyphicon-eye-open"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalDetalhes" data-id="<?php echo $cuidador['ID_Cuidador']; ?>" data-nome="<?php echo $cuidador['Nome']; ?>" data-username="<?php echo $cuidador['Username']; ?>" data-telemovel="<?php echo $cuidador['Telemovel']; ?>" data-email="<?php echo $cuidador['Email']; ?>" ></span>
    </td>                   
  </tr>

  <?php
}
?>




<script src="../../../../plugins/jQuery/jquery-2.2.3.min.js"></script>



</body>
</html>



