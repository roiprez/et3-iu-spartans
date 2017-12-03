<?php
    include '../Models/PERMISOS_Model.php';
    include '../Views/Permiso_VIEWS/Permiso_SHOWALL.php';
    include '../Views/Permiso_VIEWS/Permiso_SEARCH.php';

function get_data_form(){
    $IdGrupo = $_REQUEST['IdGrupo'];
    $IdFuncionalidad = $_REQUEST['IdFuncionalidad'];
    $IdAccion = $_REQUEST['IdAccion'];
    $action = $_REQUEST['action'];

    $PERMISOS = new GRUPOS_Model(
        $IdGrupo,
        $IdFuncionalidad,
        $IdAccion
    );

    return $PERMISOS;
}
if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}

Switch ($_REQUEST['action']){
    case 'SEARCH':
        if (!$_POST){
            new Permiso_SEARCH();
        }
        else{
            $PERMISOS = get_data_form();
            $datos = $PERMISOS->SEARCH();
            $lista = array('IdGrupo', 'IdFuncionalidad', 'IdAccion');
            new Permiso_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    default:
        if (!$_POST){
            $PERMISOS = new PERMISOS_Model('','','');
        }
        else{
            $PERMISOS = get_data_form();
        }
        $datos = $PERMISOS->SEARCH();
        $lista = array('IdGrupo', 'IdFuncionalidad', 'IdAccion');
        new Permiso_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        

}
?>