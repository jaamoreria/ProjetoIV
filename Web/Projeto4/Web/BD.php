<?php


date_default_timezone_set("Europe/London");

$sqli_connection = mysqli_connect("localhost","root","","bd_projeto") or die ("Error " . mysqli_error($link)); 

mysqli_set_charset($sqli_connection,"utf8");




/*$query = "SELECT Ano from ano where ID_Ano=?";
$ID_Ano=2;

if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("s", $ID_Ano);
    $result = $stmt -> execute();

    if (false === $result) {
        $response["errors"] = true;
        $response["type"] = "query";
        $response["line"] = "FTGA002";
        $response["message"] = $stmt -> error;
        die(json_encode($response));
    }

    $stmt -> bind_result($ano);
    $stmt -> fetch();

    echo $ano;

    $stmt -> close();

} else {

    $response["errors"] = true;
    $response["line"] = "FTGA003";
    $response["message"] = $sqli_connection -> error;
    die(json_encode($response));

}
$ano=2019;
$query = "INSERT INTO ano (Ano) VALUES (?)";

if ($stmt = $sqli_connection -> prepare($query)) {
    $stmt -> bind_param("s", $ano);
    $stmt -> execute();
    $stmt -> close();
    $response["errors"] = false;
    die(json_encode($response));

} else {// QUERY IS INCORRECT
    $response["errors"] = true;
    $response["type"] = "FTGP004";
    die(json_encode($response));

}
*/
?>


