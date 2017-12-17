<?php
/**
 * Autor 9jyjjr
 * Última fecha de modificación 6/11/2017
 * permite saber que idioma ha selecciona el usuario
 */

session_start();
$idioma = $_GET['idioma'];
$_SESSION['idioma'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>