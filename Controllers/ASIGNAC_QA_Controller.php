<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Asignaciones.
13/12/2017 por IU SPARTANS
*/

include_once  '../Models/ASIGNAC_QA_Model.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_ADD.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_EDIT.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_DELETE.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_SEARCH.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_SHOWALL.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';

//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
function get_data_form(){
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $LoginEvaluador =$_REQUEST['LoginEvaluador'];
    $LoginEvaluado = $_REQUEST['LoginEvaluado'];
    $AliasEvaluado = $_REQUEST['AliasEvaluado'];
    $action = $_REQUEST['action'];

    $ASIGNA_QA = new ASIGNAC_QA_Model(
        $IdTrabajo,
        $LoginEvaluador,
        $LoginEvaluado,
        $AliasEvaluado
    );

    return $ASIGNA_QA;
}

//Si el formulario no ha devuelto una action la inicializamos vacía
if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}


	//EN función de la action que llega del formulario ejecutamos una acción distinta
    Switch ($_REQUEST['action']){
    //Añadimos una tupla
    case 'ADD':
        //Si no hay post
        if (!$_POST){
            //Creamos una instancia de la vista
            new Asignac_QA_ADD();
        }
        else{
            //Recogemos los datos, los añadimos y lanzamos la respuesta en una vista
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'],$_REQUEST['LoginEvaluador'],$_REQUEST['LoginEvaluado'],$_REQUEST['AliasEvaluado']);
            $respuesta = $ASIGNA_QA->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Borramos una tupla
    case 'DELETE':
        //Si no hay post
        if (!$_POST){
            //Creamos una vista con los datos de la asignacion
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],'',$_REQUEST['AliasEvaluado']);
            $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
            $valores = $ASIGNA_QA->RellenaDatos();
            new Asignac_QA_DELETE($lista, $valores);
        }
        else{
            //Cogemos la asignacion y la borramos
            $ASIG_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],$_REQUEST['LoginEvaluado'],$_REQUEST['AliasEvaluado']);
            $respuesta = $ASIGNA_QA->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Editamos una tupla
    case 'EDIT':
        //Si no hay post
        if (!$_POST){
            //Rellenamos de datos la vista de edit y la mostramos
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], '',$_REQUEST['AliasEvaluado']);
            $valores = $ASIGNA_QA->RellenaDatos();
			//Separamos los valores de la asignación y se los pasamos a la vista de edit como parámetro     
		    $IdTrabajo  = $valores[0];
		    $LoginEvaluador = $valores[1];
		    $LoginEvaluado = $valores[2];
		    $AliasEvaluado = $valores[3];  
            new Asignac_QA_EDIT($IdTrabajo,$LoginEvaluador,$LoginEvaluado,$AliasEvaluado);
	    } else{
            //Cogemos el resultado del submit del formulario y editamos en el modelo
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],$_REQUEST['LoginEvaluado'] ,$_REQUEST['AliasEvaluado']);
            $respuesta = $ASIGNA_QA->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
		//Buscamos una tupla o un conjunto de tuplas
        case 'SEARCH':
        //Si no hay post
        if (!$_POST){
            //Lanza la vista del search
            new Asignac_QA_SEARCH();
        }
        else{
            //Recogemos los datos y lanzamos un showall con las asignaciones filtradas
            $ASIGNA_QA = get_data_form();
            $datos = $ASIGNA_QA->SEARCH();
            $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
            new Asignac_QA_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    //Mostramos en detalle una tupla
    case 'SHOWCURRENT':
        $ASIG_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],'' ,$_REQUEST['AliasEvaluado']);
        $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
        $valores = $ASIG_QA->RellenaDatos();
        new Asignac_QA_SHOWCURRENT($lista, $valores);
        break;
    //Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
    default:
        //Si no hay post
        if (!$_POST){
            $ASIGNA_QA = new ASIGNAC_QA_Model('','','','');
        }
        else{
            $ASIGNA_QA = get_data_form();
        }
        $datos = $ASIGNA_QA->SEARCH();
        $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
        new Asignac_QA_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');

}
?>