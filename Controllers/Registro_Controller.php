<?php

/*
Controlador que se encarga del registro de un nuevo usuario ajeno a la aplicación .
25/11/2017 por IU SPARTANS
*/

session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//Si el login no se ha enviado incluimos la vista de registro
if(!isset($_POST['login'])){
	include '../Views/REGISTER_View.php';
	$register = new Register();
}

else{
	include '../Models/USUARIOS_Model.php';
	//Registramos un nuevo usuario con todos los datos recibidos del formulario
	$usuario = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
	$respuesta = $usuario->Register();

	//Si la respuesta al registro es correcta registramos el usuario en la base de datos, si no se envía el mensaje de error al navegador
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

