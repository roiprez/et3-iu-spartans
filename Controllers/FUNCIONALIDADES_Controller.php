<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
01/12/2017
*/

include '../Models/ACCIONES_Model.php';
include '../Models/FUNCIONALIDADES_Model.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_SHOWALL.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_SEARCH.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_ADD.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_EDIT.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_DELETE.php';
include '../Views/Funcionalidad_VIEWS/Funcionalidad_SHOWCURRENT.php';
include '../Views/Fun_Accion_VIEWS/Fun_Accion_GESTION.php';
include '../Views/MESSAGE_View.php';


//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
function get_data_form(){
	$IdFuncionalidad = $_REQUEST['IdFuncionalidad'];
	$NombreFuncionalidad = $_REQUEST['NombreFuncionalidad'];
	$DescripFuncionalidad = $_REQUEST['DescripFuncionalidad'];
	$action = $_REQUEST['action'];

	$FUNCIONALIDADES = new FUNCIONALIDADES_Model(
		$IdFuncionalidad,
		$NombreFuncionalidad,
		$DescripFuncionalidad
		);

	return $FUNCIONALIDADES;
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
				new Funcionalidad_ADD();
			}
			else{		
				//Recogemos los datos, los añadimos y lanzamos la respuesta en una vista
				$FUNCIONALIDADES = get_data_form();
				$respuesta = $FUNCIONALIDADES->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			//Si no hay post
			if (!$_POST){
				//Creamos una vista con los datos de la funcionalidad
        $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
        $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
				$valores = $FUNCIONALIDADES->RellenaDatos();
				new Funcionalidad_DELETE($lista, $valores);
			}
			else{
				//Cogemos la funcionalidad y la borramos
				$FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
				$respuesta = $FUNCIONALIDADES->DELETE();
				//Cogemos las Func_Accion en las que está esa funcionalidad 
				$FUNCACCION= new FUNC_ACCION_Model($_REQUEST['IdFuncionalidad'],'');
				$datos= $FUNCACCION->SEARCH();
				//Recorremos todas las tuplas y vamos borrando las func_accion que contengan la funcionaldiad
				while($rowFuncAccion= $datos->fetch_array()){
						$FUNCACCION= new FUNC_ACCION_Model($rowFuncAccion[0],$rowFuncAccion[1]);
						$FUNCACCION->DELETE();
						//Cogemos los permisos que contengan esa func_accion
						$PERMISO= new PERMISOS_Model('',$rowFuncAccion[0],$rowFuncAccion[1]);
						$datosPermisos= $PERMISO->SEARCH();
						//Borramos los permisos que contienen esa func_accion
						while($rowPermiso=$datosPermisos->fetch_array()){
								$PERMISO= new PERMISOS_Model($rowPermiso[0],$rowPermiso[1],$rowPermiso[2]);
								$PERMISO->DELETE();
						}
				}
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			//Si no hay post
			if (!$_POST){	
				//Rellenamos de datos la vista de edit y la mostramos
				$FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
				$valores = $FUNCIONALIDADES->RellenaDatos();
				new Funcionalidad_EDIT($valores);
			}
			//Cogemos el resultado del submit del formulario y editamos en el modelo
			else{	
				$FUNCIONALIDADES = get_data_form();						
				$respuesta = $FUNCIONALIDADES->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		//Buscamos una tupla o un conjunto de tuplas
		case 'SEARCH':
			//Si no hay post
			if (!$_POST){
				//Lanza la vista de search
				new Funcionalidad_SEARCH();
			}
			else{
				//Recogemos los datos y lanzamos un showall con las tuplas filtradas
				$FUNCIONALIDADES = get_data_form();
				$datos = $FUNCIONALIDADES->SEARCH();
				$lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
				new Funcionalidad_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		//Mostramos en detalle una tupla
		case 'SHOWCURRENT':
      $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
      $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
			$valores = $FUNCIONALIDADES->RellenaDatos();
			new Funcionalidad_SHOWCURRENT($lista, $valores);
			break;
		//Añadimos acciones a funcionalidades
		case 'ADDACTION' :
			//Si no hay post
			if(!$_POST){
				//Cogemos todas las funciones de la aplicación
				$ACCIONES = new ACCIONES_Model('','','');
				$acciones = $ACCIONES->SEARCH();

				//Creamos listas que recogen las acciones, sus nombres y la lista de funcionalidades accion
				$lista_acciones = [];
				$lista_nombre_acciones = [];
				$lista_funcionalidades_accion = [];

				//Mientras hay acciones introducimos en los arrays el contenido correspondiente
				while($row = $acciones->fetch_array()) {
					array_push($lista_acciones, $row[0]);
					array_push($lista_nombre_acciones, $row[1]);
					//contained indica si la accion está asociada a la funcionalidad
					$contained = false;
					//Cogemos las func_accion que estén asociadas a esa funcionalidad
					$FUNC_ACCION = new FUNC_ACCION_Model($_REQUEST['IdFuncionalidad'],''); 
					$datos_func_accion = $FUNC_ACCION->SEARCH();
					//Si la funcionalidad está asignada a la accion contained será true, e introducimos ese valor en el array
					while($row_action = $datos_func_accion->fetch_array()) {
						if($row_action[1] == $row[0]){
							$contained = true;
						}			
					}
					array_push($lista_funcionalidades_accion, $contained);
				}
				//Lanzamos la vista de gestion de func_accion con la lista de acciones, sus nombres, el id de la funcionalidad y su noombre y la lista de los contained
				new Fun_Accion_GESTION($lista_acciones,$lista_nombre_acciones,$_REQUEST['IdFuncionalidad'], $_REQUEST['NombreFuncionalidad'],$lista_funcionalidades_accion);
			}
			else{//Si se ha hehco un post	
				//asignamos a funcionalidad el IdFuncionalidad del formulario
				$funcionalidad = $_REQUEST['IdFuncionalidad'];
				
				//Cogemos todas las acciones en una lista
				$ACCIONES = new ACCIONES_Model('','','');
				$acciones = $ACCIONES->SEARCH();

				//Guardamos las acciones en esta lista
				$lista_acciones = [];

				//recorremos las acciones y las metemos en el array
				while($row = $acciones->fetch_array()) {
					array_push($lista_acciones, $row[0]);
				}

				//por cada accion, borramos las func_Accion que la contienen
				foreach ($lista_acciones as $accion){ 
					$FUNC_ACCION= new FUNC_ACCION_Model($funcionalidad,$accion);
					$FUNC_ACCION->reventarFuncionalidad();
				}
				
				//Si IdAccion está lo asignamos a la variable (array)
				if(isset($_REQUEST['IdAccion'])){
					$acciones = $_REQUEST['IdAccion'];
					//por cada accion creamos una funcionalidad accion
					foreach ($acciones as $accion){ 
						$FUNC_ACCION= new FUNC_ACCION_Model($funcionalidad,$accion);
						$FUNC_ACCION->ADD();
					}
				}
				new Vista_MESSAGE("Se han registrado sus cambios", '../Controllers/Index_Controller.php');		
			}
			break;
		//Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
		default:
			//Si no hay post
			if (!$_POST){
				$FUNCIONALIDADES = new FUNCIONALIDADES_Model('','','');
			}
			else{
				$FUNCIONALIDADES = get_data_form();
			}
			$datos = $FUNCIONALIDADES->SEARCH();
			$lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
			new Funcionalidad_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>