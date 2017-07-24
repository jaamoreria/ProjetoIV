<?php 
session_start();
if(isset($_SESSION['login_user_tipo']))
{
  switch ($_SESSION['login_user_tipo']){


    case 'Administrador': header("location: code/Administrador/index.php"); break;


    default:
    session_destroy();

  }

  

}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    
// username e password recebidos do form
  $username=$_POST['username'];
  $password=$_POST['password'];

include("BD.php");
  include("code/login/Verifica_administrador.php");

  $tipo_utilizador=existencia_admin($username, $password);

  

  if($tipo_utilizador=="false"){
     
    include ("code/login/Verifica_cuidador.php");
    

  }


  //Caso as credenciais sejam de um cuidador
if($verifica_credenciais=="true"){

  $_SESSION['login_user_id']=$id_cuidador;
  $_SESSION['login_user_nome']=$nome;
  $_SESSION['login_user_mail']=$mail;
  $_SESSION['login_user_imagem']=$imagem;
  $_SESSION['login_user_tipo']="Cuidador";


 header("location: code/Cuidador/index.php");

}else{

  //Caso as credenciais nПлкo sejam de um cuidador
  if($tipo_utilizador=="true"){

    $_SESSION['login_user_tipo']="Administrador";

    header("location: code/Administrador/index.php");

  }else{
    //mensagem de erro
  }
}
  
}




?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Projeto</b>4</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Efetue o login para iniciar a sessao</p>

      <form method="post" autocomplete="off">
        <div class="form-group has-feedback">
          <input name="username" type="text" class="form-control" placeholder="Username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <a href="#">Esqueci-me da password</a>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" id="sub-login" name="sub-login" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>
