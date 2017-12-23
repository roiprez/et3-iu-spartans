<?php
/*
Destruye la sesión y vuelve a la entrada de la aplicación
25/11/2017 por IU SPARTANS
*/
session_start();
session_destroy();
header('Location:../index.php');
?>
