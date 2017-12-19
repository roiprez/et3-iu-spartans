<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
25/11/2017
*/



include '../Views/Trabajo_VIEWS/Trabajo_SHOWALL.php';
include '../Views/Trabajo_VIEWS/Trabajo_SEARCH.php';
include '../Views/Trabajo_VIEWS/Trabajo_ADD.php';
include '../Views/Trabajo_VIEWS/Trabajo_EDIT.php';
include '../Views/Trabajo_VIEWS/Trabajo_DELETE.php';
include '../Views/Trabajo_VIEWS/Trabajo_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';




function get_data_form(){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	$FechaIniTrabajo = $_REQUEST['FechaIniTrabajo'];
	$FechaFinTrabajo = $_REQUEST['FechaFinTrabajo'];
	$PorcentajeNota = $_REQUEST['PorcentajeNota'];
	$action = $_REQUEST['action'];

	$TRABAJO = new TRABAJOS_Model(
		$IdTrabajo,
		$NombreTrabajo,
		$FechaIniTrabajo,
		$FechaFinTrabajo,
		$PorcentajeNota
		);

	return $TRABAJO;
}

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Trabajo_ADD();
			}
			else{		
				$TRABAJO = get_data_form();
				$respuesta = $TRABAJO->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
        $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
        $lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
				$valores = $TRABAJO->RellenaDatos();
				new Trabajo_DELETE($lista, $valores);
			}
			else{
				$TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
				$respuesta = $TRABAJO->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
        $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
				$valores = $TRABAJO->RellenaDatos();
				new Trabajo_EDIT($valores);
			}
			else{	
				$TRABAJO = get_data_form();						
				$respuesta = $TRABAJO->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new Trabajo_SEARCH();
			}
			else{
				$TRABAJO = get_data_form();
				$datos = $TRABAJO->SEARCH();
				$lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
				new Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
      $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
      $lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
			$valores = $TRABAJO->RellenaDatos();
			new Trabajo_SHOWCURRENT($lista, $valores);
			break;
		case 'GENERAR_ASIG':
			$respuesta = qa_gen($_REQUEST['IdTrabajo']);
			new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			break;
		default:
			if (!$_POST){
				$TRABAJO = new TRABAJOS_Model('','','','','');
			}
			else{
				$TRABAJO = get_data_form();
			}
			$datos = $TRABAJO->SEARCH();
			$lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
			new Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>