<?php

/*
Controlador que se encarga de la muestra de los resultados obtenidos por el alumno.
13/12/2017 por IU SPARTANS
*/

include_once '../Models/EVALUACIONES_Model.php';
include_once '../Models/HISTORIA_Model.php';
include_once '../Models/ENTREGAS_Model.php';
include '../Views/Resultados_VIEWS/Resultados_SHOWCURRENT_ET.php';
include '../Views/Resultados_VIEWS/Resultados_SHOWCURRENT_QA.php';
include '../Views/MESSAGE_View.php';

//Guardamos el Id del trabajo que se introdujo en el formulario
$IdTrabajo = $_REQUEST['IdTrabajo'];
//Guardamos el login de la sesión que corresponde al evaluador
$LoginEvaluador = $_SESSION['login']; 

//Cogemos la entrega hecha por el usuario para ese trabajo
$ENTREGAS = new ENTREGAS_Model($IdTrabajo, $LoginEvaluador, '', '','','', '', '','');
$entregas = $ENTREGAS->RellenaDatos();

//Guardamos el alias de esa entrega
$AliasEvaluado = $entregas[2];

//Si hemos indicado que queríamos acceder al resultado de una et entramos por aquí
if($_REQUEST['Generar'][0] == 'E'){
    //Cogemos todas las evaluaciones en las que el usuario es evaluado con su alias
    $EVALUACION = new EVALUACIONES_Model($IdTrabajo, '', $AliasEvaluado, '','','', '', '','');
    $datos = $EVALUACION->SEARCH_STRICT_EV();

    //Cogemos todas las historias del trabajo
    $HISTORIA = new HISTORIA_Model($IdTrabajo, '', '');
    $historias = $HISTORIA->SEARCH();

    //Guardamos aquí la descripción de las historias
    $descrip_historias = [];

    //Guardamos las descripciones de historias
    while($row = $historias->fetch_array()) {
        array_push($descrip_historias, $row[2]);
    }
    //Llamamos a la vista del resultado de la Et
    $lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP','ComentIncorrectoP','OK');
    new Resultados_SHOWCURRENT_ET($lista, $datos, $descrip_historias, '../Controllers/Index_Controller.php');

    //Si hemos indicado que queríamos acceder al resultado de una qa entramos por aquí
} elseif($_REQUEST['Generar'][0] == 'Q'){
    //Cogemos todas las evaluaciones en las que el usuario fue evaluador 
    $EVALUACIONES = new EVALUACIONES_Model($IdTrabajo,$LoginEvaluador, '', '','','', '', '','');
    $datos = $EVALUACIONES->SEARCH_STRICT_QA();

    //Cogemos todas las historias del trabajo
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
    //Llamamos a la vista del resultado de la QA
    new ResultadosSHOWCURRENT_QA($qas, $oks, $descrip_historias, '../Controllers/Index_Controller.php');
}
?>