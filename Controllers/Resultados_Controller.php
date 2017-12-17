<?php

/*
*/

include_once '../Models/EVALUACIONES_Model.php';
include_once '../Models/HISTORIA_Model.php';
include_once '../Models/ENTREGAS_Model.php';
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

  $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
  new Resultados_SHOWCURRENT_ET($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php'); 
} elseif($IdTrabajo[0] == 'Q'){
  $EVALUACION = new EVALUACIONES_Model($IdTrabajo, $LoginEvaluador, '', '','','', '', '','');
  $datos = $EVALUACION->SEARCH();

  $HISTORIA = new HISTORIA_Model($IdTrabajo, '', '');
  $historias = $HISTORIA->SEARCH();

  $descrip_historias = [];
  $qas;
  $aliasActual = 'ninguno';
  $i = 0; //Variable que contiene cada uno de los CorrectoA de $j.
  $j = 0; //Variable que contiene cada una de las QAs realizadas, empieza en 1 y acaba en 5.

  while($row = $datos->fetch_array()) {
    if($aliasActual == 'ninguno' || $aliasActual != $row[2]){
      $i = 0;
      $j++;
      $aliasActual = $row[2];
    }
    $qas[$j][$i] = $row[4];
  }

  //Guardamos las descripciones de historias
  while($row = $historias->fetch_array()) {
      array_push($descrip_historias, $row[2]);
  }

  $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
  new Resultados_SHOWCURRENT_QA($lista, $qas, $descrip_historias, '../Controllers/Index_Controller.php');	
}
?>