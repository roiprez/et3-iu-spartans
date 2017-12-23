<?php
/*
Devuelve las notas de entregas y QAs
*/
include_once '../Models/EVALUACIONES_Model.php';

//Genera la nota de una entrega a partir del idTrabajo, el alias del evaluado y el porcentaje de la nota
function generarNotaEntrega($idTrabajo, $alias, $porcentajeNota){
  //Guarda una nueva instancia de la clase EVALUACIONES
  $EVALUACIONES = new EVALUACIONES_Model($idTrabajo, '', $alias, '', '', '', '', '', '');   
  //Guarda el resultado de una búsqueda estricta
  $evaluaciones = $EVALUACIONES->SEARCH_STRICT_EV();

  //Guarda el número de historias
  $numero_historias = 0; 
  //Guarda el número de historias correctas
  $numero_correctos = 0;
  
  //mientras haya tuplas de evaluaciones incremente el numero de correctos si correctoP es correcto, y aumenta el número de historias incondicionalmente
  while($row = $evaluaciones->fetch_array()){ 
      //si correctoP es 1, incrementa el número de correctos 
      if($row[6] == 1){
        $numero_correctos++;
      }   
      $numero_historias++;
  }
  //Si no hay historias no hace el cálculo de nota y devuelve 0
  if($numero_historias > 0){
    return (($numero_correctos/$numero_historias)*10)*$porcentajeNota/100;
  }
  return 0;
} 
//Genera la nota de una QA a partir del idTrabajo, el login del evaluador y el porcentaje de la nota
function generarNotaQA($idTrabajo, $login, $porcentajeNota){
  //Guarda una nueva instancia de la clase EVALUACIONES  
  $EVALUACIONES = new EVALUACIONES_Model($idTrabajo, $login, '', '', '', '', '', '', '');   
  //Guarda el resultado de una búsqueda estricta
  $evaluaciones = $EVALUACIONES->SEARCH_STRICT_QA();

  //Guarda el número de historias
  $numero_historias = 0;
  //Guarda el número de historias correctas
  $numero_correctos = 0;
  
  //mientras haya tuplas de evaluaciones incremente el numero de correctos si OK es correcto, y aumenta el número de historias incondicionalmente
  while($row = $evaluaciones->fetch_array()) {
      //si OK es 1, incrementa el número de correctos 
      if($row[8] == 1){
        $numero_correctos++;
      }   
      $numero_historias++;
  }
  //Si no hay historias no hace el cálculo de nota y devuelve 0
  if($numero_historias > 0){
    return (($numero_correctos/$numero_historias)*10)*$porcentajeNota/100;
  }
  return 0;
} 
?>