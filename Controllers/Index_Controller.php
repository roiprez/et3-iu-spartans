<?php

/*
Controlador que se encarga del acceso a la aplicación, envía a la entrada por defecto por index.php o a la vista principal de la página si está autenticado
25/11/2017 por 
*/

//session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php'; 
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}
//esta autenticado
else{
	include '../Views/users_index_View.php';
	new Index();
}
?>