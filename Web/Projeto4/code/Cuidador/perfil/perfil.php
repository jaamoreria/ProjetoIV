<?php
session_start();


include("../../../BD.php");

if(!isset($_SESSION['login_user_tipo']))
{
  header("Location: ../../../index.php");

}

if($_SESSION['login_user_tipo']=='Cuidador'){

  $id=$_SESSION['login_user_id'];

  ?>




  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Perfil</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <?php include("../Gestão grupo/source_link.php") ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
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
                    <a href="perfil.php" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="../../logout.php" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Gestão de informações</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Gestão grupo/index.php"><i class="fa fa-circle-o"></i>Gestão do grupo</a></li>
                <li><a href="../Gestão_alertas.php"><i class="fa fa-circle-o"></i>Gestão alertas</a></li>

              </ul>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">


        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box-body no-padding">
                <table class="table table-condensed">
                  <tr>

                    <th>

                      <?php

                      include("BD_Dados.php");

                      ?>
                      <div class="box box-primary">
                        <div class="box-body box-profile">
                         <?php echo '<img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64,' . base64_encode( $rows1['Imagem'] ) . '" />'; ?>


                         <h3 class="profile-username text-center"><?php echo  $rows1['Nome']; ?></h3>

                         <p class="text-muted text-center"><?php echo $_SESSION['login_user_tipo']; ?></p>

                         <ul class="list-group list-group-unbordered">
                          <li class="list-group-item">
                            <b>Username</b> <a class="pull-right"><?php echo $rows1['Username']; ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>Email</b> <a class="pull-right"><?php echo $_SESSION['login_user_mail']; ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>Número de telemóvel</b> <a class="pull-right"><?php echo $rows1['Telemovel']; ?></a>
                          </li>

                        </ul>

                        <div>
                          <span class="btn btn-primary" data-toggle="modal" data-target="#ModalEditPerfil" data-id="<?php echo $id ?>" data-nome="<?php echo $rows1['Nome']; ?> " data-username="<?php echo $rows1['Username'];?> " data-email="<?php echo $rows1['Email'] ?> " data-pass="<?php echo $rows1['Password']; ?>" " data-tele="<?php echo $rows1['Telemovel']; ?>">Editar Dados</span>



                          <div class="modal fade" id="ModalEditPerfil" tabindex="-1" role="dialog" aria-labelledby="ModalPerfilLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="ModalPerfilLabel">Detalhes</h4>
                                </div>

                                <div class="modal-body">
                                  <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label for="recipient-nome" class="control-label">Nome:</label>
                                      <input name="nome" type="text" class="form-control" id="recipient-nome" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-username" class="control-label">Username:</label>
                                      <input name="username" type="text" class="form-control" id="recipient-username" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-email" class="control-label">Email:</label>
                                      <input name="email" type="email" class="form-control" id="recipient-email" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-password" class="control-label">Password:</label>
                                      <input name="password" type="text" class="form-control" id="recipient-password" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-telemovel" class="control-label">Telemóvel:</label>
                                      <input name="telemovel" type="text" class="form-control" id="recipient-telemovel" required>
                                    </div>

                                    <table>
                                      <tr>
                                        <th>
                                          <div class="form-group">
                                            <label for="exampleInputFile">Foto de perfil</label>
                                            <input type="file" id="exampleInputFile" accept="image/*" onchange="loadFile(event)" name="file">

                                          </th>
                                          <th>
                                            <img class="profile-user-img img-responsive img-circle pull-right no-border" id="output" type="hidden"/>
                                          </th>

                                          <script>
                                            var loadFile = function(event) {

                                              var output = document.getElementById('output');
                                              output.src = URL.createObjectURL(event.target.files[0]);
                                              

                                            };
                                          </script>


                                        </div>

                                      </tr>
                                    </table>


                                    <input name="id" type="hidden" class="form-control" id="id_editar">
                                    <button type="submit" name="sub_perfil" class="btn btn-success">Alterar</button>
                                    <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          <?php
                          if(isset($_POST["sub_perfil"])){

                            $id=$_POST["id"];
                            $nomeEdit=$_POST["nome"];
                            $usernameEdit=$_POST["username"];
                            $mailEdit=$_POST["email"];
                            $passEdit=$_POST["password"];
                            $telemovelEdit=$_POST["telemovel"];

                            if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
                              include ("editar_perfil.php");
                              echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil.php'>";
                            }else{
                              include ("editar_perfil.php");
                              include("BD_imagens.php");
                              echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil.php'>";
                            }



                           
                          }
                          ?>

                          <script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
                          <script src="../../../bootstrap/js/bootstrap.min.js"></script>

                          <script>

                            

                            $('#ModalEditPerfil').on('show.bs.modal', function (event) {


                              var button = $(event.relatedTarget) 
                              var id = button.data('id') 
                              var recipient = button.data('ModalPerfilLabel') 
                              var recipientnome = button.data('nome')
                              var recipientmail = button.data('email')
                              var recipientusername = button.data('username')
                              var recipientpass = button.data('pass')
                              var recipienttele = button.data('tele')

                              var modal = $(this)
                              modal.find('.modal-title').text(recipient)
                              modal.find('#id-curso').val(recipient)
                              modal.find('#recipient-nome').val(recipientnome)
                              modal.find('#recipient-username').val(recipientusername)
                              modal.find('#recipient-email').val(recipientmail)
                              modal.find('#recipient-password').val(recipientpass)
                              modal.find('#recipient-telemovel').val(recipienttele)
                              modal.find('#id_editar').val(id) 
                            });



                          </script>


                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>

                  </th>
                  <th>





                  </th>
                </tr>


              </table>
            </div>

            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </section>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.6
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
<?php include("../Gestão grupo/source_script.php") ?>
</body>
</html>

<?php
}
?>
