<?php





setlocale(LC_ALL, 'pt_pt','portuguese');
date_default_timezone_set('Europe/Lisbon');
$dataTraduzida=strftime('%d de %B de %Y', strtotime($alertas['data']));



$data=utf8_encode($dataTraduzida);



?>