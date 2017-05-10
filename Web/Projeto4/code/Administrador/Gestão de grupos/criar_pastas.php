<?php






$img = file_get_contents("vazio.jpg");
$dest = substr("vazio.jpg", strrpos("vazio.jpg", '/') + 1);
copy("vazio.jpg", "Pastas/");







//não guardar imagens na bd e criar pastas e copiar imagem vazio.png

?>



