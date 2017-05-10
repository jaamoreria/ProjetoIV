<?php


$pass = "";
$pass2 = "";

//
$pass = trim($_GET['a']);
$pass2 = trim($_GET['aa']);
if ($pass!=$pass2) {
    echo json_encode(FALSE);
} else {
    echo json_encode(TRUE);
}

?>