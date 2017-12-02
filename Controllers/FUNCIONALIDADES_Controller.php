<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
01/12/2017
*/

include '../Models/FUNCIONALIDADES_Model.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_SHOWALL.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_SEARCH.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_ADD.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_EDIT.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_DELETE.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';


function get_data_form(){
	$IdFuncionalidad = $_REQUEST['IdFuncionalidad'];
	$NombreFuncionalidad = $_REQUEST['NombreFuncionalidad'];
	$DescripFuncionalidad = $_REQUEST['DescripFuncionalidad'];
	$action = $_REQUEST['action'];

	$FUNCIONALIDADES = new FUNCIONALIDADES_Model(
		$IdFuncionalidad,
		$NombreFuncionalidad,
		$DescripFuncionalidad
		);

	return $FUNCIONALIDADES;
}

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Funcionalidad_ADD();
			}
			else{		
				$FUNCIONALIDADES = get_data_form();
				$respuesta = $FUNCIONALIDADES->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
        $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
        $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
				$valores = $FUNCIONALIDADES->RellenaDatos();
				new Funcionalidad_DELETE($lista, $valores);
			}
			else{
				$FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
				$respuesta = $FUNCIONALIDADES->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
        $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
				$valores = $FUNCIONALIDADES->RellenaDatos();
				new Funcionalidad_EDIT($valores);
			}
			else{	
				$FUNCIONALIDADES = get_data_form();						
				$respuesta = $FUNCIONALIDADES->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new Funcionalidad_SEARCH();
			}
			else{
				$FUNCIONALIDADES = get_data_form();
				$datos = $FUNCIONALIDADES->SEARCH();
				$lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
				new Funcionalidad_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
      $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
      $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
			$valores = $FUNCIONALIDADES->RellenaDatos();
			new Funcionalidad_SHOWCURRENT($lista, $valores);
			break;
		default:
			if (!$_POST){
				$FUNCIONALIDADES = new FUNCIONALIDADES_Model('','','');
			}
			else{
				$FUNCIONALIDADES = get_data_form();
			}
			$datos = $FUNCIONALIDADES->SEARCH();
			$lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
			new Funcionalidad_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>