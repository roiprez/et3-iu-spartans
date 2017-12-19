<?php
/*
Devuelve las notas de entregas y QAs
*/
include_once '../Models/EVALUACIONES_Model.php';

function generarNotaEntrega($idTrabajo, $alias, $porcentajeNota){
	$EVALUACIONES = new EVALUACIONES_Model($idTrabajo, '', $alias, '', '', '', '', '', '');   
  $evaluaciones = $EVALUACIONES->SEARCH_STRICT_EV();

  $numero_historias = 0; 
  $numero_correctos = 0;
  
  while($row = $evaluaciones->fetch_array()){  
      if($row[6] == 1){
        $numero_correctos++;
      }   
      $numero_historias++;
  }
  //Solución provisional para que no intente hacer la operación si no hay historias
  if($numero_historias > 0){
    return (($numero_correctos/$numero_historias)*10)*$porcentajeNota/100;
  }
  return 0;
} 
function generarNotaQA($idTrabajo, $login, $porcentajeNota){
	$EVALUACIONES = new EVALUACIONES_Model($idTrabajo, $login, '', '', '', '', '', '', '');   
  $evaluaciones = $EVALUACIONES->SEARCH();

  $numero_historias = 0;
  $numero_correctos = 0;
  
  while($row = $evaluaciones->fetch_array()) {
      if($row[8] == 1){
        $numero_correctos++;
      }   
      $numero_historias++;
  }
  //Solución provisional para que no intente hacer la operación si no hay historias
  if($numero_historias > 0){
    return (($numero_correctos/$numero_historias)*10)*$porcentajeNota/100;
  }
  return 0;
} 
?>