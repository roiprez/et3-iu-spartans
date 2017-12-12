<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include '../Models/EVALUACIONES_Model.php';
include '../Models/HISTORIAS_Model.php';
include '../Views/Resultados_VIEWS/Resultados_SHOWCURRENT_ET.php';
include '../Views/MESSAGE_View.php';


if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	Switch ($_REQUEST['action']){
    case 'SHOWCURRENT_ET':

      $EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], '', $_REQUEST['AliasEvaluado'], '','','', '', '','');
      $datos = $EVALUACION->SEARCH();

      $HISTORIA = new HISTORIA_Model($_REQUEST['IdTrabajo'], '', '');
      $historias = $HISTORIA->SEARCH();

      $descrip_historias = [];

      //Guardamos las descripciones de historias
      while($row = $historias->fetch_array()) {
          array_push($descrip_historias, $row[2]);
      }

      $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComenIncorrectoP','OK');
      new Resultados_SHOWCURRENT_ET($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php');	
      break;
      
    case 'SHOWCURRENT_QA':
    
      $EVALUACION = new EVALUACIONES_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], '', '','','', '', '','');
      $datos = $EVALUACION->SEARCH();

      $HISTORIA = new HISTORIA_Model($_REQUEST['IdTrabajo'], '', '');
      $historias = $HISTORIA->SEARCH();

      $descrip_historias = [];

      //Guardamos las descripciones de historias
      while($row = $historias->fetch_array()) {
          array_push($descrip_historias, $row[2]);
      }

      $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComenIncorrectoP','OK');
      new Resultados_SHOWCURRENT_QA($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php');	
      break;
			
    default:
      					
	}
?>