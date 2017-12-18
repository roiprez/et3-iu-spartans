<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include_once '../Models/EVALUACIONES_Model.php';
include_once '../Functions/Generacion_QAs.php';
include '../Views/Evaluacion_VIEWS/Evaluacion_SHOWALL.php';
include '../Views/Evaluacion_VIEWS/Evaluacion_SEARCH.php';
include '../Views/Evaluacion_VIEWS/Evaluacion_ADD.php';
include '../Views/Evaluacion_VIEWS/Evaluacion_EDIT.php';
include '../Views/Evaluacion_VIEWS/Evaluacion_DELETE.php';
include '../Views/Evaluacion_VIEWS/Evaluacion_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';




function get_data_form(){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	$LoginEvaluador = $_REQUEST['LoginEvaluador'];
	$AliasEvaluado = $_REQUEST['AliasEvaluado'];
	$IdHistoria = $_REQUEST['IdHistoria'];
	$CorrectoA = $_REQUEST['CorrectoA'];
	$ComenIncorrectoA = $_REQUEST['ComenIncorrectoA'];
	$CorrectoP = $_REQUEST['CorrectoP'];
	$ComentIncorrectoP = $_REQUEST['ComentIncorrectoP'];
	$OK = $_REQUEST['OK'];
	$accion = $_REQUEST['accion'];
	$EVALUACION = new EVALUACION_Model(
		$IdTrabajo,
		$LoginEvaluador,
		$AliasEvaluado,
		$IdHistoria,
		$CorrectoA,
		$ComenIncorrectoA,
		$CorrectoP,
		$ComentIncorrectoP,
		$OK
		);

	return $EVALUACION;
}
//Como la password en la vista delete no está, al volver atrás del delete muestra un error de que no se encuentra inicializada

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}


	
	Switch ($_REQUEST['action']){

		case 'ADD':
			if (!$_POST){
				new Evaluacion_ADD();
			}
			else{
				
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], $_REQUEST['CorrectoA'], $_REQUEST['ComenIncorrectoA'], $_REQUEST['CorrectoP'], $_REQUEST['ComentIncorrectoP'], $_REQUEST['OK']);
				$respuesta = $EVALUACION->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
				$valores = $EVALUACION->RellenaDatos();
				new Evaluacion_DELETE($lista, $valores);
			}
			else{
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
				$respuesta = $EVALUACION->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
				$valores = $EVALUACION->RellenaDatos();
				new Evaluacion_EDIT($valores);
			}
			else{	
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], $_REQUEST['CorrectoA'], $_REQUEST['ComenIncorrectoA'], $_REQUEST['CorrectoP'], $_REQUEST['ComentIncorrectoP'], $_REQUEST['OK']);							
				$respuesta = $EVALUACION->EDIT();
				notas_update($_REQUEST['IdTrabajo']);
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){

				new Evaluacion_SEARCH();
			}
			else{
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], $_REQUEST['CorrectoA'], $_REQUEST['ComenIncorrectoA'], $_REQUEST['CorrectoP'], $_REQUEST['ComentIncorrectoP'], $_REQUEST['OK']);
				$datos = $EVALUACION->SEARCH();
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');				
				new Evaluacion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
			$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
			$valores = $EVALUACION->RellenaDatos();
			$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
			new Evaluacion_SHOWCURRENT($lista, $valores);
			break;
			
		default:
			if (!$_POST){
				$EVALUACION = new EVALUACIONES_Model('','','', '','','', '', '','');
			}
			else{
				$EVALUACION = get_data_form();
			}
			$datos = $EVALUACION->SEARCH();
			$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA','CorrectoP','OK');
			new Evaluacion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>