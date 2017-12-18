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

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Funcionalidad_ADD();
			}
			else{		
				$FUNCIONALIDADES = get_data_form();
				$respuesta = $FUNCIONALIDADES->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
        $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
        $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
				$valores = $FUNCIONALIDADES->RellenaDatos();
				new Funcionalidad_DELETE($lista, $valores);
			}
			else{
				$FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
				$respuesta = $FUNCIONALIDADES->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
        $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
				$valores = $FUNCIONALIDADES->RellenaDatos();
				new Funcionalidad_EDIT($valores);
			}
			else{	
				$FUNCIONALIDADES = get_data_form();						
				$respuesta = $FUNCIONALIDADES->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new Funcionalidad_SEARCH();
			}
			else{
				$FUNCIONALIDADES = get_data_form();
				$datos = $FUNCIONALIDADES->SEARCH();
				$lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
				new Funcionalidad_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
      $FUNCIONALIDADES = new FUNCIONALIDADES_Model($_REQUEST['IdFuncionalidad'], '', '');
      $lista = array('IdFuncionalidad', 'NombreFuncionalidad', 'DescripFuncionalidad');
			$valores = $FUNCIONALIDADES->RellenaDatos();
			new Funcionalidad_SHOWCURRENT($lista, $valores);
			break;
		case 'ADDACTION' :
			if(!$_POST){ 
				$ACCIONES = new ACCIONES_Model('','','');
				$acciones = $ACCIONES->SEARCH();

				$lista_acciones = [];
				$lista_funcionalidades_accion = [];

				while($row = $acciones->fetch_array()) {
					array_push($lista_acciones, $row[0]);
					$contained = false;
					$FUNC_ACCION = new FUNC_ACCION_Model($_REQUEST['IdFuncionalidad'],''); 
					$datos_func_accion = $FUNC_ACCION->SEARCH();
					while($row_action = $datos_func_accion->fetch_array()) {
						if($row_action[1] == $row[0]){
							$contained = true;
						}			
					}
					array_push($lista_funcionalidades_accion, $contained);
				}
				new Fun_Accion_GESTION($lista_acciones,$_REQUEST['IdFuncionalidad'],$lista_funcionalidades_accion);
			}
			else{//Si se ha hehco un post	
				$funcionalidad = $_REQUEST['IdFuncionalidad'];
				
				$ACCIONES = new ACCIONES_Model('','','');
				$acciones = $ACCIONES->SEARCH();

				$lista_acciones = [];

				while($row = $acciones->fetch_array()) {
					array_push($lista_acciones, $row[0]);
				}

				foreach ($lista_acciones as $accion){ 
					$FUNC_ACCION= new FUNC_ACCION_Model($funcionalidad,$accion);
					$FUNC_ACCION->reventarFuncionalidad();
				}
				
				if(isset($_REQUEST['IdAccion'])){
					$acciones = $_REQUEST['IdAccion'];
					
					foreach ($acciones as $accion){ 
						$FUNC_ACCION= new FUNC_ACCION_Model($funcionalidad,$accion);
						$FUNC_ACCION->ADD();
					}
				}
				new Vista_MESSAGE("Se han registrado sus cambios", '../Controllers/Index_Controller.php');		
			}
			break;
		default:
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