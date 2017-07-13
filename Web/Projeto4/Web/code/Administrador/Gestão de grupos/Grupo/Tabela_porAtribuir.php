
<form method='POST' id='form' name="form">
<table id="example2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Selecionar</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Telemóvel</th>
      <th style="text-align:right;">Opções</th>
    </tr>
  </thead>

  <?php include ("Obter_porAtribuir.php"); ?>
</table>

  <button class="btn btn-default" type='button' name="check" id="check">Associar</button>
</form>

<script>
$("#check").click(function(e) {
  
 $.ajax({
    type: 'POST',
    url: "guarda_atribuições.php",
    data:$("#form").serialize(),
    success:function(data){
     window.location="Listar_Grupo.php";
     
   }
 });
});
</script>






