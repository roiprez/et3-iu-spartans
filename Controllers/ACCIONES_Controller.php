<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Acciones.
02/12/2017 por IU SPARTANS
*/

include '../Models/ACCIONES_Model.php';
include_once '../Models/FUNCIONALIDADES_Model.php';
include '../Views/Accion_VIEWS/Accion_SHOWALL.php';
include '../Views/Accion_VIEWS/Accion_SEARCH.php';
include '../Views/Accion_VIEWS/Accion_ADD.php';
include '../Views/Accion_VIEWS/Accion_EDIT.php';
include '../Views/Accion_VIEWS/Accion_DELETE.php';
include '../Views/Accion_VIEWS/Accion_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';



//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
function get_data_form(){
	$IdAccion = $_REQUEST['IdAccion'];
	$NombreAccion = $_REQUEST['NombreAccion'];
	$DescripAccion = $_REQUEST['DescripAccion']   ;
	$action = $_REQUEST['action'];

	$ACCIONES = new ACCIONES_Model(
		$IdAccion,
		$NombreAccion,
		$DescripAccion
		);

	return $ACCIONES;
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
				new Accion_ADD();
			}
			else{	
				//Recogemos los datos, los añadimos y lanzamos la respuesta en una vista
				$ACCIONES = get_data_form();
				$respuesta = $ACCIONES->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Borramos una tupla
		case 'DELETE':
			//Si no hay post
			if (!$_POST){
				//Creamos una vista con los datos de la accion
        $ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
        $lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
				$valores = $ACCIONES->RellenaDatos();
				new Accion_DELETE($lista, $valores);
			}
			else{
				//Cogemos la accion y la borramos
				$ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
				$respuesta = $ACCIONES->DELETE();
				//Cogemos todas las FUNC_ACCION que tienen ese IdAccion
				$FUNCACCION= new FUNC_ACCION_Model('',$_REQUEST['IdAccion']);
				$datos= $FUNCACCION->SEARCH();

				//Recorremos el resultado del search anterior y vamos borrando cada tupla
				while($rowFuncAccion= $datos->fetch_array()){
						$FUNCACCION= new FUNC_ACCION_Model($rowFuncAccion[0],$rowFuncAccion[1]);
						$FUNCACCION->DELETE();
						//Buscamos los permisos que coincidan con el Func_Accion
						$PERMISO= new PERMISOS_Model('',$rowFuncAccion[0],$rowFuncAccion[1]);
						$datosPermisos= $PERMISO->SEARCH();
						//Borramos todas las tuplas de la búsqueda anteriro
						while($rowPermiso= $datosPermisos->fetch_array()){
								$PERMISO= new PERMISOS_Model($rowPermiso[0],$rowPermiso[1],$rowPermiso[2]);
								$PERMISO->DELETE();
						}
				}

				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Editamos una tupla
		case 'EDIT':		
			//Si no hay post
			if (!$_POST){	
				//Rellenamos de datos la vista de edit y la mostramos
        $ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
				$valores = $ACCIONES->RellenaDatos();
				new Accion_EDIT($valores);
			}
			else{	
				//Cogemos el resultado del submit del formulario y editamos en el modelo
				$ACCIONES = get_data_form();						
				$respuesta = $ACCIONES->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		//Buscamos una tupla o un conjunto de tuplas
		case 'SEARCH':
			//Si no hay post
			if (!$_POST){
				//Lanza la vista de search
				new Accion_SEARCH();
			}
			else{
				//Recogemos los datos y lanzamos un showall con las acciones filtradas
				$ACCIONES = get_data_form();
				$datos = $ACCIONES->SEARCH();
				$lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
				new Accion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		//Mostramos en detalle una tupla
		case 'SHOWCURRENT':
      $ACCIONES = new ACCIONES_Model($_REQUEST['IdAccion'], '', '');
      $lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
			$valores = $ACCIONES->RellenaDatos();
			new Accion_SHOWCURRENT($lista, $valores);
			break;
		//Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
		default:
			//Si no hay post
			if (!$_POST){
				$ACCIONES = new ACCIONES_Model('','','');
			}
			else{
				$ACCIONES = get_data_form();
			}
			$datos = $ACCIONES->SEARCH();
			$lista = array('IdAccion', 'NombreAccion', 'DescripAccion');
			new Accion_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>