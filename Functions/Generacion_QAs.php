<?php

include_once '../Models/ENTREGAS_Model.php';
include_once '../Models/TRABAJOS_Model.php';
include_once '../Models/HISTORIA_Model.php';
include_once '../Models/EVALUACIONES_Model.php';
include_once '../Models/ASIGNAC_QA_Model.php';
include_once '../Functions/Generacion_Notas.php';
include_once '../Models/NOTAS_Model.php';

// include_once '../Views/MESSAGE_View.php';

if(isset($_GET['qa_gen'])){
  qa_gen($_GET['qa_gen']); 
}
//Genera las qa que debe corregir cada login
function qa_gen($IdTrabajo){
    $ENTREGAS =  new ENTREGAS_Model($IdTrabajo,'','','','');
    $entregas = $ENTREGAS->SEARCH();

    $lista_login = [];
    $lista_login_evaluado = [];
    $lista_alias = [];

    //Rellena las listas de login y alias
    while($row = $entregas->fetch_array()) {
      array_push($lista_login, $row[1]);
      array_push($lista_login_evaluado, $row[1]);
      array_push($lista_alias, $row[2]);
    }
    
    //Recorre en bucle todos los login
    for($i = 0;$i<count($lista_login);$i++){
      //Asigna como primer alias el quinto que sigue al login
      $j = $i+5;
      $contador = 0;
      //Mientras no haya cinco asignaciones sigue asignando
      while($contador < 5){
        //Comprueba que no haya sobrepasado la variable de control de acceso al tamaño del array
        if($j >= count($lista_alias)){
          $j = $j - count($lista_alias);
        }
        //Comprueba que el login y el alias no correspondan a la misma persona.
        if($i == $j){
          $j++;
        }
        $ASIGNAC_QA = new ASIGNAC_QA_Model($IdTrabajo, $lista_login[$i],$lista_login_evaluado[$j], $lista_alias[$j]);
        $respuesta = $ASIGNAC_QA->ADD();
        evaluacion_gen($IdTrabajo, $lista_login[$i], $lista_alias[$j]);
        $contador++;
        $j+=5;
      }    
    }
    return 'Se han generado las asignaciones y sus correspondientes evaluaciones con éxito';
}

function evaluacion_gen($IdTrabajo, $LoginEvaluador, $AliasEvaluado){
  $HISTORIAS =  new HISTORIA_Model($IdTrabajo,'','');
  $historias = $HISTORIAS->SEARCH();

  $lista_historias = [];
  //Recorre las historias y pasa el Id de historia al modelo de evaluaciones
  while($row = $historias->fetch_array()) {
    $EVALUACIONES = new EVALUACIONES_Model($IdTrabajo,$LoginEvaluador,$AliasEvaluado,$row[1],1,'',1,'',1);
    $respuesta = $EVALUACIONES->ADD();
  }
  notas_gen($IdTrabajo);
}

function notas_gen($IdTrabajo){
  $TRABAJO = new TRABAJOS_Model($IdTrabajo, '', '','','');
  $trabajo = $TRABAJO->SEARCH()->fetch_array();

  $ENTREGAS = new ENTREGAS_Model($IdTrabajo, '', '','','');
  $entregas = $ENTREGAS->SEARCH();
  
  while($row = $entregas->fetch_array()) {
    $NOTAS;
    if($IdTrabajo[0] == 'E'){
      $NOTAS = new NOTAS_Model($row[1], $IdTrabajo, generarNotaEntrega($IdTrabajo, $row[2], $trabajo[4]));
    }
    else{
      $NOTAS = new NOTAS_Model($row[1], $IdTrabajo, generarNotaQA($IdTrabajo, $row[1], $trabajo[4]));
    }
    $NOTAS->ADD();			
  }
}

function notas_update($IdTrabajo){
  $TRABAJO = new TRABAJOS_Model($IdTrabajo, '', '','','');
  $trabajo = $TRABAJO->SEARCH()->fetch_array();

  $ENTREGAS = new ENTREGAS_Model($IdTrabajo, '', '','','');
  $entregas = $ENTREGAS->SEARCH();

  while($row = $entregas->fetch_array()) {
    $NOTAS;
    if($IdTrabajo[0] == 'E'){
      $NOTAS = new NOTAS_Model($row[1], $IdTrabajo, generarNotaEntrega($IdTrabajo, $row[2], $trabajo[4]));
    }
    else{
      $NOTAS = new NOTAS_Model($row[1], $IdTrabajo, generarNotaQA($IdTrabajo, $row[1], $trabajo[4]));
    }
    $NOTAS->EDIT();				
  } 		
}
?>
