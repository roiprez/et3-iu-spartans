<?php
    include_once '../Models/HISTORIA_Model.php';
    include '../Models/TRABAJOS_Model.php';
    include '../Views/MESSAGE_View.php';
    include '../Views/Historia_VIEWS/Historia_ADD.php';
    include '../Views/Historia_VIEWS/Historia_DELETE.php';
    include '../Views/Historia_VIEWS/Historia_EDIT.php';
    include '../Views/Historia_VIEWS/Historia_SEARCH.php';
    include '../Views/Historia_VIEWS/Historia_SHOWALL.php';
    include '../Views/Historia_VIEWS/Historia_SHOWCURRENT.php';

function get_data_form(){
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $IdHistoria = $_REQUEST['IdHistoria'];
    $TextoHistoria = $_REQUEST['TextoHistoria'];
    $action = $_REQUEST['action'];

    $HISTORIAS = new HISTORIA_Model(
        $IdTrabajo,
        $IdHistoria,
        $TextoHistoria
    );

    return $HISTORIAS;
}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}


Switch ($_REQUEST['action']){
    case 'ADD':
        if (!$_POST){
            $TRABAJOS=new TRABAJOS_Model('','','','');//Nuevo modelo de Trabajo
            $datosTrabajos= $TRABAJOS->SEARCH();
            $trabajosTotales = array();
            while($rowTrabajo= $datosTrabajos->fetch_array()){
                $trabajosTotales[]=$rowTrabajo[0];
            }
            new Historia_ADD($trabajosTotales);
        }
        else{
            $HISTORIAS = get_data_form();
            $respuesta = $HISTORIAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'DELETE':
        if (!$_POST){
            $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
            $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
            $valores = $HISTORIAS->RellenaDatos();
            new Historia_DELETE($lista, $valores);
        }
        else{
            $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
            $respuesta = $HISTORIAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'EDIT':
        if (!$_POST){
            $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
            $valores = $HISTORIAS->RellenaDatos();
            $TRABAJOS=new TRABAJOS_Model();//Nuevo modelo de Trabajo
            $datosTrabajos= $TRABAJOS->SEARCH();
            $trabajosTotales = array();
            while($rowTrabajo= $datosTrabajos->fetch_array()){
                $trabajosTotales[]=$rowTrabajo;
            }
            new Historia_EDIT($valores,$trabajosTotales);
        }
        else{
            $HISTORIAS = get_data_form();
            $respuesta = $HISTORIAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    case 'SEARCH':
        if (!$_POST){
            new Historia_SEARCH();
        }
        else{
            $HISTORIAS = get_data_form();
            $datos = $HISTORIAS->SEARCH();
            $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
            new Historia_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    case 'SHOWCURRENT':
        $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
        $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
        $valores = $HISTORIAS->RellenaDatos();
        new Historia_SHOWCURRENT($lista, $valores);
        break;
    default:
        if (!$_POST){
            $HISTORIAS = new HISTORIA_Model('','','');
        }
        else{
            $HISTORIAS = get_data_form();
        }
        $datos = $HISTORIAS->SEARCH();
        $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
        new Historia_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');

}
?>
