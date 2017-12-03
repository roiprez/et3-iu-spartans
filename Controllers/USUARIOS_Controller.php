<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include '../Models/USUARIOS_Model.php';
include '../Views/Usuario_VIEWS/Usuario_SHOWALL.php';
include '../Views/Usuario_VIEWS/Usuario_SEARCH.php';
include '../Views/Usuario_VIEWS/Usuario_ADD.php';
include '../Views/Usuario_VIEWS/Usuario_EDIT.php';
include '../Views/Usuario_VIEWS/Usuario_DELETE.php';
include '../Views/Usuario_VIEWS/Usuario_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';
include '../Views/Usu_Grupo_VIEWS/Usu_Grupo_ADD.php';
include '../Models/GRUPOS_Model.php';




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
//Como la password en la vista delete no está, al volver atrás del delete muestra un error de que no se encuentra inicializada
if (!isset($_REQUEST['password'])){
	$_REQUEST['password'] = '';
}
if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Usuario_ADD();
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
				new Usuario_DELETE($lista, $valores);
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
				$valores = $USUARIOS->RellenaDatos();

				new Usuario_EDIT($valores);
			}
			else{	
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);							
				$respuesta = $USUARIOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){

				new Usuario_SEARCH();
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$datos = $USUARIOS->SEARCH();
				$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');				
				new Usuario_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');	
			$valores = $USUARIOS->RellenaDatos();
			$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');
			new Usuario_SHOWCURRENT($lista, $valores);
			break;
			
		case 'ADDGROUP':
			if(!$_POST){
				$USUARIOS = new USUARIOS_Model('','','', '','','', '', '');
				$GRUPOS =new GRUPOS_Model('','','');
				
				$datosUsu = $USUARIOS->SEARCH();
				
				$datosGru = $GRUPOS->SEARCH();
				$grupostotales = array();
				while($rowgrupos = $datosGru->fetch_array()){
				$grupostotales[]=$rowgrupos[0];
				}
						
				$USU_GRUP =new USU_GRUPO_Model('','');
				$datosUsuGrup = $USU_GRUP->SEARCH();
				
				new Usu_Grupo_ADD($datosUsu,$grupostotales,$datosUsuGrup);
			}
			else{
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
			$GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
			$USU_GRUPO= new USU_GRUPO_Model($_REQUEST['login'],$_REQUEST
				['IdGrupo']);
			$respuesta=$USU_GRUPO->ADD();
			new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');

			}
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
			new Usuario_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>