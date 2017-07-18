<HTML>
  <body>
    
    <?php

    include("../../../BD.php");




    
    $id=$_SESSION['login_user_id'];

    $query1 = "SELECT Username, Nome, Password, Email, Telemovel, Imagem from cuidador where ID_Cuidador='$id'";
    $results1 = mysqli_query($sqli_connection,$query1);

    $rows1=mysqli_fetch_array($results1);


    ?>


    









  </body>
  </html>




