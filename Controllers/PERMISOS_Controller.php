<?php
    include '../Models/PERMISOS_Model.php';
    include_once '../Models/GRUPOS_Model.php';
    include_once '../Models/FUNCIONALIDADES_Model.php';
    include_once '../Models/ACCIONES_Model.php';
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
            $IDGRUPOS= new GRUPOS_Model('','','');
            $IdFUNCIONALIDADES= new FUNCIONALIDADES_MODEL('','','');
            $IDACCIONES= new ACCIONES_Model('','','');

            $datosGrupos= $IDGRUPOS->SEARCH();
            $datosFuncionalidades= $IdFUNCIONALIDADES->SEARCH();
            $datosAcciones= $IDACCIONES->SEARCH();
            new Permiso_SEARCH($datosGrupos,$datosFuncionalidades,$datosAcciones);
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