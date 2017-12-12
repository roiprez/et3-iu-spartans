<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include '../Models/EVALUACIONES_Model.php';
include '../Models/HISTORIAS_Model.php';
include '../Models/ENTREGAS_Model.php';
include '../Views/Resultados_VIEWS/Resultados_SHOWCURRENT_ET.php';
include '../Views/MESSAGE_View.php';



$IdTrabajo = $_REQUEST['IdTrabajo'];
$LoginEvaluador = $_SESSION['login']; 

$ENTREGAS = new ENTREGAS_Model($IdTrabajo, $LoginEvaluador, '', '','','', '', '','');
$entregas = $ENTREGAS->RellenaDatos();

$AliasEvaluado = $entregas[2];

if($IdTrabajo[0] == 'E'){
  $EVALUACION = new EVALUACIONES_Model($IdTrabajo, '', $AliasEvaluado, '','','', '', '','');
  $datos = $EVALUACION->SEARCH();

  $HISTORIA = new HISTORIA_Model($IdTrabajo, '', '');
  $historias = $HISTORIA->SEARCH();

  $descrip_historias = [];

  //Guardamos las descripciones de historias
  while($row = $historias->fetch_array()) {
      array_push($descrip_historias, $row[2]);
  }

  $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComenIncorrectoP','OK');
  new Resultados_SHOWCURRENT_ET($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php'); 
} else {
  $EVALUACION = new EVALUACIONES_Model($IdTrabajo, $LoginEvaluador, '', '','','', '', '','');
  $datos = $EVALUACION->SEARCH();

  $HISTORIA = new HISTORIA_Model($IdTrabajo, '', '');
  $historias = $HISTORIA->SEARCH();

  $descrip_historias = [];

  //Guardamos las descripciones de historias
  while($row = $historias->fetch_array()) {
      array_push($descrip_historias, $row[2]);
  }

  $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComenIncorrectoP','OK');
  new Resultados_SHOWCURRENT_QA($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php');	

}
?>