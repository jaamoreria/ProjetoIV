<HTML>
  <body>




    <?php
    
  include ("../../../../BD.php"); // ligação à BD
  


  $query_obterDados = "SELECT ID_Cuidador, Nome, Username, Telemovel, Email, Data_Admissao, Imagem, Password from cuidador WHERE ID_Cuidador not in (SELECT ID_Cuidador from grupo WHERE ID_Monitorizado='$id')";
  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($cuidador = mysqli_fetch_array($dados)){

    ?>
    <tr>
      <td><input class="user" type="checkbox" name="checked[]" value="<?php echo $cuidador['ID_Cuidador']?>"/></td>
      <td><?php echo $cuidador['ID_Cuidador']; ?></td>
      <td><?php echo $cuidador['Email']; ?></td>
      <td><?php echo $cuidador['Telemovel']; ?></td>
    </td>
    <td>
      
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








        </body>
        </html>



