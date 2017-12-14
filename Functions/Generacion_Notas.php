<?php
/*
Genera las notas de entregas y QAs
*/
include_once '../Models/EVALUACIONES_Model.php';

function generarNotaEntrega($idTrabajo, $alias){
	$EVALUACIONES = new EVALUACIONES_Model($idTrabajo, '', $alias, '', '', '', '', '', '');   
  $evaluaciones = $EVALUACIONES->SEARCH();

  $numero_historias = $evaluaciones->fetch_array().length();
  $numero_correctos = 0;
  
  while($row = $evaluaciones->fetch_array()) {
      if($row[6] == 1){
        $numero_correctos++;
      }   
  }
  return $numero_correctos/$numero_historias;
} 
function generarNotaQA($idTrabajo, $login){
	$EVALUACIONES = new EVALUACIONES_Model($idTrabajo, $login, '', '', '', '', '', '', '');   
  $evaluaciones = $EVALUACIONES->SEARCH();

  $numero_historias = $evaluaciones->fetch_array().length();
  $numero_correctos = 0;
  
  while($row = $evaluaciones->fetch_array()) {
      if($row[8] == 1){
        $numero_correctos++;
      }   
  }
  return $numero_correctos/$numero_historias;
} 
?>