<HTML>
  <body>


<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>

    <?php
    
  include ("../../../BD.php"); // ligação à BD
  
  


  $query_obterDados = "SELECT ID_Monitorizado, Nome, IMEI, Descricao, Data_Nascimento, Data_Admissao from monitorizado";
  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($monitorizado = mysqli_fetch_array($dados)){
    

    ?>
    <tr>
      <td><?php echo $monitorizado['Nome']; ?></td>
      <td><?php echo $monitorizado['IMEI']; ?></td>
      <td><?php echo $monitorizado['Descricao']; ?></td>
      <td><?php echo $monitorizado['Data_Nascimento']; ?></td>
      <td><?php echo $monitorizado['Data_Admissao']; ?></td>
    </td>
    <td>
      <span class="btn glyphicon glyphicon-trash"  style="position: relative; float: right; margin-right: -5px"></span>

      <span class="btn glyphicon glyphicon-pencil"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalEdit" data-id="<?php echo $monitorizado['ID_Monitorizado']; ?>" data-nome="<?php echo $monitorizado['Nome']; ?>" data-imei="<?php echo $monitorizado['IMEI']; ?>" data-descricao="<?php echo $monitorizado['Descricao']; ?>" data-nasc="<?php echo $monitorizado['Data_Nascimento']; ?>"></span>

      <span class="btn glyphicon glyphicon-eye-open"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalDetalhes"  data-id="<?php echo $monitorizado['ID_Monitorizado']; ?>" data-nome="<?php echo $monitorizado['Nome']; ?>" data-imei="<?php echo $monitorizado['IMEI']; ?>" data-descricao="<?php echo $monitorizado['Descricao']; ?>" data-nasc="<?php echo $monitorizado['Data_Nascimento']; ?>" ></span>
    </td>                   
  </tr>

  <?php
}
?>


<!-- Modal detalhes do monitorizado -->
<div class="container">
  <div class="modal fade" id="ModalDetalhes" tabindex="-1" role="dialog" aria-labelledby="ModalDetalhesLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="ModalDetalhesLabel">Detalhes</h4>
        </div>

        <div class="modal-body">
          <form method="POST" action="" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group" id="imagem">
            </div>

            <div class="form-group" style="display: none;">
             <label for="recipient-id" class="control-label">ID:</label>
             <output name="id" type="text" class="form-control" id="recipient-id">
             </div>

             <div class="form-group">

              <label for="recipient-nome" class="control-label">Nome:</label>
              <output name="nome" type="text" class="form-control" id="recipient-nome">
              </div>

              <div class="form-group">
                <label for="recipient-imei" class="control-label">IMEI:</label>
                <output name="imei" type="text" class="form-control" id="recipient-imei">
                </div>

                <div class="form-group">
                  <label for="recipient-desc" class="control-label">Descrição:</label>
                  <output name="desc" type="text" class="form-control" id="recipient-desc">
                  </div>

                  <div class="form-group">
                    <label for="recipient-nasc" class="control-label">Data de nascimento:</label>
                    <output name="nasc" type="text" class="form-control" id="recipient-nasc">
                    </div>
                    <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          
          
          <script>
            $('#ModalDetalhes').on('show.bs.modal', function (event) {


              var button = $(event.relatedTarget) 
              var recipientid = button.data('id')
              var recipientnome = button.data('nome')
              var recipientimei = button.data('imei')
              var recipientdescrição = button.data('descricao')
              var recipientnasc = button.data('nasc')



              var modal = $(this)
              modal.find('#id').val(recipientid)
              modal.find('#recipient-nome').val(recipientnome)
              modal.find('#recipient-imei').val(recipientimei)
              modal.find('#recipient-desc').val(recipientdescrição)
              modal.find('#recipient-nasc').val(recipientnasc)



              $.ajax({
                type: 'POST',
                url: "imagens.php",
                data:{id_data: recipientid},
                success:function(data){
                 $('#imagem').html(data);
               }
             });



            });

          </script>



          <!-- acaba modal editar -->

          <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="ModalEditLabel">Editar</h4>
                </div>

                <div class="modal-body">
                  <form name ="f2" id="f2" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group" id="imagem">
                    </div>

                    <div class="form-group" style="display: none;" id="idEdit">
                     <label for="editar-idEdit" class="control-label">ID:</label>
                     <input name="idEdit" type="text" class="form-control" id="editar-idEdit">
                   </div>

                   <div class="form-group" id="nomeEdit">

                    <label for="editar-nomeEdit" class="control-label">Nome:</label>
                    <input name="nomeEdit" type="text" class="form-control" id="editar-nomeEdit">
                    <label class="control-label" for="editar-nomeEdit" id="vazio-nomeEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label> 
                  </div>

                  <div class="form-group" id="imeiEdit">
                    <label for="editar-imeiEdit" class="control-label">IMEI:</label>
                    <input name="imeiEdit" type="text" class="form-control" id="editar-imeiEdit">
                    <label class="control-label" for="editar-imeiEdit" id="erro_imeiEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Já utilizado</label>
                    <label class="control-label" for="editar-imeiEdit" id="sucesso_imeiEdit" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
                    <label class="control-label" for="editar-imeiEdit" id="vazio-imeiEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
                  </div>

                  <div class="form-group" id="descEdit">
                    <label for="editar-descEdit" class="control-label">Descrição:</label>
                    <input name="descEdit" type="text" class="form-control" id="editar-descEdit">
                    <label class="control-label" for="editar-descEdit" id="vazio-descEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
                  </div>

                  <div class="form-group" id="nascEdit">
                    <label for="editar-nascEdit" class="control-label">Data de nascimento:</label>
                    <input name="nascEdit" type="text" class="form-control" id="editar-nascEdit" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                    <label class="control-label" for="editar-nascEdit" id="vazio-nascEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
                  </div>
                  <button type="button" name="submeter_user" class="btn btn-success ajax"  id="edit">Submeter</button>
                  <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
              </div>
            </div>
          </div>
        </div>



        <script>
          var recipientid
          var recipientnome
          var recipientimei
          var recipientdesc
          var recipientnasc


          $('#ModalEdit').on('show.bs.modal', function (event) {


            var button = $(event.relatedTarget) 
            var recipientid = button.data('id')
            var recipientnome = button.data('nome')
            var recipientimei = button.data('imei')
            var recipientdescrição = button.data('descricao')
            var recipientnasc = button.data('nasc')



            var modal = $(this)
            modal.find('#editar-idEdit').val(recipientid)
            modal.find('#editar-nomeEdit').val(recipientnome)
            modal.find('#editar-imeiEdit').val(recipientimei)
            modal.find('#editar-descEdit').val(recipientdescrição)
            modal.find('#editar-nascEdit').val(recipientnasc)



          });


        </script>

        
        <script src="Validar/validacao_editar_monitorizado.js"></script>


      </body>
      </html>



