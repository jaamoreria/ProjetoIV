<?php
session_start();
$id=$_SESSION['monitorizado'];

include("../../../../BD.php");

if(!isset($_SESSION['login_user_tipo']))
{
  header("Location: ../../../../index.php");

}

if($_SESSION['login_user_tipo']=='Cuidador'){

  $id_cuidador=$_SESSION['login_user_id'];

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Monitorizado</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include("source_link.php"); ?> 
    <!-- Bug com o boostrap, quando abre uma modal, adiciona um padding de 17 à direita, sendo que estas linhas resolvem isso -->
    <style type="text/css">
      body { padding-right: 0 !important }
    </style>

    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LZ</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Al</b>zheimer</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success" id="numero"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header" id="numero_alertas">Tem zero alertas</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu" id="alerta">
                      <li id="criar"><!-- start message -->


                      </li>
                      <!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="../../Gerir_alertas.php">Ver todos os alertas</a></li>
                </ul>
              </li>

              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php echo '<img class="user-image" alt="User Image" src="data:image/jpeg;base64,' . base64_encode( $_SESSION['login_user_imagem'] ) . '" />'; ?>
                  <span class="hidden-xs"><?php echo $_SESSION['login_user_nome']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php echo '<img class="img-circle" alt="User Image" src="data:image/jpeg;base64,' . base64_encode( $_SESSION['login_user_imagem'] ) . '" />'; ?>

                    <p>
                      <?php echo $_SESSION['login_user_tipo']; ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../../perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="../../../../logout.php" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Gestão de informações</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="../index.php"><i class="fa fa-circle-o"></i> Gerir de grupos</a></li>
                <li><a href="../../Gerir_alertas.php"><i class="fa fa-circle-o"></i>Gestão alertas</a></li>
              </ul>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 903px;">
        <!-- Main content -->
        <section class="content">
          <div class="box box-widget widget-user-2" style="margin-bottom: 0px;">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow" style="background-color: #00619B !important;">
              <div class="widget-user-image" id="imagem_monitorizado" >
              </div>
              

              <h3 class="widget-user-username" id="nome_monitorizado"></h3>
              <h5 class="widget-user-desc">Monitorizado</h5>
              <?php include("principal.php"); 
              if($principal=="Sim"){
                ?>
                <span type="submit" class="btn glyphicon glyphicon-cog"  style="position: relative; float: right; margin-right: -5px; margin-top: -47px;" data-toggle="modal" data-target="#ModalTempo" data-id="<?php echo $id; ?>"></span> 

                <div class="container">
                  <div class="modal fade" id="ModalTempo" tabindex="-1" role="dialog" aria-labelledby="ModalTempoLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="ModalTempoLabel" style="color: #333;">Editar frequência monitorização</h4>
                        </div>

                        <div class="modal-body">
                          <form method="POST" action="" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                              <label for="recipient-tempo" style="color: #333;" class="control-label">Frequência monitorização:</label>
                              <select name="tempo" type="tempo" class="form-control" id="recipient-tempo">
                                <option>2 minutos</option>
                                <option>4 minutos</option>
                                <option>6 minutos</option>
                                <option>8 minutos</option>
                                <option>10 minutos</option>
                              </select>
                            </div>
                            <button type="submit" name="sub_tempo" class="btn btn-success" onclick="editar()">Alterar</button>
                            <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                //include("dados_monitorizados.php");
                //include("editar_monitorizado.php");
                // <span class="btn fa fa-gears pull-right" style="margin-top: -41px;" data-toggle="modal" data-target="#ModalEditMonitorizado"></span>


                }
                ?>



              </div>
            </div>
            <div class="row">




              <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Cuidadores atribuidos</a></li>
                    <li><a href="#tab2" data-toggle="tab">Áreas seguras</a></li>
                    <li><a href="#tab3" data-toggle="tab">Localização</a></li>
                    <li><a href="#tab4" data-toggle="tab">Histórico de Alertas</a></li>

                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">



                      <div class="box-body">
                        <?php include("Tabela_Grupo.php"); ?>
                      </div>


                    </div>

                    <div id="tab3" class="tab-pane fade">

                      <?php include("mapa_localizacao.php"); ?>


                    </div>

                    <div id="tab2" class="tab-pane fade">

                      <?php include("mapa.php"); ?>


                    </div>

                    <div id="tab4" class="tab-pane fade">

                      <?php include("Tabela_Alertas.php"); ?>


                    </div>







                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </section>
          <!-- /.content -->


        </div>

        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
          </div>
          <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
          reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Recent Activity</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                      <p>Will be 23 on April 24th</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                      <p>New phone +1(800)555-1234</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                      <p>nora@example.com</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                      <p>Execution time 5 seconds</p>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->

              <h3 class="control-sidebar-heading">Tasks Progress</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Custom Template Design
                      <span class="label label-danger pull-right">70%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Update Resume
                      <span class="label label-success pull-right">95%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Laravel Integration
                      <span class="label label-warning pull-right">50%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Back End Framework
                      <span class="label label-primary pull-right">68%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
              <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Some information about this general settings option
                  </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Other sets of options are available
                  </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Allow the user to show his name in blog posts
                  </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                  </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                  </label>
                </div>
                <!-- /.form-group -->
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
        </aside>
        <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<?php include("source_script.php") ?>
<script>


  $('#example1').DataTable( {
    "language": {
      "lengthMenu": "Mostar _MENU_ cuidadores por página",
      "zeroRecords": "Nenhum resultado",
      "info": "Pagina de _PAGE_ de _PAGES_",
      "infoEmpty": "",
      "infoFiltered": "(Filtrado _MAX_ total de cuidadores)",
      "oPaginate": {
        "sFirst":    "Primeiro",
        "sLast":    "Último",
        "sNext":    "Seguinte",
        "sPrevious": "Anterior",
        "bDestroy": true,

      },

      "sLoadingRecords": "Carregar...",
      "sSearch":        "Procurar:"
    }

  } );

  $('#example4').DataTable( {
    "language": {
      "lengthMenu": "Mostar _MENU_ alertas por página",
      "zeroRecords": "Nenhum resultado",
      "info": "Pagina de _PAGE_ de _PAGES_",
      "infoEmpty": "",
      "infoFiltered": "(Filtrado _MAX_ total de alertas)",
      "oPaginate": {
        "sFirst":    "Primeiro",
        "sLast":    "Último",
        "sNext":    "Seguinte",
        "sPrevious": "Anterior",
        "bDestroy": true,

      },

      "sLoadingRecords": "Carregar...",
      "sSearch":        "Procurar:"
    }

  } );

  





</script>

<script src="../../../../plugins/pace/pace.min.js"></script>
<script type="text/javascript">
  var id_monitorizado = '<?php echo $id; ?>';

  $('#ModalTempo').on('show.bs.modal', function (event) {

    var modal = $(this);
    
    
    
    $.ajax({
      type: 'POST',
      url: "Tempo.php",
      data:{id: id_monitorizado},
      success:function(data){
        var dados = $.trim(data);
        
        modal.find('#recipient-tempo').val(dados);


      }
    })




  });

  function editar() {
    var selecionado = $('#recipient-tempo').val();

    $.ajax({
      type: 'POST',
      url: "BD_Editar_Tempo.php",
      data:{id: id_monitorizado, selecionado: selecionado},
      
      
    })

    
}



  
  $.ajax({
    type: 'POST',
    url: "monitorizado_dados(Imagem).php",
    data:{id_data: id_monitorizado},
    success:function(data){
     $('#imagem_monitorizado').html(data);
     
   }
 });

  $.ajax({
    type: 'POST',
    url: "monitorizado_dados(Nome).php",
    data:{id_data: id_monitorizado},
    success:function(data){
     $('#nome_monitorizado').html(data);
     
   }
 });

  var id_cuidador = '<?php echo $id_cuidador; ?>';
  setInterval(function() {
    //call $.ajax here

    $.ajax({
      type: 'POST',
    url: "../../Alertas/alertas_aviso.php", //Cuidador\Alertas
    data:{"id": id_cuidador},
    success:function(data){
      $("#criar").remove();
      $("#alerta").append("<li id='criar'></a>");

      var result=eval(data);
      $('#numero_alertas').text("Tem "+result.length+" alertas pendentes");
      $('#numero').text(result.length);

      for (var i = 0; i < result.length; i++) {



        $("#criar").append("<a id=a"+result[i].id+"></a>");
        $("#a"+result[i].id).append("<h4 id=h"+result[i].id+">Alerta</h4>");
        $("#h"+result[i].id).append("<small><i class='fa fa-clock-o'></i>"+result[i].data+"</small>");
        $("#a"+result[i].id).append("<p>"+result[i].nome+" saiu da área segura</p>");


      }
    }
  });

  }, 2000); //2 seconds


  $('.ajax').click(function(){
    if(resultado=="true"){
      Pace.restart();
    }
  });
  
</script>

<script>


</script>



</body>
</html>

<?php
}else{


}
?>
