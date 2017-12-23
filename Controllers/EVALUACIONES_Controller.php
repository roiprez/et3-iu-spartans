<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Evaluaciones.
08/12/2017 por IU SPARTANS
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




//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
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

//Si el formulario no ha devuelto una action la inicializamos vacía
if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}


	
	//EN función de la action que llega del formulario ejecutamos una acción distinta
	//EN función de la action que llega del formulario ejecutamos una acción distinta
	Switch ($_REQUEST['action']){

		//Añadimos una tupla
		case 'ADD':
			//Si no hay post
			if (!$_POST){
				//Creamos una instancia de la vista
				new Evaluacion_ADD();
			}
			else{				
				//Recogemos los datos, los añadimos y lanzamos la respuesta en una vista
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], $_REQUEST['CorrectoA'], $_REQUEST['ComenIncorrectoA'], $_REQUEST['CorrectoP'], $_REQUEST['ComentIncorrectoP'], $_REQUEST['OK']);
				$respuesta = $EVALUACION->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Borramos una tupla
		case 'DELETE':
			//Si no hay post
			if (!$_POST){
				//Creamos una vista con los datos de la evaluacion
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
				$valores = $EVALUACION->RellenaDatos();
				new Evaluacion_DELETE($lista, $valores);
			}
			else{
				//Cogemos la evaluacion y la borramos
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
				$respuesta = $EVALUACION->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Editamos una tupla
		case 'EDIT':		
			//Si no hay post
			if (!$_POST){	
				//Rellenamos de datos la vista de edit y la mostramos
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
				$valores = $EVALUACION->RellenaDatos();
				new Evaluacion_EDIT($valores);
			}
			else{	
				//Cogemos el resultado del submit del formulario y editamos en el modelo
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], $_REQUEST['CorrectoA'], $_REQUEST['ComenIncorrectoA'], $_REQUEST['CorrectoP'], $_REQUEST['ComentIncorrectoP'], $_REQUEST['OK']);							
				$respuesta = $EVALUACION->EDIT();
				notas_update($_REQUEST['IdTrabajo']);
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		//Buscamos una tupla o un conjunto de tuplas
		case 'SEARCH':
			//Si no hay post
			if (!$_POST){
				//Lanza la vista de search
				new Evaluacion_SEARCH();
			}
			else{
				//Recogemos los datos y lanzamos un showall con las tuplas filtradas
				$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], $_REQUEST['CorrectoA'], $_REQUEST['ComenIncorrectoA'], $_REQUEST['CorrectoP'], $_REQUEST['ComentIncorrectoP'], $_REQUEST['OK']);
				$datos = $EVALUACION->SEARCH();
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA','CorrectoP','OK');			
				new Evaluacion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		//Mostramos en detalle una tupla
		case 'SHOWCURRENT':
			$EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', '');
			$valores = $EVALUACION->RellenaDatos();
			$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');				
			new Evaluacion_SHOWCURRENT($lista, $valores);
			break;			
		//Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
		default:
			//Si no hay post
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