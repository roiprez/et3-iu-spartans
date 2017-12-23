<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Trabajos.
02/12/2017 por IU SPARTANS
*/

include '../Views/Trabajo_VIEWS/Trabajo_SHOWALL.php';
include '../Views/Trabajo_VIEWS/Trabajo_SEARCH.php';
include '../Views/Trabajo_VIEWS/Trabajo_ADD.php';
include '../Views/Trabajo_VIEWS/Trabajo_EDIT.php';
include '../Views/Trabajo_VIEWS/Trabajo_DELETE.php';
include '../Views/Trabajo_VIEWS/Trabajo_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';


//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
function get_data_form(){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	$FechaIniTrabajo = $_REQUEST['FechaIniTrabajo'];
	$FechaFinTrabajo = $_REQUEST['FechaFinTrabajo'];
	$PorcentajeNota = $_REQUEST['PorcentajeNota'];
	$action = $_REQUEST['action'];

	$TRABAJO = new TRABAJOS_Model(
		$IdTrabajo,
		$NombreTrabajo,
		$FechaIniTrabajo,
		$FechaFinTrabajo,
		$PorcentajeNota
		);

	return $TRABAJO;
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
				new Trabajo_ADD();
			}
			else{		
				//Recogemos los datos, los añadimos y lanzamos la respuesta en una vista
				$TRABAJO = get_data_form();
				$respuesta = $TRABAJO->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Borramos una tupla
		case 'DELETE':
			//Si no hay post
			if (!$_POST){
				//Creamos una vista con los datos del trabajo
        $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
        $lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
				$valores = $TRABAJO->RellenaDatos();
				new Trabajo_DELETE($lista, $valores);
			}
			else{
				//Cogemos el trabajo y lo borramos
				$TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
				$respuesta = $TRABAJO->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Editamos una tupla
		case 'EDIT':		
			//Si no hay post
			if (!$_POST){	
				//Rellenamos de datos la vista de edit y la mostramos
        $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
				$valores = $TRABAJO->RellenaDatos();
				new Trabajo_EDIT($valores);
			}
			else{	
				//Cogemos el resultado del submit del formulario y editamos en el modelo
				$TRABAJO = get_data_form();						
				$respuesta = $TRABAJO->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		//Buscamos una tupla o un conjunto de tuplas
		case 'SEARCH':
			//Si no hay post
			if (!$_POST){
				//Lanza la vista de search
				new Trabajo_SEARCH();
			}
			else{
				//Recogemos los datos y lanzamos un showall con las tuplas filtradas
				$TRABAJO = get_data_form();
				$datos = $TRABAJO->SEARCH();
				$lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
				new Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		//Mostramos en detalle una tupla
		case 'SHOWCURRENT':
      $TRABAJO = new TRABAJOS_Model($_REQUEST['IdTrabajo'], '', '','','');
      $lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
			$valores = $TRABAJO->RellenaDatos();
			new Trabajo_SHOWCURRENT($lista, $valores);
			break;
		//Generamos una asignación
		case 'GENERAR_ASIG':
			//Llamamos a la función qa_gen y mostramos la respuesta
			$respuesta = qa_gen($_REQUEST['IdTrabajo']);
			new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			break;
		//Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
		default:
			//Si no hay post
			if (!$_POST){
				$TRABAJO = new TRABAJOS_Model('','','','','');
			}
			else{
				$TRABAJO = get_data_form();
			}
			$datos = $TRABAJO->SEARCH();
			$lista = array('IdTrabajo', 'NombreTrabajo', 'FechaIniTrabajo','FechaFinTrabajo','PorcentajeNota');
			new Trabajo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>