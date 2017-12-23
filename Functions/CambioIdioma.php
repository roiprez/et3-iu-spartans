<?php
/**
*permite saber que idioma ha selecciona el usuario
*25/11/2017 por IU SPARTANS
*/

session_start();
$idioma = $_GET['idioma'];
$_SESSION['idioma'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>