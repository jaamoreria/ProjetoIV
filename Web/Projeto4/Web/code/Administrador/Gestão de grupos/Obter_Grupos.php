<HTML>
  <body>




    <?php
    
  include ("../../../BD.php"); // ligação à BD
  


  $query_obterDados = "SELECT ID_Monitorizado, Nome, IMEI, Descricao, Data_Nascimento, Data_Admissao from monitorizado";
  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($monitorizado = mysqli_fetch_array($dados)){

    $conta_query = "SELECT count(*) as contagem from grupo WHERE ID_Monitorizado=".$monitorizado['ID_Monitorizado'];
    $result = mysqli_query($sqli_connection,$conta_query);
    $contagem = mysqli_fetch_assoc($result);

    ?>
    <tr>
      <th><?php echo $monitorizado['Nome']; ?></th>
      <th><?php echo $monitorizado['IMEI']; ?></th>
      <th><?php echo $monitorizado['Data_Nascimento']; ?></th>
      <th><?php echo $contagem['contagem'] ?></th>
    </td>
    <td>
      <span type="submit" class="btn glyphicon glyphicon-chevron-right getDados"  style="position: relative; float: right; margin-right: -5px" data-id="<?php echo $monitorizado['ID_Monitorizado']; ?>"></span> 
    </td>                   
  </tr>

  <?php
}
?>




<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>

  $('.getDados').click(function() {
    var ID=$(this).attr('data-id');

    $.ajax({
      type: 'POST',
      url: "sessão.php",
      data:{"id": ID},
      success:function(data){
       window.location="Grupo/Listar_grupo.php"
     }
   });

  });
  

</script>


</body>
</html>



