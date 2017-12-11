<?php

/*
Controlador que se encarga de hacer login en la aplicación
25/11/2017 por 
*/
include '../Functions/comprobarAdmin.php';

session_start();
$_SESSION['login'] = null;
if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/LOGIN_View.php';
	$login = new Vista_LOGIN();
}
else{
	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','');
	$respuesta = $usuario->login();

	if ($respuesta == 'true' && !isAdmin()){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['controlador'] = 'ENTREGAS_Controller';
		header('Location:../index.php');
	}
	else if ($respuesta == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['controlador'] = 'USUARIOS_Controller';
		header('Location:../index.php');
	}else{
		include '../Views/MESSAGE_View.php';
		new Vista_MESSAGE($respuesta, './Login_Controller.php');
	}
}
?>