<HTML>
  <body>
    <?php 
    
    $id_cuidador= $_SESSION['login_user_id'];
    ?>

    <style>
      td {
        font-weight: normal;
      }
    </style>


    <?php

  include ("../../BD.php"); // ligação à BD

  
  
  $query_obterDados="SELECT ID_Alerta, ID_Monitorizado, Data_Hora as data, Estado from alertas WHERE ID_Monitorizado in (SELECT ID_Monitorizado from grupo WHERE ID_Cuidador='$id_cuidador')";

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($alertas = mysqli_fetch_array($dados)){

    $grupo_dados_query = "SELECT Nome from monitorizado WHERE ID_Monitorizado=".$alertas['ID_Monitorizado'];
    $result = mysqli_query($sqli_connection,$grupo_dados_query);
    $monitorizado = mysqli_fetch_assoc($result);


    include("conversoes.php");

    ?>
    <tr>
      <td><?php echo $monitorizado['Nome']; ?></td>
      <td><?php echo $data ?></td>
      
      <?php
      if($alertas['Estado']=='0'){ ?>
      <td><select style="background: transparent; border:none;" onchange='estado(<?php echo $alertas['ID_Alerta'] ?>, this)' id='<?php echo "escolha".$alertas['ID_Alerta'] ?>'> 

        <?php
        
        echo '<option selected="selected">Não encontrado</option>';
        echo '<option value="Não">Encontrado</option>';

        
        

        ?>
      </select>



      <span id="<?php echo $alertas['ID_Alerta']."check"; ?>" class="glyphicon glyphicon-check"  style="position: relative; float: right; margin-top:0px; color:green; display:none;"></span>
      <span id="<?php echo $alertas['ID_Alerta']."erro"; ?>" class="glyphicon glyphicon-ban-circle"  style="position: relative; float: right; margin-top:0px; color:red; display:none;"></span>

    </td>
    <?php }else{ ?>


    <td>Encontrado</td>

    <?php } ?>


  </tr>

  <?php
}
?>










<script>





  function estado(id, escolha) {

    
    
    
    
    var escolhaText = escolha.options[escolha.selectedIndex].text;

    $.ajax({
      type: 'POST',
      url: "Alertas/guardar_escolha.php",
      data:{id:id},
      success:function(data){
        


       if($.trim(data)=="Erro"){
        $("#"+id+"check").hide();
        $("#"+id+"erro").show(); 
        $("#"+id+"erro").fadeIn().delay(1000).fadeOut();
        $("#escolha"+id).val("Não");

      }else{
        $("#"+id+"erro").hide(); 
        $("#"+id+"check").show(); 
        $("#"+id+"check").fadeIn().delay(1000).fadeOut();


      }
    }

  });

  }

  

</script>









</body>
</html>



