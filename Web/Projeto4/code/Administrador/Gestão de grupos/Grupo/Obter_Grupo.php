<HTML>
  <body>

    <style>
      td {
        font-weight: normal;
      }
    </style>


    <?php

  include ("../../../../BD.php"); // ligação à BD
  
  $query_obterDados="SELECT ID_Cuidador, Nome, Email, Telemovel from cuidador WHERE ID_Cuidador in (SELECT ID_Cuidador from grupo WHERE ID_Monitorizado='$id')";

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($monitorizado = mysqli_fetch_array($dados)){

    $grupo_dados_query = "SELECT isPrincipal, Recebe_SMS, Recebe_MAIL from grupo WHERE ID_Monitorizado='$id' AND ID_Cuidador=".$monitorizado['ID_Cuidador'];
    $result = mysqli_query($sqli_connection,$grupo_dados_query);
    $grupo = mysqli_fetch_assoc($result);

    ?>
    <tr>
      <td><?php echo $monitorizado['Nome']; ?></td>
      <td><?php echo $monitorizado['Email']; ?></td>
      <td><?php echo $monitorizado['Telemovel']; ?></td>

      <td><select style="background: transparent; border:none;" onchange='myFunction(<?php echo $id ?>,<?php echo $monitorizado['ID_Cuidador']; ?>)' name="<?php echo $monitorizado['ID_Cuidador']; ?>" id="<?php echo $monitorizado['ID_Cuidador']; ?>"> 

        <?php
        if($grupo['isPrincipal']=="Sim"){
         echo '<option selected="selected">'.$grupo['isPrincipal'].'</option>';
         echo '<option value="Não">Não</option>';
       }else{
        echo '<option value="Sim">Sim</option>';
        echo '<option selected="selected">'.$grupo['isPrincipal'].'</option>';
        
      }
      ?>
    </select>

    <span id="<?php echo $monitorizado['ID_Cuidador']."check"; ?>" class="glyphicon glyphicon-check"  style="position: relative; float: right; margin-top:0px; color:green; display:none;"></span>
    <span id="<?php echo $monitorizado['ID_Cuidador']."erro"; ?>" class="glyphicon glyphicon-ban-circle"  style="position: relative; float: right; margin-top:0px; color:red; display:none;"></span>

  </td>
  <td><?php echo $grupo['Recebe_SMS']."/".$grupo['Recebe_MAIL'] ?></td>
</td>
<td>
  <span type="submit" class="btn glyphicon glyphicon-chevron-right getDados"  style="position: relative; float: right; margin-right: -5px" data-id="<?php echo $monitorizado['ID_Monitorizado']; ?>"></span> 
</td>                   
</tr>

<?php
}
?>




<script src="../../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>

  $('.getDados').click(function() {
    var ID=$(tdis).attr('data-id');

    $.ajax({
      type: 'POST',
      url: "sessão.php",
      data:{"id": ID},
      success:function(data){
       window.location="Listar_grupo.php"
     }
   });

  });
  

</script>

<script>

  function myFunction(monitorizado,user) {


    var selecionado = $('select[name="' + user + '"] option:selected').val();


    $.ajax({
      type: 'POST',
      url: "isPrincipal.php",
      data:{id:user,estado:selecionado, id_monitorizado:monitorizado},
      success:function(data){

       if($.trim(data)=="Erro"){
        $("#"+user+"check").hide();
        $("#"+user+"erro").show(); 
        $("#"+user+"erro").fadeIn().delay(1000).fadeOut();
        $("#"+user).val("Não");

      }else{
        $("#"+user+"erro").hide(); 
        $("#"+user+"check").show(); 
        $("#"+user+"check").fadeIn().delay(1000).fadeOut();
        

      }
    }

  });

  }

</script>


</body>
</html>



