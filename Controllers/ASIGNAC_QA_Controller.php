<?php
include '../Models/ASIGNAC_QA_Model.php';
include '../Models/TRABAJOS_Model.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_ADD.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_ESIT.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_DELETE.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_SEARCH.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_SHOWALL.php';
include '../Views/Asignac_QA_VIEWS/Asignac_QA_SHOWCURRENT.php';

function get_data_form(){
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $LoginEvaluador =$_REQUEST['LoginEvaluador'];
    $LoginEvaluado = $_REQUEST['LoginEvaluado'];
    $AliasEvaluado = $_REQUEST['AliasEvaluado'];
    $action = $_REQUEST['action'];

    $ASIGNA_QA = new HISTORIA_Model(
        $IdTrabajo,
        $LoginEvaluador,
        $LoginEvaluado,
        $AliasEvaluado
    );

    return $ASIGNA_QA;
}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}


Switch ($_REQUEST['action']){
    case 'ADD':
        if (!$_POST){
            new Historia_ADD($trabajosTotales);
        }
        else{
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'],$_REQUEST['LoginEvaluador'],$_REQUEST['LoginEvaluado'],$_REQUEST['AliasEvaluado']);
            $respuesta = $ASIGNA_QA->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'DELETE':
        if (!$_POST){
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],'',$_REQUEST['AliasEvaluado']);
            $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
            $valores = $ASIGNA_QA->RellenaDatos();
            new Asignac_QA_DELETE($lista, $valores);
        }
        else{
            $ASIG_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],$_REQUEST['LoginEvaluado'],$_REQUEST['AliasEvaluado']);
            $respuesta = $ASIGNA_QA->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'EDIT':
        if (!$_POST){
            $ASIG_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], '',$_REQUEST['AliasEvaluado']);
            $valores = $ASIGNA_QA->RellenaDatos();

            new Asignac_QA_EDIT($valores);
        }
        else{
            $ASIGNA_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],$_REQUEST['LoginEvaluado'] ,$_REQUEST['AliasEvaluado']);
            $respuesta = $ASIGNA_QA->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;

        break;
    case 'SEARCH':
        if (!$_POST){
            new Asignac_QA_SEARCH();
        }
        else{
            $ASIGNA_QA = get_data_form();
            $datos = $ASIGNA_QA->SEARCH();
            $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
            new Asignac_QA_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    case 'SHOWCURRENT':
        $ASIG_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'],'' ,$_REQUEST['AliasEvaluado']);
        $lista = array('IdTrabajo', 'LoginEvaluador', 'LoginEvaluado','AliasEvaluado');
        $valores = $ASIG_QA->RellenaDatos();
        new Asignac_QA_SHOWCURRENT($lista, $valores);
        break;
    default:
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