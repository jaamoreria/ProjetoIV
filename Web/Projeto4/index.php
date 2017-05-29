<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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



<?php 

include("BD.php");
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
  $username=mysqli_real_escape_string($sqli_connection,$_POST['username']);
  $password=mysqli_real_escape_string($sqli_connection,$_POST['password']);


  include("code/Login/Verifica_administrador.php");

  $tipo_utilizador=existencia_admin($username, $password);

  

  if($tipo_utilizador=="false"){

    include ("code/Login/Verifica_cuidador.php");
    

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

  //Caso as credenciais não sejam de um cuidador
  if($tipo_utilizador=="true"){

    $_SESSION['login_user_tipo']="Administrador";

    header("location: code/Administrador/index.php");

  }else{
    //mensagem de erro
  }
}
  
}







//caso o count seja igual a 1, há um cuidador com essas credenciais
/*if($count==1)
{


  $_SESSION['login_id']=$row["ID_Utilizador"];





  switch ($_SESSION['login_user_tipo']){

    case 'Recursos humanos': $_SESSION['ano']=$ano['ID_Ano']; header("location: RH/dashboard.php"); break;

    case 'Administrador': $_SESSION['ano']=$ano['ID_Ano']; header("location: admin/dashboard.php"); break;

    case 'Gestor': $_SESSION['ano']=$ano['ID_Ano']; header("location: gestor/dashboard.php"); break;

    case 'Colaborador': $_SESSION['ano']=$ano['ID_Ano']; header("location: colaborador/dashboard.php"); break;

    default:
    session_destroy();

  }
  
}




}
else
{
  $error="Username or Password is invalid";
}*/

?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Projeto</b>4</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Efetue o login para iniciar a sessão</p>

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
