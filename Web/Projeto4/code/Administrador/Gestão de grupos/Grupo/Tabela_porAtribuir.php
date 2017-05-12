<form method='POST' id='form' >
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

  <input class="btn btn-default" type='submit' name="check"> 
</form>
<?php
if(isset($_POST['check'])){
  
  include('guarda_atribuições.php');
  
}
?>




