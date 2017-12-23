<?php

/*
Controlador que se encarga de hacer login en la aplicación
25/11/2017 por IU SPARTANS
*/
include '../Functions/comprobarAdmin.php';

session_start();

//Si el login no está indicado y tampoco la password incluímos la vista de login, si no procedemos a la operación de login
if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/LOGIN_View.php';
	$login = new Vista_LOGIN();
}

else{
	//Creamos una instancia del usuario con login y password y nos logueamos
	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','');
	$respuesta = $usuario->login();
	//Si el login fue satisfactorio 
	if ($respuesta == 'true')
	{
		session_start();

		$_SESSION['login'] = $_REQUEST['login'];

		//Establecemos el login de la sesión
		$_SESSION['login'] = strtolower($_REQUEST['login']);
		//Si el que se loguea es administrador lo mandamos al controlador de usuarios por defecto, si no al de entregas

		if(isAdmin())
		{
		$_SESSION['controlador'] = 'USUARIOS_Controller';
		header('Location:../index.php');
		}else{
				$_SESSION['controlador'] = 'ENTREGAS_Controller';
				header('Location:../index.php');
			}
	}else{
	//Si el logue no fue satisfactorio se muestra el mensaje
	include '../Views/MESSAGE_View.php';
	new Vista_MESSAGE($respuesta, './Login_Controller.php');
	}
}
?>