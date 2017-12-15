<?php
/*
Genera las notas de entregas y QAs
*/
include_once '../Models/EVALUACIONES_Model.php';

function generarNotaEntrega($idTrabajo, $alias){
	$EVALUACIONES = new EVALUACIONES_Model($idTrabajo, '', $alias, '', '', '', '', '', '');   
  $evaluaciones = $EVALUACIONES->SEARCH();

  $numero_historias = 0;
  
  $numero_correctos = 0;
  
  while($row = $evaluaciones->fetch_array()) {  
    // echo($row[0] . "  " . $row[1] . "   " . $row[2] . "  " . $row[3] . "   " . $row[4] . "  " . $row[6] . "   ");
      if($row[6] == 1){
        $numero_correctos++;
      }   
      $numero_historias++;
  }
  return $numero_correctos/$numero_historias;
  echo ($numero_correctos);
  echo($numero_historias);
} 
function generarNotaQA($idTrabajo, $login){
	$EVALUACIONES = new EVALUACIONES_Model($idTrabajo, $login, '', '', '', '', '', '', '');   
  $evaluaciones = $EVALUACIONES->SEARCH();

  $numero_historias = count($evaluaciones->fetch_array());
  $numero_correctos = 0;
  
  while($row = $evaluaciones->fetch_array()) {
      if($row[8] == 1){
        $numero_correctos++;
      }   
  }
  return $numero_correctos/$numero_historias;
} 
?>