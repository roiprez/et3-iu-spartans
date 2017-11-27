<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include '../Models/USUARIOS_Model.php';
include '../Views/SHOWALL_View.php';
include '../Views/SEARCH_View.php';
include '../Views/ADD_View.php';
include '../Views/EDIT_View.php';
include '../Views/DELETE_View.php';
include '../Views/SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';




function get_data_form(){
	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$DNI = $_REQUEST['DNI'];
	$Nombre = $_REQUEST['Nombre'];
	$Apellidos = $_REQUEST['Apellidos'];
	$Correo = $_REQUEST['Correo'];
	$Direccion = $_REQUEST['Direccion'];
	$Telefono = $_REQUEST['Telefono'];
	$action = $_REQUEST['action'];

	$USUARIOS = new USUARIOS_Model(
		$login,
		$password,
		$DNI,
		$Nombre,
		$Apellidos,
		$Correo,
		$Direccion,
		$Telefono
		);

	return $USUARIOS;
}

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				$lista = array('login', 'password', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
				$tamanhos = array(9, 20, 9, 30, 50, 40, 60, 11);
				new Vista_ADD($lista, $tamanhos);
			}
			else{
				
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$respuesta = $USUARIOS->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$lista = array('login', 'password', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
				$valores = $USUARIOS->RellenaDatos();
				new Vista_DELETE($lista, $valores);
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$respuesta = $USUARIOS->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$lista = array('login', 'password', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
				$tamanhos = array(9, 20, 9, 30, 50, 40, 60, 11);
				$valores = $USUARIOS->RellenaDatos();
				$clave=1;
				new Vista_EDIT($lista,$tamanhos,$valores,$clave);
			}
			else{	
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);							
				$respuesta = $USUARIOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				$lista = array('login', 'password', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');				
				$tamanhos = array(9, 20, 9, 30, 50, 40, 60, 11);
				new Vista_SEARCH($lista, $tamanhos);
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$datos = $USUARIOS->SEARCH();
				$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');				
				new Vista_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');	
			$valores = $USUARIOS->RellenaDatos();
			$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');
			new Vista_SHOWCURRENT($lista, $valores);
			break;
		default:
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model('','','', '','','', '', '');
			}
			else{
				$USUARIOS = get_data_form();
			}
			$datos = $USUARIOS->SEARCH();
			$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
			new Vista_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>