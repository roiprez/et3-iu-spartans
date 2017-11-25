<?php

/*
Controlador que se encarga del registro de un nuevo usuario ajeno a la aplicación .
25/11/2017 por 
*/

session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//session_start();
if(!isset($_POST['login'])){
	include '../Views/Register_View.php';
	$register = new Register();
}

else{
	include '../Models/Entidad_Model.php';
	
	$usuario = new Entidad_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['nombre'], $_REQUEST['apellidos'], $_REQUEST['correo'], $_REQUEST['direccion'], $_REQUEST['telefono']);
	$respuesta = $usuario->Register();

	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();
		Include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, '../index.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
}

?>

