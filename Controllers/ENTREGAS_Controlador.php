<?php
    include '../Models/ENTREGAS_Model.php';
    include '../Views/Entrega_VIEWS/Entrega_ADD.php';
    include '../Views/Entrega_VIEWS/Entrega_DELETE.php';
    include '../Views/Entrega_VIEWS/Entrega_EDIT.php';
    include '../Views/Entrega_VIEWS/Entrega_SEARCH.php';
    include '../Views/Entrega_VIEWS/Entrega_SHOWALL.php';
    include '../Views/Entrega_VIEWS/Entrega_SHOWCURRENT.php';

function get_data_form(){
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $login = $_REQUEST['login'];
    $Alias = $_REQUEST['Alias'];
    $Horas = $_REQUEST['Horas'];
    $Ruta = $_REQUEST['Ruta'];
    $action = $_REQUEST['action'];

    $ENTREGAS = new ENTREGAS_Model(
        $IdTrabajo,
        $login,
        $Alias
  
    );

    return $ENTREGAS;
}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}


Switch ($_REQUEST['action']){
    case 'ADD':
        if (!$_POST){
            new Entrega_ADD();
        }
        else{
            $ENTREGAS = get_data_form();
            $respuesta = $ENTREGAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'DELETE':
        if (!$_POST){
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
            $valores = $ENTREGAS->RellenaDatos();
            new Entrega_DELETE($lista, $valores);
        }
        else{
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $respuesta = $ENTREGAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'EDIT':
        if (!$_POST){
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $valores = $ENTREGAS->RellenaDatos();
            new Entrega_EDIT($valores);
        }
        else{
            $ENTREGAS = get_data_form();
            $respuesta = $ENTREGAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    case 'SEARCH':
        if (!$_POST){
            new Entrega_SEARCH();
        }
        else{
            $ENTREGAS = get_data_form();
            $datos = $ENTREGAS->SEARCH();
            $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
            new Entrega_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    case 'SHOWCURRENT':
        $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
        $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
        $valores = $ENTREGAS->RellenaDatos();
        new Entrega_SHOWCURRENT($lista, $valores);
        break;
    default:
        if (!$_POST){
            $ENTREGAS = new ENTREGAS_Model('','','','','');
        }
        else{
            $ENTREGAS = get_data_form();
        }
        $datos = $ENTREGAS->SEARCH();
        $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
        new Entrega_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');

}
?>
