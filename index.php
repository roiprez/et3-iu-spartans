<?php
/*
entrada a la aplicacion
23/11/2017 por IU SPARTANS
*/
	//se va usar la session de la conexion
	session_start();
	$_SESSION['idioma'] = 'SPANISH';

	//funcion de autenticacion
	include './Functions/Authentication.php';

	//si no ha pasado por el login de forma correcta
	if (!IsAuthenticated()){
		header('Location:./Controllers/Login_Controller.php');
	}
	//si ha pasado por el login de forma correcta 
	else{
		header('Location:./Controllers/Index_Controller.php');
	}

	

	?>







