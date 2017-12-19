<?php
    include_once '../Models/NOTAS_Model.php';
    include_once '../Models/TRABAJOS_Model.php';
    include_once '../Models/ENTREGAS_Model.php';
    include_once '../Functions/Generacion_Notas.php';
    include '../Views/Nota_Trabajo_VIEWS/Nota_Trabajo_ADD.php';
    include '../Views/Nota_Trabajo_VIEWS/Nota_Trabajo_DELETE.php';
    include '../Views/Nota_Trabajo_VIEWS/Nota_Trabajo_EDIT.php';
    include '../Views/Nota_Trabajo_VIEWS/Nota_Trabajo_SEARCH.php';
    include '../Views/Nota_Trabajo_VIEWS/Nota_Trabajo_SHOWALL.php';
    include '../Views/Nota_Trabajo_VIEWS/Nota_Trabajo_SHOWCURRENT.php';
    include '../Views/MESSAGE_View.php';

function get_data_form(){
    $login = $_REQUEST['login'];
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $NotaTrabajo = $_REQUEST['NotaTrabajo'];
    $action = $_REQUEST['action'];

    $NOTAS = new NOTAS_Model(
        $login,
        $IdTrabajo,
        $NotaTrabajo
    );

    return $NOTAS;
}

function get_data_form2(){

    $login = $_REQUEST['login'];
    $IdTrabajo = $_REQUEST['IdTrabajo']; 

    $ruta = '';
    $horas = '';
    $alias = '';

     $ENTREGA = new ENTREGA_Model(
        $IdTrabajo,
        $login,
        $alias,
        $horas,
        $ruta
    );

     return $ENTREGA;

}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}


Switch ($_REQUEST['action']){
    case 'ADD':
        $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'],'','','','');
        $trabajo = $TRABAJO->SEARCH()->fetch_array();
        $valores = $NOTAS->RellenaDatos();
        $ENTREGA = get_data_form2();
        $valorentrega = $ENTREGA->SEARCH();
        $alias_v = $valorentrega->fetch_array();
        $NOTAS = get_data_form();
        $NOTAS['NotaTrabajo'] = generarNotasEntrega($IdTrabajo,$alias_v[2],$trabajo[4]);
        $respuesta = $NOTAS->ADD();
        new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        
        break;
    case 'DELETE':
        if (!$_POST){
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
            $valores = $NOTAS->RellenaDatos();
            new Nota_Trabajo_DELETE($lista, $valores);
        }
        else{
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $respuesta = $NOTAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'EDIT':
        if (!$_POST){
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $valores = $NOTAS->RellenaDatos();
            new Nota_Trabajo_EDIT($valores);
        }
        else{
            $NOTAS = get_data_form();
            $respuesta = $NOTAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    case 'SEARCH':
        if (!$_POST){
            new Nota_Trabajo_SEARCH();
        }
        else{
            $NOTAS = get_data_form();
            $datos = $NOTAS->SEARCH();
            $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
            new Nota_Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    case 'SHOWCURRENT':
        $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
        $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
        $valores = $NOTAS->RellenaDatos();
        new Nota_Trabajo_SHOWCURRENT($lista, $valores);
        break;
    default:
        if (!$_POST){
            $NOTAS = new NOTAS_Model('','','');
        }
        else{
            $NOTAS = get_data_form();
        }
        $datos = $NOTAS->SEARCH();
        $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
        new Nota_Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');

}
?>
