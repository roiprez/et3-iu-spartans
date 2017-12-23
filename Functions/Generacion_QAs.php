<?php
/*
Genera automáticamente las qas, sus evaluaciones y las notas
*/

include_once '../Models/ENTREGAS_Model.php';
include_once '../Models/TRABAJOS_Model.php';
include_once '../Models/HISTORIA_Model.php';
include_once '../Models/EVALUACIONES_Model.php';
include_once '../Models/ASIGNAC_QA_Model.php';
include_once '../Functions/Generacion_Notas.php';
include_once '../Models/NOTAS_Model.php';

// include_once '../Views/MESSAGE_View.php';

//Si qa_gen se ha definido lanza la función con el contenido de la variable, que es un IdTrabajo
if(isset($_GET['qa_gen'])){
  qa_gen($_GET['qa_gen']); 
}
//Genera las qa que debe corregir cada login
function qa_gen($IdTrabajo){
    //Guarda una nueva instancia de la clase ENTREGAS
    $ENTREGAS =  new ENTREGAS_Model($IdTrabajo,'','','','');
    //Guarda el resultado de una búsqueda
    $entregas = $ENTREGAS->SEARCH();

    //Guarda la lista de logins de evaluador
    $lista_login = [];
    //Guarda la lista de logins de evaluado
    $lista_login_evaluado = [];
    //Guarda la lista de alias de evaluado
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
        //Crea una nueva instancia de ASIGNAC_QA con el Id del trabajo, el login de evaluador, el login que corresponde de evaluado y el alias de este
        $ASIGNAC_QA = new ASIGNAC_QA_Model($IdTrabajo, $lista_login[$i],$lista_login_evaluado[$j], $lista_alias[$j]);
        $ASIGNAC_QA->ADD();
        //Genera las evaluaciones correspondientes a esta asignación
        evaluacion_gen($IdTrabajo, $lista_login[$i], $lista_alias[$j]);
        $contador++;
        $j+=5;
      }    
    }
    return 'Se han generado las asignaciones y sus correspondientes evaluaciones con éxito';
}

//Genera las evaluaciones de una asignación
function evaluacion_gen($IdTrabajo, $LoginEvaluador, $AliasEvaluado){
  //Guarda una nueva instancia de la clase HISTORIAS
  $HISTORIAS =  new HISTORIA_Model($IdTrabajo,'','');
  //Guarda el resultado de una búsqueda
  $historias = $HISTORIAS->SEARCH();

  //Guarda las historias asignadas a un trabajo
  $lista_historias = [];
  //Recorre las historias y pasa el Id de historia al modelo de evaluaciones
  while($row = $historias->fetch_array()) {
    //Crea una nueva instancia de evaluaciones con el id de la historia y la añade en el modelo(pasa correctos por defecto)
    $EVALUACIONES = new EVALUACIONES_Model($IdTrabajo,$LoginEvaluador,$AliasEvaluado,$row[1],1,'',1,'',1);
    $EVALUACIONES->ADD();
  }
  //Genera las notas del trabajo
  notas_gen($IdTrabajo);
}

//Crea las notas para evaluaciones y QAs
function notas_gen($IdTrabajo){
  //Guarda una nueva instancia de la clase TRABAJO
  $TRABAJO = new TRABAJOS_Model($IdTrabajo, '', '','','');
  //Guarda la búsqueda y coge la única tupla que genera
  $trabajo = $TRABAJO->SEARCH()->fetch_array();

  //Guarda la instancia que corresponde a la QA del trabajo
  $TRABAJO_QA = new TRABAJOS_Model('QA' . $IdTrabajo[2], '', '','','');
  //Guarda la búsqueda y coge la única tupla que genera  
  $trabajo_qa = $TRABAJO_QA->SEARCH()->fetch_array();

  //Guarda una nueva instancia de la clase ENTREGAS  
  $ENTREGAS = new ENTREGAS_Model($IdTrabajo, '', '','','');
  //Guarda el resultado de una búsqueda 
  $entregas = $ENTREGAS->SEARCH();
  
  //Recorre todas las entregas y por cada una genera la nota para la ET y la QA correspondiente
  while($row = $entregas->fetch_array()) {
    $NOTAS;
    $NOTAS = new NOTAS_Model($row[1], $IdTrabajo, generarNotaEntrega($IdTrabajo, $row[2], $trabajo[4]));
    $NOTAS->ADD();
    $NOTAS = new NOTAS_Model($row[1], 'QA' . $IdTrabajo[2], generarNotaQA($IdTrabajo, $row[1], $trabajo_qa[4]));
    $NOTAS->ADD();		
  }
}

//Actualiza las notas para evaluaciones y QAs
function notas_update($IdTrabajo){
  //Guarda una nueva instancia de la clase TRABAJO
  $TRABAJO = new TRABAJOS_Model($IdTrabajo, '', '','','');
  //Guarda la búsqueda y coge la única tupla que genera
  $trabajo = $TRABAJO->SEARCH()->fetch_array();

  //Guarda la instancia que corresponde a la QA del trabajo
  $TRABAJO_QA = new TRABAJOS_Model('QA' . $IdTrabajo[2], '', '','','');
  //Guarda la búsqueda y coge la única tupla que genera  
  $trabajo_qa = $TRABAJO_QA->SEARCH()->fetch_array();

  //Guarda una nueva instancia de la clase ENTREGAS  
  $ENTREGAS = new ENTREGAS_Model($IdTrabajo, '', '','','');
  //Guarda el resultado de una búsqueda 
  $entregas = $ENTREGAS->SEARCH();

  //Recorre todas las entregas y por cada una actualiza la nota para la ET y la QA correspondiente
  while($row = $entregas->fetch_array()) {
    $NOTAS;
    $NOTAS = new NOTAS_Model($row[1], $IdTrabajo, generarNotaEntrega($IdTrabajo, $row[2], $trabajo[4]));
    $NOTAS->EDIT();
    $NOTAS = new NOTAS_Model($row[1], 'QA' . $IdTrabajo[2], generarNotaQA($IdTrabajo, $row[1], $trabajo_qa[4]));
    $NOTAS->EDIT();					
  } 		
}
?>
