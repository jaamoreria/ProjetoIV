<HTML>
  <body>




    <?php
    
  include ("../../../BD.php"); // ligação à BD
  


  $query_obterDados = "SELECT ID_Cuidador, Nome, Username, Telemovel, Email, Data_Admissao, Imagem from cuidador";
  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($cuidador = mysqli_fetch_array($dados)){

    ?>
    <tr>
      <th><?php echo $cuidador['Nome']; ?></th>
      <th><?php echo $cuidador['Username']; ?></th>
      <th><?php echo $cuidador['Email']; ?></th>
      <th><?php echo $cuidador['Telemovel']; ?></th>
      <th><?php echo $cuidador['Data_Admissao']; ?></th>
    </td>
    <td>
      <span class="btn glyphicon glyphicon-trash" id ="apagarBtn" style="position: relative; float: right; margin-right: -5px"></span>
      <span class="btn glyphicon glyphicon-pencil"   style="position: relative; float: right; margin-right: -5px"></span>
      <span class="btn glyphicon glyphicon-eye-open"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalDetalhes"></span>
    </td>                   
  </tr>

  <?php
}
?>


<!-- Modal detalhes do cuidador -->
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

              <label for="recipient-nome" class="control-label">Nome:</label><output name="nome" type="text" class="form-control" id="recipient-nome">
            </div>

            <div class="form-group">
              <label for="recipient-username" class="control-label">Username:</label>
              <output name="username" type="text" class="form-control" id="recipient-username">
              </div>

              <div class="form-group">
                <label for="recipient-email" class="control-label">Email:</label>
                <output name="email" type="email" class="form-control" id="recipient-email">
                </div>

                <div class="form-group">
                  <label for="recipient-cargo" class="control-label">Cargo:</label>
                  <output name="cargo" type="email" class="form-control" id="recipient-cargo">
                  </div>

                  <div class="form-group">
                    <label for="recipient-tipo" class="control-label">Tipo de utilizador:</label>
                    <output name="tipo" type="email" class="form-control" id="recipient-tipo">
                    </div>

                    <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <script>

            $('#ModalDetalhes').on('show.bs.modal', function (event) {
              $("html").css("margin-right", "-"+width+"px");

              var button = $(event.relatedTarget) 
              var recipientid = button.data('id')
              var recipientnome = button.data('nome')
              var recipientmail = button.data('email')
              var recipientusername = button.data('username')
              var recipientcargo = button.data('cargos')
              var recipienttipo = button.data('tipos')


              var modal = $(this)
              modal.find('#id').val(recipientid)
              modal.find('#recipient-nome').val(recipientnome)
              modal.find('#recipient-username').val(recipientusername)
              modal.find('#recipient-email').val(recipientmail)
              modal.find('#recipient-cargo').val(recipientcargo)
              modal.find('#recipient-tipo').val(recipienttipo)



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

          <!-- Acaba a modal de visualizar detalhes -->

          <!-- modal editar -->
          <div class="container">
            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalEditLabel">Detalhes</h4>
                  </div>

                  <div class="modal-body">
                    <form id="f1" method="POST" action="../PHP/editar_utilizador.php" enctype="multipart/form-data" autocomplete="off">
                      <div class="form-group" id="imagem">
                      </div>
                      <div class="form-group">
                        <label for="recipient-nome" class="control-label">Nome:</label>
                        <input name="nome" type="text" class="form-control" id="recipient-nome" required>
                      </div>

                      <div class="form-group">
                        <label for="recipient-username" class="control-label">Username:</label>
                        <input name="username" type="text" class="form-control" id="recipient-username" required>
                        <label class="error" id="user_error" style="display:none;"/>
                      </div>

                      <div class="form-group">
                        <label for="recipient-email" class="control-label">Email:</label>
                        <input name="email" type="email" class="form-control" id="recipient-email" required>
                        <label class="error" id="mail_error" style="display:none;"/>
                      </div>

                      <div class="form-group">
                        <label for="recipient-tipo" class="control-label">Tipo de utilizador:</label>

                        <?php

                        echo '<select name="tipo" type="text" class="form-control" id="recipient-tipo" required>'; 

                        $query4 = "SELECT * from tipo_utilizador";
                        $results4 = mysqli_query($sqli_connection,$query4);

                        while ($tipos = mysqli_fetch_array($results4)) {

                          echo '<option>'.$tipos['Tipo'].'</option>';             
                        }
                        echo '</select>';
                        ?>
                      </div>

                      <div class="form-group">
                        <label for="recipient-cargo" class="control-label">Cargo:</label>
                        <?php
                        echo '<select name="cargo" type="text" class="form-control" id="recipient-cargo" required>'; 

                        $query5 = "SELECT * from cargo";
                        $results5 = mysqli_query($sqli_connection,$query5);

                        while ($cargos = mysqli_fetch_array($results5)) {

                          echo '<option>'.$cargos['Cargo'].'</option>';
                        }
                        echo '</select>';
                        ?>
                      </div>
                      <input name="id" type="hidden" class="form-control" id="id_editar">
                      <button type="submit" name="sub_user" class="btn btn-success" >Alterar</button>
                      <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>





            <script type="text/javascript">

              $('#ModalEdit').on('show.bs.modal', function (event) {
                $("html").css("margin-right", "-"+width+"px");

                var button = $(event.relatedTarget) 
                var recipient = button.data('ModalEditLabel')
                var id = button.data('id')  
                var recipientnome = button.data('nome')
                var recipientmail = button.data('email')
                var recipientusername = button.data('username')
                var recipientcargo = button.data('cargos')
                var recipienttipo = button.data('tipos')


                var modal = $(this)
                modal.find('.modal-title').text(recipient)
                modal.find('#id-curso').val(recipient)
                modal.find('#recipient-nome').val(recipientnome)
                modal.find('#recipient-username').val(recipientusername)
                modal.find('#recipient-email').val(recipientmail)
                modal.find('#recipient-cargo').val(recipientcargo)
                modal.find('#recipient-tipo').val(recipienttipo)
                modal.find('#id_editar').val(id) 

              });

            </script>

            <!-- acaba modal editar -->




            <!-- acaba modal ver detalhes -->


            <!--  modal apagar -->

            <div class="modal fade" id="ModalApagar" aria-labelledby="ModalApagarLabel" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Confirmação de apagar</h4>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="" enctype="multipart/form-data">
                        <p>Têm a certeza que deseja eliminar este utilizador?</p>
                      </div>

                      <div hidden="" class="form-group">
                        <label hidden="" for="recipient-cargo" class="control-label">Cargo:</label>
                        <?php
                        echo '<select name="cargo" type="text" class="form-control" id="recipient-cargo" >'; 

                        $query5 = "SELECT * from cargo";
                        $results5 = mysqli_query($sqli_connection,$query5);

                        while ($cargos = mysqli_fetch_array($results5)) {

                          echo '<option>'.$cargos['Cargo'].'</option>';
                        }
                        echo '</select>';
                        ?>
                      </div>

                      <div hidden "" class="form-group">
                        <label hidden= "" for="recipient-temObjetivo" class="control-label">Tipo de utilizador:</label>
                        <input name="temObjetivo" type="text" class="form-control" id="recipient-temObjetivo">
                      </div>


                      <div class="modal-footer">

                        <input name="id" type="hidden" class="form-control" id="id_apagar">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal" name= "cancelar">Cancelar</button>
                        <button type="submit" class="btn btn-success" name="confirmar" id ="confirmar" style="margin-right: 1%">Confirmar</button>
                      </form>
                    </div>
                  </div>



                  <?php
                  if(isset($_POST["confirmar"])){

                   $id=$_POST['id'];
                   $cargoApagar=$_POST['cargo'];







                   include ("apagarUser.php");
                 }



                 ?>






                 <script type="text/javascript">
                   $('#ModalApagar').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) 
                    var recipient = button.data('ModalApagarLabel')
                    var recipientcargo = button.data('cargos')
                    var recipientTemObjetivo = button.data('temObjetivo')





                    var id = button.data('id')  

                    $("#id_apagar").attr("value",id);
                    $("#recipient-cargo").attr("value", recipientcargo);
                    $("#recipient-temObjetivo").attr("value", recipientTemObjetivo);






                    var modal = $(this)
                    modal.find('.modal-title').text(recipient)
                    modal.find('#id-apagar').val(recipient)
                    modal.find('#recipient-cargo').val(recipientcargo)
                    modal.find('#recipient-temObjetivo').val(recipientTemObjetivo)




                  })


                </script>

                <script src="js/controlo_editar.js"></script>


              </body>
              </html>



