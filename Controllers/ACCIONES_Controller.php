<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
25/11/2017
*/

include '../Models/ACCIONES_Model.php';
include '../Views/Accion_VIEWS/Accion_SHOWALL.php';
include '../Views/Accion_VIEWS/Accion_SEARCH.php';
include '../Views/Accion_VIEWS/Accion_ADD.php';
include '../Views/Accion_VIEWS/Accion_EDIT.php';
include '../Views/Accion_VIEWS/Accion_DELETE.php';
include '../Views/Accion_VIEWS/Accion_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';




function get_data_form(){
	$IdAccion = $_REQUEST['IdAccion'];
	$NombreAccion = $_REQUEST['NombreAccion'];
	$DescripAccion = $_REQUEST['DescripAccion'];
	$action = $_REQUEST['action'];

	$ACCIONES = new ACCIONES_Model(
		$IdAccion,
		$NombreAccion,
		$DescripAccion
		);

	return $ACCIONES;
}

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Accion_ADD();
			}
			else{		
				$ACCIONES = get_data_form();
				$respuesta = $ACCIONES->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
        $ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
        $lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
				$valores = $ACCIONES->RellenaDatos();
				new Accion_DELETE($lista, $valores);
			}
			else{
				$ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
				$respuesta = $ACCIONES->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
        $ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
				$valores = $ACCIONES->RellenaDatos();
				new Accion_EDIT($valores);
			}
			else{	
				$ACCIONES = get_data_form();						
				$respuesta = $ACCIONES->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new Accion_SEARCH();
			}
			else{
				$ACCIONES = get_data_form();
				$datos = $ACCIONES->SEARCH();
				$lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
				new Accion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
      $ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
      $lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
			$valores = $ACCIONES->RellenaDatos();
			new Accion_SHOWCURRENT($lista, $valores);
			break;
		default:
			if (!$_POST){
				$ACCIONES = new ACCIONES_Model('','','');
			}
			else{
				$ACCIONES = get_data_form();
			}
			$datos = $ACCIONES->SEARCH();
			$lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
			new Accion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>