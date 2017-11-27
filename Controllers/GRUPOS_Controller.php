<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
25/11/2017
*/

include '../Models/GRUPOS_Model.php';
include '../Views/SHOWALL_View.php';
include '../Views/SEARCH_View.php';
include '../Views/ADD_View.php';
include '../Views/EDIT_View.php';
include '../Views/DELETE_View.php';
include '../Views/SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';




function get_data_form(){
	$IdGrupo = $_REQUEST['IdGrupo'];
	$NombreGrupo = $_REQUEST['NombreGrupo'];
	$DescripGrupo = $_REQUEST['DescripGrupo'];
	$action = $_REQUEST['action'];

	$GRUPOS = new GRUPOS_Model(
		$IdGrupo,
		$NombreGrupo,
		$DescripGrupo
		);

	return $GRUPOS;
}

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
        $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
        $tamanhos = array(30, 30, 300);
				new Vista_ADD($lista, $tamanhos);
			}
			else{		
				$GRUPOS = get_data_form();
				$respuesta = $GRUPOS->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
        $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
        $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				$valores = $GRUPOS->RellenaDatos();
				new Vista_DELETE($lista, $valores);
			}
			else{
				$GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
				$respuesta = $GRUPOS->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
        $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
        $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
        $tamanhos = array(30, 30, 300);
				$valores = $GRUPOS->RellenaDatos();
				$clave=1;
				new Vista_EDIT($lista,$tamanhos,$valores,$clave);
			}
			else{	
				$GRUPOS = get_data_form();						
				$respuesta = $GRUPOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
        $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
        $tamanhos = array(30, 30, 300);
				new Vista_SEARCH($lista, $tamanhos);
			}
			else{
				$GRUPOS = get_data_form();
				$datos = $GRUPOS->SEARCH();
				$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				new Vista_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
      $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
      $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
			$valores = $GRUPOS->RellenaDatos();
			new Vista_SHOWCURRENT($lista, $valores);
			break;
		default:
			if (!$_POST){
				$GRUPOS = new GRUPOS_Model('','','');
			}
			else{
				$GRUPOS = get_data_form();
			}
			$datos = $GRUPOS->SEARCH();
			$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
			new Vista_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>