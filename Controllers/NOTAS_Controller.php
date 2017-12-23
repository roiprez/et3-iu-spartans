<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de notas.
08/12/2017 por IU SPARTANS
*/

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

//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
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

//Devuelve una instancia del modelo con parte de los objetos recibidos del formulario como parámetros
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
            new Nota_Trabajo_ADD();
        }
        else{		
            //Recogemos los datos que devuelve el formulario y creamos una nueva historia
            $NOTAS = get_data_form();
            $respuesta = $NOTAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
    break;
    //Borramos una tupla
    case 'DELETE':
        //Si no hay post
        if (!$_POST){
            //Creamos una vista con los datos de la nota
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
            $valores = $NOTAS->RellenaDatos();
            new Nota_Trabajo_DELETE($lista, $valores);
        }
        else{
            //Cogemos la nota y la borramos
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $respuesta = $NOTAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Editamos una tupla
    case 'EDIT':
        //Si no hay post
        if (!$_POST){
            //Rellenamos de datos la vista de edit y la mostramos
            $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
            $valores = $NOTAS->RellenaDatos();
            new Nota_Trabajo_EDIT($valores);
        }
        else{
            //Cogemos el resultado del submit del formulario y editamos en el modelo
            $NOTAS = get_data_form();
            $respuesta = $NOTAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    case 'SEARCH':
        //Si no hay post
        if (!$_POST){
            new Nota_Trabajo_SEARCH();
        }
        else{
            //Recogemos los datos y lanzamos un showall con las notas filtradas
            $NOTAS = get_data_form();
            $datos = $NOTAS->SEARCH();
            $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
            new Nota_Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    //Mostramos en detalle una tupla
    case 'SHOWCURRENT':
        $NOTAS = new NOTAS_Model($_REQUEST['login'], $_REQUEST['IdTrabajo'], '');
        $lista = array('login', 'IdTrabajo', 'NotaTrabajo');
        $valores = $NOTAS->RellenaDatos();
        new Nota_Trabajo_SHOWCURRENT($lista, $valores);
        break;       
    //Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
    default:
        //Si no hay post
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
