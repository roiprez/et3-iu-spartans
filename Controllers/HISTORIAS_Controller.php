<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Historias.
02/12/2017 por IU SPARTANS
*/

    include_once '../Models/HISTORIA_Model.php';
    include '../Views/MESSAGE_View.php';
    include '../Views/Historia_VIEWS/Historia_ADD.php';
    include '../Views/Historia_VIEWS/Historia_DELETE.php';
    include '../Views/Historia_VIEWS/Historia_EDIT.php';
    include '../Views/Historia_VIEWS/Historia_SEARCH.php';
    include '../Views/Historia_VIEWS/Historia_SHOWALL.php';
    include '../Views/Historia_VIEWS/Historia_SHOWCURRENT.php';

//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
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
            //Cogemos la lista de todos los trabajos
            $TRABAJOS=new TRABAJOS_Model('','','','','');//Nuevo modelo de Trabajo
            $datosTrabajos= $TRABAJOS->SEARCH();
            //Array que contendrá todos los trabajos
            $trabajosTotales = array();
            //recorremos todos los trabajos e introducimos el ID en el array
            while($rowTrabajo= $datosTrabajos->fetch_array()){
                $trabajosTotales[]=$rowTrabajo[0];
            }
            //Lanzamos la vista con los Id de trabajos
            new Historia_ADD($trabajosTotales);
        }
        else{
            //Recogemos los datos que devuelve el formulario y creamos una nueva historia
            $HISTORIAS = get_data_form();
            $respuesta = $HISTORIAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Borramos una tupla
    case 'DELETE':
        //Si no hay post
        if (!$_POST){
            //Creamos una vista con los datos de la historia
            $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
            $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
            $valores = $HISTORIAS->RellenaDatos();
            new Historia_DELETE($lista, $valores);
        }
        else{
            //Cogemos la historia y la borramos
            $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
            $respuesta = $HISTORIAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Editamos una tupla
    case 'EDIT':
        //Si no hay post
        if (!$_POST){
            //Rellenamos de datos la vista de edit y la mostramos
            $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
            $valores = $HISTORIAS->RellenaDatos();
            //Cogemos la lista de todos los trabajos
            $TRABAJOS=new TRABAJOS_Model('','','','','');//Nuevo modelo de Trabajo
            $datosTrabajos= $TRABAJOS->SEARCH();
            //Array que contendrá todos los trabajos
            $trabajosTotales = array();
            //recorremos todos los trabajos e introducimos el ID en el array
            while($rowTrabajo= $datosTrabajos->fetch_array()){
                $trabajosTotales[]=$rowTrabajo;
            }
            new Historia_EDIT($valores,$trabajosTotales);
        }
        else{
            //Cogemos el resultado del submit del formulario y editamos en el modelo
            $HISTORIAS = get_data_form();
            $respuesta = $HISTORIAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    //Buscamos una tupla o un conjunto de tuplas
    case 'SEARCH':
         //Si no hay post
         if (!$_POST){
            new Historia_SEARCH();
        }
        else{
            //Recogemos los datos y lanzamos un showall con las historias filtradas
            $HISTORIAS = get_data_form();
            $datos = $HISTORIAS->SEARCH();
            $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
            new Historia_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    //Mostramos en detalle una tupla
    case 'SHOWCURRENT':
        $HISTORIAS = new HISTORIA_Model($_REQUEST['IdTrabajo'], $_REQUEST['IdHistoria'], '');
        $lista = array('IdTrabajo', 'IdHistoria', 'TextoHistoria');
        $valores = $HISTORIAS->RellenaDatos();
        new Historia_SHOWCURRENT($lista, $valores);
        break;
    //Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
    default:
        //Si no hay post
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
