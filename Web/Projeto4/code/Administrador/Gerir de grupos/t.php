<div class="box-body" id="dados2">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Username</th>
        <th>Email</th>
        <th>Telemóvel</th>
        <th>Data de Admissão</th>
        <th style="text-align:right;">Opções</th>
      </tr>
    </thead>

    <?php include ("Obter_Cuidadores.php"); ?>
    
  </table>
</div>


<script type="text/javascript">

//alert("carregou");

  jQuery.getScript('../../../plugins/jQuery/jquery-2.2.3.min.js');
  jQuery.getScript('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
  jQuery.getScript('../../../bootstrap/js/bootstrap.min.js');

  jQuery.getScript('../../../plugins/datatables/jquery.dataTables.min.js');
  jQuery.getScript('../../../plugins/datatables/dataTables.bootstrap.min.js');
</script>