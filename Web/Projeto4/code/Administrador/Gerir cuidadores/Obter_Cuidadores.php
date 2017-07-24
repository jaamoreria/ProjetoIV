<HTML>
  <body>




    <?php
    
  include ("../../../BD.php"); // ligação à BD
  


  $query_obterDados = "SELECT ID_Cuidador, Nome, Username, Telemovel, Email, Data_Admissao, Imagem, Password from cuidador";
  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($cuidador = mysqli_fetch_array($dados)){

    ?>
    <tr>
      <td><?php echo $cuidador['Nome']; ?></td>
      <td><?php echo $cuidador['Username']; ?></td>
      <td><?php echo $cuidador['Email']; ?></td>
      <td><?php echo $cuidador['Telemovel']; ?></td>
      <td><?php echo $cuidador['Data_Admissao']; ?></td>
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

              <label for="recipient-nome" class="control-label">Nome:</label>
              <output name="nome" type="text" class="form-control" id="recipient-nome">
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
                    <label for="recipient-telemovel" class="control-label">Telemóvel:</label>
                    <output name="telemovel" type="number" class="form-control" id="recipient-telemovel">
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
              var recipientemail = button.data('email')
              var recipientusername = button.data('username')
              var recipienttelemovel = button.data('telemovel')



              var modal = $(this)
              modal.find('#id').val(recipientid)
              modal.find('#recipient-nome').val(recipientnome)
              modal.find('#recipient-username').val(recipientusername)
              modal.find('#recipient-email').val(recipientemail)
              modal.find('#recipient-telemovel').val(recipienttelemovel)



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
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="ModalEditLabel">Editar dados do cuidador</h4>
                </div>
                <div class="modal-body">
                  <form id="f2" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group" style="display: none;">
                     <label for="recipient-id" class="control-label">ID:</label>
                     <input name="id" type="text" class="form-control" id="recipient-id">
                   </div>
                   <div class="form-group" id="nomeEdit">
                     <label for="editar-nomeEdit" class="control-label">Nome:</label>
                     <input name="nomeEdit" type="text" class="form-control" id="editar-nomeEdit" required>

                     <label class="control-label" for="editar-nomeEdit" id="vazio-nomeEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
                   </div>

                   <div class="form-group" id="usernameEdit">
                    <label for="editar-usernameEdit" class="control-label">Username:</label>
                    <input name="usernameEdit" type="text" class="form-control" id="editar-usernameEdit" required>

                    <label class="control-label" for="editar-usernameEdit" id="erro_usernameEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Não disponível</label>
                    <label class="control-label" for="editar-usernameEdit" id="sucesso_usernameEdit" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
                    <label class="control-label" for="editar-usernameEdit" id="vazio-usernameEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>

                  </div>
                  <div class="form-group" id="emailEdit">
                    <label for="editar-emailEdit" class="control-label">Email:</label>
                    <input name="emailEdit" type="email" class="form-control" id="editar-emailEdit" required>

                    <label class="control-label" for="editar-emailEdit" id="erro_emailEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Não disponível</label>
                    <label class="control-label" for="editar-emailEdit" id="sucesso_emailEdit" style="display:none;"><i class="fa fa-check"></i> Disponível</label>
                    <label class="control-label" for="editar-emailEdit" id="vazio-emailEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
                    <label class="control-label" for="editar-emailEdit" id="incompleto-emailEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Formato errado</label>

                  </div>
                  <div class="form-group" id="telemovelEdit">
                    <label for="editar-telemovelEdit" class="control-label">Telemóvel:</label>
                    <input name="telemovelEdit" type="number" class="form-control" id="editar-telemovelEdit" required>

                    <label class="control-label" for="editar-telemovelEdit" id="vazio-telemovelEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>

                  </div>

                  <label class="control-label">Password:</label>
                  <div class="form-group input-group" id="passwordEdit">
                    <input name="passwordEdit" type="password" class="form-control" id="editar-passwordEdit" required>
                    <label class="control-label"  id="vazio-passEdit" style="display:none;"><i class="fa fa-times-circle-o"></i> Campo vazio</label>
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-default" aria-label="Help" id="ver"><span class="glyphicon glyphicon-eye-open" id="icone"></span></button>
                    </div> 
                  </div>


                  <button type="button" name="edit_user" class="btn btn-success ajax"  id="edit" >Registar</button>
                  <button type="submit" name="clear" class="btn btn-danger" data-dismiss="modal" id="clean">Cancelar</button>
                </form>
              </div>
            </div>
          </div>
        </div>



        <script>
          var recipientid
          var recipientnome
          var recipientemail
          var recipientusername
          var recipienttelemovel
          var recipientpassword

          $('#ModalEdit').on('show.bs.modal', function (event) {


            var button = $(event.relatedTarget) 
            recipientid = button.data('id')
            recipientnome = button.data('nome')
            recipientemail = button.data('email')
            recipientusername = button.data('username')
            recipienttelemovel = button.data('telemovel')
            recipientpassword = button.data('password')



            var modal = $(this)
            modal.find('#recipient-id').val(recipientid)
            modal.find('#editar-nomeEdit').val(recipientnome)
            modal.find('#editar-usernameEdit').val(recipientusername)
            modal.find('#editar-emailEdit').val(recipientemail)
            modal.find('#editar-telemovelEdit').val(recipienttelemovel)
            modal.find('#editar-passwordEdit').val(recipientpassword)



          });

          var open = 'glyphicon-eye-open';
          var close = 'glyphicon-eye-close';
          var ele = document.getElementById('editar-passwordEdit');



          document.getElementById('ver').onclick = function() {


            if($('#icone').hasClass('glyphicon glyphicon-eye-open')){

              $("#icone").attr("class", "glyphicon glyphicon-eye-close");
              ele.type="text";
            }else{

              $("#icone").attr("class", "glyphicon glyphicon-eye-open");
              ele.type="password";
            }

          }





        </script>

        
        <script src="Validar/validacao_editar_cuidador.js"></script>


      </body>
      </html>



