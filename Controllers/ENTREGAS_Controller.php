<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Acciones.
06/12/2017 por IU SPARTANS
*/

    include_once '../Models/ENTREGAS_Model.php';
    include_once '../Models/USUARIOS_Model.php';
    include_once '../Models/TRABAJOS_Model.php';
    include_once '../Models/EVALUACIONES_Model.php';
    include_once '../Models/HISTORIA_Model.php';
    include '../Views/Entrega_VIEWS/Entrega_ADD.php';
    include '../Views/Entrega_VIEWS/Entrega_DELETE.php';
    include '../Views/Entrega_VIEWS/Entrega_EDIT.php';
    include '../Views/Entrega_VIEWS/Entrega_SEARCH.php';
    include '../Views/Entrega_VIEWS/Entrega_SHOWALL.php';
    include '../Views/Entrega_VIEWS/Entrega_SHOWCURRENT.php';
    include '../Views/Entrega_VIEWS/Entrega_CHECK_QA.php';
    include '../Views/MESSAGE_View.php';
    include '../Functions/upload.php';

//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
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
        $Alias,
        $Horas, 
        $Ruta
    );

    return $ENTREGAS;
}

//Si el formulario no ha devuelto una action la inicializamos vacía
function alias_gen(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randstring = '';
    for ($i = 0; $i < 6; $i++) {
        $randstring = $randstring . $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}

	//EN función de la action que llega del formulario ejecutamos una acción distinta
    Switch ($_REQUEST['action']){
    case 'ADD':
        //Si no hay post
        if (!$_POST){
            //Cogemos la lista de todos los trabajos y todos los usuarios y se los pasamos a la vista de add
            $TRABAJOS = new TRABAJOS_Model('', '', '', '','');    
            $trabajos = $TRABAJOS->SEARCH();
            
            $USUARIOS = new USUARIOS_Model('', '', '', '', '', '', '', '');    
            $usuarios = $USUARIOS->SEARCH();
            
            //Variables que recogerán las listas de trabajos y usuarios
            $lista_trabajos = [];
            $lista_usuarios = [];
            
            //Recorremos la lista de trabajos y la añadimos al array
            while($row = $trabajos->fetch_array()) {
                array_push($lista_trabajos, $row[0]);
            }
            //Recorremos la lista de usuarios y la añadimos al array
            while($row = $usuarios->fetch_array()) {
                array_push($lista_usuarios, $row[0]);
            }
            
            new Entrega_ADD($lista_usuarios, $lista_trabajos, alias_gen());
        }
        else{
            //Hacemos el upload de la entrega y guardamos el nombre en ruta
            $Ruta = upload_entrega($_REQUEST['Alias']);
            //Recogemos los datos, los añadimos y lanzamos la respuesta en una vista           
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $Ruta);
            $respuesta = $ENTREGAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Borramos una tupla
    case 'DELETE':
        //Si no hay post
        if (!$_POST){
            //Creamos una vista con los datos de la entrega
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
            $valores = $ENTREGAS->RellenaDatos();
            new Entrega_DELETE($lista, $valores);
        }
        else{
            //Cogemos la entrega y la borramos
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $respuesta = $ENTREGAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Editamos una tupla
    case 'EDIT':
        //Si no hay post
        if (!$_POST){
            //Rellenamos de datos la vista de edit y la mostramos
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $valores = $ENTREGAS->RellenaDatos();
            new Entrega_EDIT($valores);
        }
        else{
            //Cogemos el resultado del submit del formulario y editamos en el modelo
            $ENTREGAS = get_data_form();
            //Hacemos el upload de entrega y guardamos el nombre en Ruta
            $Ruta = upload_entrega($_REQUEST['Alias']);
            //Si no se ha hecho una entrega mantenemos la ruta anterior, si no almacenamos la nueva
            if($Ruta == ''){    
                $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $_REQUEST['RutaOriginal']);    
            } else {
                $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $Ruta);                
            }		
            $respuesta = $ENTREGAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    //Buscamos una tupla o un conjunto de tuplas
    case 'SEARCH':
        //Si no hay post
        if (!$_POST){
            new Entrega_SEARCH();
        }
        else{
            //Recogemos los datos y lanzamos un showall con las entregas filtradas
            $ENTREGAS = get_data_form();
            $datos = $ENTREGAS->SEARCH();
            $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
            new Entrega_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    //Corregimos todas las qas de la entrega dentro de una misma vista
    case 'QACHECK':
         //Si no hay post
         if (!$_POST){
            $ENTREGAAEVALUAR= new EVALUACIONES_Model($_REQUEST['IdTrabajo'],'',$_REQUEST['Alias'],'','','', '','','');
            $datos= $ENTREGAAEVALUAR->SEARCH();
            $HISTORIAS= new HISTORIA_Model($_REQUEST['IdTrabajo'],'','');
            $datosHistorias= $HISTORIAS->SEARCH();
            $arrayDescripciones= array();
             while($rowHistoria = $datosHistorias->fetch_array()){
                 $arrayDescripciones[]=$rowHistoria[2];
             }
            new Correccion_Conjunta_QAS($_REQUEST['IdTrabajo'],$_REQUEST['Alias'],$datos,$arrayDescripciones,'../Controllers/Index_Controller.php');
        }
        else{
            $ENTREGAAEVALUAR= new EVALUACIONES_Model($_REQUEST['IdTrabajo'],'',$_REQUEST['Alias'],'','','', '','','');
            $ENTREGAAEVALUAR= $ENTREGAAEVALUAR->SEARCH();
            foreach($ENTREGAAEVALUAR->fetch_array() as $rowEvaluacion){
                $ok= $_REQUEST($rowEvaluacion[3]."_".$rowEvaluacion[1]);
                $EVALUACION= new EVALUACIONES_Model($rowEvaluacion[0],$rowEvaluacion[1],$rowEvaluacion[2],$rowEvaluacion[3],$rowEvaluacion[4],$rowEvaluacion[5],$rowEvaluacion[6],$rowEvaluacion[7],$ok);
                $respuesta= $EVALUACION->EDIT();
            }
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    //Mostramos en detalle una tupla
    case 'SHOWCURRENT':
        $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
        $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
        $valores = $ENTREGAS->RellenaDatos();
        new Entrega_SHOWCURRENT($lista, $valores);
        break;
    //Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
    default:
        //Si no hay post
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
