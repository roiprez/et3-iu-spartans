<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
25/11/2017
*/

include '../Models/GRUPOS_Model.php';
include '../Views/Grupo_VIEWS/Grupo_SHOWALL.php';
include '../Views/Grupo_VIEWS/Grupo_SEARCH.php';
include '../Views/Grupo_VIEWS/Grupo_ADD.php';
include '../Views/Grupo_VIEWS/Grupo_EDIT.php';
include '../Views/Grupo_VIEWS/Grupo_DELETE.php';
include '../Views/Grupo_VIEWS/Grupo_SHOWCURRENT.php';
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
				new Grupo_ADD();
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
				new Grupo_DELETE($lista, $valores);
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
				$valores = $GRUPOS->RellenaDatos();
				new Grupo_EDIT($valores);
			}
			else{	
				$GRUPOS = get_data_form();						
				$respuesta = $GRUPOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new Grupo_SEARCH();
			}
			else{
				$GRUPOS = get_data_form();
				$datos = $GRUPOS->SEARCH();
				$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				new Grupo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
      $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
      $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
			$valores = $GRUPOS->RellenaDatos();
			new Grupo_SHOWCURRENT($lista, $valores);
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
			new Grupo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>