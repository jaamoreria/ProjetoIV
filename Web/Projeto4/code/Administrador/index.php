<?php 
include("../../BD.php");
session_start();
if(!isset($_SESSION['login_user_tipo']))
{
  header("Location: ../../index.php");

}

if($_SESSION['login_user_tipo']=='Administrador'){



  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include("source_link.php"); ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini wysihtml5-supported"> 
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
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              
              <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="vazio.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrador</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="vazio.jpg" class="img-circle" alt="User Image">
                
                <p>
                  <?php echo $_SESSION['login_user_tipo']; ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../../logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        
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
              <li><a href="Gestão cuidadores/index.php"><i class="fa fa-circle-o"></i> Gestão de cuidadores</a></li>
              <li><a href="Gestão monitorizados/index.php"><i class="fa fa-circle-o"></i> Gestão de monitorizados</a></li>
              <li><a href="Gestão de grupos/index.php"><i class="fa fa-circle-o"></i> Gestão dos grupos</a></li>
            </ul>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
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
<!-- ./wrapper -->

<?php include("source_script.php"); ?>
</body>
</html>
<?php
}else{

  switch ($_SESSION['login_user_tipo']){


    case 'Administrador': header("location: ../Administrador/index.php"); break;

    default:
    session_destroy();

  }
}
?>