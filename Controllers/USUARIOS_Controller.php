<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include '../Models/USUARIOS_Model.php';
include '../Views/USUARIOS_SHOWALL_View.php';
include '../Views/USUARIOS_SEARCH_View.php';
include '../Views/USUARIOS_ADD_View.php';
include '../Views/USUARIOS_EDIT_View.php';
include '../Views/USUARIOS_DELETE_View.php';
include '../Views/USUARIOS_SHOWCURRENT_View.php';
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
				new USUARIOS_ADD();
			}
			else{
				
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$respuesta = $USUARIOS->ADD();
				new MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$valores = $USUARIOS->RellenaDatos();
				new USUARIOS_DELETE($valores);
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$respuesta = $USUARIOS->DELETE();
				new MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$valores = $USUARIOS->RellenaDatos();
				new USUARIOS_EDIT($valores);
			}
			else{	
				
				
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);				
						
				$respuesta = $USUARIOS->EDIT();
				new MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new USUARIOS_SEARCH();
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$datos = $USUARIOS->SEARCH();
				$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');
				new USUARIOS_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
			$valores = $USUARIOS->RellenaDatos();
			new USUARIOS_SHOWCURRENT($valores);
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
			new USUARIOS_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>