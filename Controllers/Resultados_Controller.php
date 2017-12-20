<?php

/*
*/

include_once '../Models/EVALUACIONES_Model.php';
include_once '../Models/HISTORIA_Model.php';
include_once '../Models/ENTREGAS_Model.php';
include '../Views/Resultados_VIEWS/Resultados_SHOWCURRENT_ET.php';
include '../Views/Resultados_VIEWS/Resultados_SHOWCURRENT_QA.php';
include '../Views/MESSAGE_View.php';

$IdTrabajo = $_REQUEST['IdTrabajo'];
$LoginEvaluador = $_SESSION['login']; 

$ENTREGAS = new ENTREGAS_Model($IdTrabajo, $LoginEvaluador, '', '','','', '', '','');
$entregas = $ENTREGAS->RellenaDatos();

$AliasEvaluado = $entregas[2];

if($_REQUEST['Generar'][0] == 'E'){
    $EVALUACION = new EVALUACIONES_Model($IdTrabajo, '', $AliasEvaluado, '','','', '', '','');
    $datos = $EVALUACION->SEARCH_STRICT_EV();

    $HISTORIA = new HISTORIA_Model($IdTrabajo, '', '');
    $historias = $HISTORIA->SEARCH();

    $descrip_historias = [];

    //Guardamos las descripciones de historias
    while($row = $historias->fetch_array()) {
        array_push($descrip_historias, $row[2]);
    }

    $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
    new Resultados_SHOWCURRENT_ET($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php');

} elseif($_REQUEST['Generar'][0] == 'Q'){
    $EVALUACIONES = new EVALUACIONES_Model($IdTrabajo,$LoginEvaluador, '', '','','', '', '','');
    $datos = $EVALUACIONES->SEARCH_STRICT_QA();

    $HISTORIA = new HISTORIA_Model($IdTrabajo, '', '');
    $historias = $HISTORIA->SEARCH();

    //Guardará la descripción de las historias
    $descrip_historias = [];

    //Guardamos las descripciones de historias
    while($row = $historias->fetch_array()) {
        array_push($descrip_historias, $row[2]);
    }
  
    //Guardará el CorrectoA del alumno para las 5 qas
    $qas = [];
    //Guardará el OK del profesor para las 5 qas del alumno
    $oks = [];

    //Recorremos un bucle para las 5 qas
    for($i=0;$i<5;$i++){
        //Rellenamos la variable historias
        $historias = $HISTORIA->SEARCH();
        //Define el número de historia
        $j = 1;
        while($j<=count($descrip_historias) && $row = $datos->fetch_array()) {
            //Guardamos en la qa $i, y en la historia $j el valor de CorrectoA
            $qas[$i][$j] = $row[4];
            //Guardamos en la qa $i, y en la historia $j el valor de OK
            $oks[$i][$j] = $row[8];
            $j++;
        }
    }
    new ResultadosSHOWCURRENT_QA($qas, $oks, $descrip_historias, '../Controllers/Index_Controller.php');
}
?>