<?php
    include '../Models/NOTAS_Model.php';
    include '../Views/Notas_VIEWS/Notas_ADD.php';
    include '../Views/Notas_VIEWS/Notas_DELETE.php';
    include '../Views/Notas_VIEWS/Notas_EDIT.php';
    include '../Views/Notas_VIEWS/Notas_SEARCH.php';
    include '../Views/Notas_VIEWS/Notas_SHOWALL.php';
    include '../Views/Notas_VIEWS/Notas_SHOWCURRENT.php';

function get_data_form(){
    $login = $_REQUEST['login'];
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $NotaTrabajo = $_REQUEST['NotaTrabajo'];
    $action = $_REQUEST['action'];

    $NOTAS = new HISTORIA_Model(
        $login,
        $IdTrabajo,
        $NotaTrabajo
    );

    return $NOTAS;
}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}


Switch ($_REQUEST['action']){
    case 'ADD':
        if (!$_POST){
            new Nota_ADD();
        }
        else{
            $NOTAS = get_data_form();
            $respuesta = $NOTAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'DELETE':
        if (!$_POST){
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
            $valores = $NOTAS->RellenaDatos();
            new Nota_DELETE($lista, $valores);
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
            new Nota_EDIT($valores);
        }
        else{
            $NOTAS = get_data_form();
            $respuesta = $NOTAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    case 'SEARCH':
        if (!$_POST){
            new Nota_SEARCH();
        }
        else{
            $NOTAS = get_data_form();
            $datos = $NOTAS->SEARCH();
            $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
            new Nota_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    case 'SHOWCURRENT':
        $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
        $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
        $valores = $NOTAS->RellenaDatos();
        new Nota_SHOWCURRENT($lista, $valores);
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
        new Nota_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');

}
?>
