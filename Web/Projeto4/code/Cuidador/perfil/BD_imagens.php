<?php


include ("../../../BD.php");

$id=$_POST["id"];




$msg = '';

    $image = $_FILES['file']['tmp_name'];
    
    $img = file_get_contents($image);
    
    $sql = "UPDATE cuidador SET Imagem=? WHERE ID_Cuidador=?";

    $stmt = mysqli_prepare($sqli_connection,$sql);

    mysqli_stmt_bind_param($stmt, "ss",$img, $id);
    mysqli_stmt_execute($stmt);

    $check = mysqli_stmt_affected_rows($stmt);
    
    mysqli_close($sqli_connection);

    $_SESSION['login_user_imagem']=$img;

    






?>