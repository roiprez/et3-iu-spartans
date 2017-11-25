<?php

/*
Controlador que se encarga del registro de un nuevo usuario ajeno a la aplicación .
25/11/2017 por 
*/

session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//session_start();
if(!isset($_POST['login'])){
	include '../Views/REGISTER_View.php';
	$register = new Register();
}

else{
	include '../Models/USUARIOS_Model.php';
	
	$usuario = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
	$respuesta = $usuario->Register();

	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();
		Include '../Views/MESSAGE_View.php';
		new Vista_MESSAGE($respuesta, '../index.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new Vista_MESSAGE($respuesta, './Login_Controller.php');
	}
}

?>

