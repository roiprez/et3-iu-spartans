<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
01/12/2017
*/

include '../Models/FUNCIONALIDADES_Model.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_SHOWALL.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_SEARCH.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_ADD.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_EDIT.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_DELETE.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_SHOWCURRENT.php';
include '../Views/FUNCIONALIDADES_VIEWS/Funcionalidades_MESSAGE.php';


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
        $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
        $tamanhos = array(6, 60, 100);
				new Funcionalidad_ADD($lista, $tamanhos);
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
        $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
        $tamanhos = array(6, 60, 100);
				$valores = $FUNCIONALIDADES->RellenaDatos();
				$clave=1;
				new Funcionalidad_EDIT($lista,$tamanhos,$valores,$clave);
			}
			else{	
				$FUNCIONALIDADES = get_data_form();						
				$respuesta = $FUNCIONALIDADES->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
        $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
        $tamanhos = array(6, 60, 100);
				new Funcionalidad_SEARCH($lista, $tamanhos);
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