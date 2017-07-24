<style>
      td {
        font-weight: normal;
      }
    </style>

<div class="box-body" id="dados">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>IMEI</th>
        <th>Data de Nascimento</th>
        <th>Número de elementos no grupo</th>
        <th>Cuidador principal</th>
        <th style="text-align:right;">Opções</th>
      </tr>
    </thead>

    <?php include ("Obter_Monitorizados(Grupo).php"); ?>
  </table>
</div>



