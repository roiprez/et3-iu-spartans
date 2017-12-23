<?php
/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Permisos.
03/12/2017 por IU SPARTANS
*/

    include_once '../Models/GRUPOS_Model.php';
    include_once '../Models/FUNCIONALIDADES_Model.php';
    include_once '../Models/ACCIONES_Model.php';
    include '../Views/Permiso_VIEWS/Permiso_SHOWALL.php';
    include '../Views/Permiso_VIEWS/Permiso_SEARCH.php';

//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
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
//Si el formulario no ha devuelto una action la inicializamos vacía
if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}

	//EN función de la action que llega del formulario ejecutamos una acción distinta
    Switch ($_REQUEST['action']){
    //Buscamos una tupla o un conjunto de tuplas
    case 'SEARCH':
        //Si no hay post
        if (!$_POST){
            //Cogemos la lista de todos los grupos, funcionalidades y acciones
            $IDGRUPOS= new GRUPOS_Model('','','');
            $IdFUNCIONALIDADES= new FUNCIONALIDADES_MODEL('','','');
            $IDACCIONES= new ACCIONES_Model('','','');
            $datosGrupos= $IDGRUPOS->SEARCH();
            $datosFuncionalidades= $IdFUNCIONALIDADES->SEARCH();
            $datosAcciones= $IDACCIONES->SEARCH();
            //Llamamos a la vista de search
            new Permiso_SEARCH($datosGrupos,$datosFuncionalidades,$datosAcciones);
        }
        else{
            //Recogemos los datos y lanzamos un showall con los permisos filtrados
            $PERMISOS = get_data_form();
            $datos = $PERMISOS->SEARCH();
            $lista = array('IdGrupo', 'IdFuncionalidad', 'IdAccion');
            new Permiso_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    //Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
    default:
        //Si no hay post
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