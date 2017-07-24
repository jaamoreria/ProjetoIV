<HTML>
  <body>

    <style>
      td {
        font-weight: normal;
      }
    </style>


    <?php

  include ("../../../../BD.php"); // ligação à BD
  
  $query_obterDados="SELECT ID_Cuidador, Username, Nome, Email, Telemovel from cuidador WHERE ID_Cuidador in (SELECT ID_Cuidador from grupo WHERE ID_Monitorizado='$id')";

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($monitorizado = mysqli_fetch_array($dados)){

    $grupo_dados_query = "SELECT isPrincipal, Aviso_SMS_MAIL from grupo WHERE ID_Monitorizado='$id' AND ID_Cuidador=".$monitorizado['ID_Cuidador'];
    $result = mysqli_query($sqli_connection,$grupo_dados_query);
    $grupo = mysqli_fetch_assoc($result);

    ?>
    <tr>
      <td><?php echo $monitorizado['Nome']; ?></td>
      <td><?php echo $monitorizado['Email']; ?></td>
      <td><?php echo $monitorizado['Telemovel']; ?></td>

      <td><select style="background: transparent; border:none;" onchange='myFunction(<?php echo $id ?>,<?php echo $monitorizado['ID_Cuidador']; ?>)' name="<?php echo $monitorizado['ID_Cuidador']; ?>" id="<?php echo $monitorizado['ID_Cuidador']; ?>"> 

        <?php
        if($grupo['isPrincipal']=="Sim"){
         echo '<option selected="selected">'.$grupo['isPrincipal'].'</option>';
         echo '<option value="Não">Não</option>';
       }else{
        echo '<option value="Sim">Sim</option>';
        echo '<option selected="selected">'.$grupo['isPrincipal'].'</option>';
        
      }
      ?>
    </select>



    <span id="<?php echo $monitorizado['ID_Cuidador']."check"; ?>" class="glyphicon glyphicon-check"  style="position: relative; float: right; margin-top:0px; color:green; display:none;"></span>
    <span id="<?php echo $monitorizado['ID_Cuidador']."erro"; ?>" class="glyphicon glyphicon-ban-circle"  style="position: relative; float: right; margin-top:0px; color:red; display:none;"></span>

  </td>
  <td><?php echo $grupo['Aviso_SMS_MAIL'] ?></td>
</td>
<td>

  <span class="btn glyphicon glyphicon-trash"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalApagar" data-id="<?php echo $monitorizado['ID_Cuidador']; ?>"></span>

  <span class="btn glyphicon glyphicon-eye-open"  style="position: relative; float: right; margin-right: -5px" data-toggle="modal" data-target="#ModalDetalhes2" data-id="<?php echo $monitorizado['ID_Cuidador']; ?>" data-nome="<?php echo $monitorizado['Nome']; ?>" data-username="<?php echo $monitorizado['Username']; ?>" data-telemovel="<?php echo $monitorizado['Telemovel']; ?>" data-email="<?php echo $monitorizado['Email']; ?>" ></span>
</td>                   
</tr>

<?php
}
?>




<div class="container">
  <div class="modal fade" id="ModalDetalhes2" tabindex="-1" role="dialog" aria-labelledby="ModalDetalhes2Label">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="ModalDetalhes2Label">Detalhes</h4>
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


          
          <script src="../../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
          <script src="../../../../bootstrap/js/bootstrap.min.js"></script>
          <script>

            $('#ModalDetalhes2').on('show.bs.modal', function (event) {

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

          <script>

            function myFunction(monitorizado,user) {


              var selecionado = $('select[name="' + user + '"] option:selected').val();


              $.ajax({
                type: 'POST',
                url: "isPrincipal.php",
                data:{id:user,estado:selecionado, id_monitorizado:monitorizado},
                success:function(data){
                  

                 if($.trim(data)=="Erro"){
                  $("#"+user+"check").hide();
                  $("#"+user+"erro").show(); 
                  $("#"+user+"erro").fadeIn().delay(1000).fadeOut();
                  $("#"+user).val("Não");

                }else{
                  $("#"+user+"erro").hide(); 
                  $("#"+user+"check").show(); 
                  $("#"+user+"check").fadeIn().delay(1000).fadeOut();


                }
              }

            });

            }

          </script>

          <div class="modal fade" id="ModalApagar" tabindex="-1" role="dialog" aria-labelledby="ModalApagarLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="ModalApagarLabel">Detalhes</h4>
                </div>

                <div class="modal-body">
                  <form id="delete" name="delete" method="POST" enctype="multipart/form-data" autocomplete="off">

                    <div class="form-group" style="display:none;">
                     <label for="recipient-id" class="control-label">ID:</label>
                     <output name="id" type="text" class="form-control" id="recipient-id">
                     </div>

                     <div class="form-group">
                      <p>Têm a certeza que deseja remover este membro do grupo?</p>
                    </div>
                    <button type="button" class="btn btn-success" name="confirmar" id ="confirmar" style="margin-right: 1%">Confirmar</button>
                    <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          

          <script>
            var recipientid;
            var id_monitorizado= '<?php echo $id; ?>';
            $('#ModalApagar').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget) 
              recipientid = button.data('id')
              


              var modal = $(this)
              modal.find('#recipient-id').val(recipientid)
              

            });

            $("#confirmar").click(function(e) {
             $.ajax({
              type: 'POST',
              url: "removerMembro.php",
              data:{id:recipientid, monitorizado:id_monitorizado},
              success:function(data){
               window.location="Listar_Grupo.php";

             }
           });
           });

         </script>


       </body>
       </html>



