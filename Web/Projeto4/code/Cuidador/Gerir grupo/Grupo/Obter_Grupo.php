<HTML>
  <body>
    <?php 
    session_start();
    $id_cuidador= $_SESSION['login_user_id'];
    ?>

    <style>
      td {
        font-weight: normal;
      }
    </style>


    <?php

  include ("../../../../BD.php"); // ligação à BD

  $principalControlo_query = "SELECT isPrincipal from grupo WHERE ID_Monitorizado='$id' AND ID_Cuidador=".$id_cuidador;
    $result_principal = mysqli_query($sqli_connection,$principalControlo_query);
    $principal = mysqli_fetch_assoc($result_principal);
  
  $query_obterDados="SELECT ID_Cuidador, Username, Nome, Email, Telemovel from cuidador WHERE ID_Cuidador in (SELECT ID_Cuidador from grupo WHERE ID_Monitorizado='$id')";

  $dados = mysqli_query($sqli_connection,$query_obterDados);
  
  while($monitorizado = mysqli_fetch_array($dados)){

    $grupo_dados_query = "SELECT isPrincipal, Aviso_SMS_MAIL, Definir_Areas from grupo WHERE ID_Monitorizado='$id' AND ID_Cuidador=".$monitorizado['ID_Cuidador'];
    $result = mysqli_query($sqli_connection,$grupo_dados_query);
    $grupo = mysqli_fetch_assoc($result);

    ?>
    <tr>
      <td><?php echo $monitorizado['Nome']; ?></td>
      <td><?php echo $monitorizado['Email']; ?></td>
      <td><?php echo $monitorizado['Telemovel']; ?></td>
      <td><?php echo $grupo['isPrincipal']; ?></td>
      <?php
      if($monitorizado['ID_Cuidador']!=$id_cuidador && $principal['isPrincipal']=="Sim"){ ?>
      <td><select style="background: transparent; border:none;" onchange='areas(<?php echo $id ?>,<?php echo $monitorizado['ID_Cuidador']; ?>)' name="<?php echo $monitorizado['ID_Cuidador']; ?>" id="<?php echo $monitorizado['ID_Cuidador']; ?>"> 

        <?php
        if($grupo['Definir_Areas']=="Sim"){
         echo '<option selected="selected">'.$grupo['Definir_Areas'].'</option>';
         echo '<option value="Não">Não</option>';
       }else{
        echo '<option value="Sim">Sim</option>';
        echo '<option selected="selected">'.$grupo['Definir_Areas'].'</option>';
        
      }
      ?>
    </select>



    <span id="<?php echo $monitorizado['ID_Cuidador']."check"; ?>" class="glyphicon glyphicon-check"  style="position: relative; float: right; margin-top:0px; color:green; display:none;"></span>
    <span id="<?php echo $monitorizado['ID_Cuidador']."erro"; ?>" class="glyphicon glyphicon-ban-circle"  style="position: relative; float: right; margin-top:0px; color:red; display:none;"></span>

  </td>
  <?php }else{ ?>
  

  <td><?php echo $grupo['Definir_Areas']; ?></td>

  <?php } 

  if($monitorizado['ID_Cuidador']==$id_cuidador){ ?>
      <td><select style="background: transparent; border:none;" onchange='aviso(<?php echo $id ?>,<?php echo $monitorizado['ID_Cuidador']; ?>)' name="<?php echo $monitorizado['ID_Cuidador']; ?>" id="<?php echo $monitorizado['ID_Cuidador']; ?>"> 

        <?php
        if($grupo['Aviso_SMS_MAIL']=="Email"){
         echo '<option selected="selected">'.$grupo['Aviso_SMS_MAIL'].'</option>';
         echo '<option value="SMS">SMS</option>';
         echo '<option value="Ambos">Ambos</option>';
         echo '<option value="Não definido">Não definido</option>';

       }else if($grupo['Aviso_SMS_MAIL']=="SMS"){
        echo '<option value="Email">Email</option>';
        echo '<option selected="selected">'.$grupo['Aviso_SMS_MAIL'].'</option>';
        echo '<option value="Ambos">Ambos</option>';
        echo '<option value="Não definido">Não definido</option>';
        
      }
      else if($grupo['Aviso_SMS_MAIL']=="Ambos"){
        echo '<option value="Email">Email</option>';
        echo '<option value="SMS">SMS</option>';
        echo '<option selected="selected">'.$grupo['Aviso_SMS_MAIL'].'</option>';
        echo '<option value="Não definido">Não definido</option>';
        
      }
      else {
        echo '<option value="Email">Email</option>';
        echo '<option value="SMS">SMS</option>';
        echo '<option value="Ambos">Ambos</option>';
        echo '<option selected="selected">'.$grupo['Aviso_SMS_MAIL'].'</option>';
        
      }
      ?>
    </select>



    <span id="<?php echo $monitorizado['ID_Cuidador']."check"; ?>" class="glyphicon glyphicon-check"  style="position: relative; float: right; margin-top:0px; color:green; display:none;"></span>
    <span id="<?php echo $monitorizado['ID_Cuidador']."erro"; ?>" class="glyphicon glyphicon-ban-circle"  style="position: relative; float: right; margin-top:0px; color:red; display:none;"></span>

  </td>
  <?php }else{ ?>
  

  <td><?php echo $grupo['Aviso_SMS_MAIL']; ?></td>

  <?php } ?>
</td>
<td>


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
            
            function areas(monitorizado,user) {


              var selecionado = $('select[name="' + user + '"] option:selected').val();


              $.ajax({
                type: 'POST',
                url: "areas.php",
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

            function aviso(monitorizado,user) {


              var selecionado = $('select[name="' + user + '"] option:selected').val();


              $.ajax({
                type: 'POST',
                url: "aviso.php",
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
          

          

          

          


        </body>
        </html>



