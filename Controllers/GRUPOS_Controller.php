<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
25/11/2017
*/

include_once '../Models/GRUPOS_Model.php';
include '../Models/FUNCIONALIDADES_Model.php';
include '../Models/ACCIONES_Model.php';
include '../Models/PERMISOS_Model.php';
include '../Views/Grupo_VIEWS/Grupo_SHOWALL.php';
include '../Views/Grupo_VIEWS/Grupo_SEARCH.php';
include '../Views/Grupo_VIEWS/Grupo_ADD.php';
include '../Views/Grupo_VIEWS/Grupo_EDIT.php';
include '../Views/Grupo_VIEWS/Grupo_DELETE.php';
include '../Views/Grupo_VIEWS/Grupo_SHOWCURRENT.php';
include '../Views/Permiso_VIEWS/Permiso_GESTION.php';
include '../Views/MESSAGE_View.php';




function get_data_form(){
	$IdGrupo = $_REQUEST['IdGrupo'];
	$NombreGrupo = $_REQUEST['NombreGrupo'];
	$DescripGrupo = $_REQUEST['DescripGrupo'];
	$action = $_REQUEST['action'];

	$GRUPOS = new GRUPOS_Model(
		$IdGrupo,
		$NombreGrupo,
		$DescripGrupo
		);

	return $GRUPOS;
}

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Grupo_ADD();
			}
			else{		
				$GRUPOS = get_data_form();
				$respuesta = $GRUPOS->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
        $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
        $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				$valores = $GRUPOS->RellenaDatos();
				new Grupo_DELETE($lista, $valores);
			}
			else{
				$GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
				$respuesta = $GRUPOS->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
        $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
				$valores = $GRUPOS->RellenaDatos();
				new Grupo_EDIT($valores);
			}
			else{	
				$GRUPOS = get_data_form();						
				$respuesta = $GRUPOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){
				new Grupo_SEARCH();
			}
			else{
				$GRUPOS = get_data_form();
				$datos = $GRUPOS->SEARCH();
				$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				new Grupo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
        case 'ADDPERMISO':
            if(!$_POST){ //Si no hay informacion
                $GRUPOS =new GRUPOS_Model($_REQUEST['IdGrupo'],'',''); //Nuevo modelo de grupo
                $datosGru = $GRUPOS->SEARCH(); //Devuelve la tupla del grupo

                $FUNC_ACCION = new FUNC_ACCION_Model('','');//Nuevo modelo de Func_Accion
                $datosFuncAccion = $FUNC_ACCION->SEARCH(); //Devuelve la tabla Func_Accion
                $funcAccion= array();//Array que contendrá todas las relaciones entre Funcionalidades y Acciones, ademas de sus nombres
                $i=0;
                while($rowFuncAcc = $datosFuncAccion->fetch_array()){

                    $nombreFunc= new FUNCIONALIDADES_MODEL($rowFuncAcc[0],'','');
                    $nombreFunc= $nombreFunc->SEARCH();
                    $nombreFunc= $nombreFunc->fetch_array();
                    $nombreFunc= $nombreFunc[1];

                    $nombreAcci= new ACCIONES_Model($rowFuncAcc[1],'','');
                    $nombreAcci= $nombreAcci->SEARCH();
                    $nombreAcci= $nombreAcci->fetch_array();
                    $nombreAcci= $nombreAcci[1];
                    $funcAccion[$i][0]=$rowFuncAcc[0];
                    $funcAccion[$i][1]=$rowFuncAcc[1];
                    $funcAccion[$i][2]=$nombreFunc;
                    $funcAccion[$i][3]=$nombreAcci;
                    $i++;
                }

                $PERMISO =new PERMISOS_Model($_REQUEST['IdGrupo'],'',''); // Nuevo modelo de PERMISO
                $datosPermiso = $PERMISO->SEARCH(); //Devolverá las tuplas de los permisos para ese grupo, si los hay
                $permisosYaAsignados= array();//Array que contendrá todas las relaciones entre Funcionalidades y Acciones, ademas de sus nombres,
                                     // para los permisos ya asignados al grupo
                $i=0;
                while($rowPermiso = $datosPermiso->fetch_array()){
                    $nombreFunc= new FUNCIONALIDADES_MODEL($rowPermiso[0],'','');
                    $nombreFunc= $nombreFunc->SEARCH();
                    $nombreFunc= $nombreFunc[0];

                    $nombreAcci= new ACCIONES_Model($rowPermiso[1],'','');
                    $nombreAcci= $nombreAcci->SEARCH();
                    $nombreAcci= $nombreAcci[0];

                    $permisosYaAsignados[$i][0]=$rowPermiso[0];
                    $permisosYaAsignados[$i][1]=$rowPermiso[1];
                    $permisosYaAsignados[$i][2]=$nombreFunc;
                    $permisosYaAsignados[$i][3]=$nombreAcci;
                    $i++;
                }
                new Permiso_GESTION($datosGru,$funcAccion,$permisosYaAsignados); //Muestra la vista de USU_GRUPO
            }
            else{//Si se ha hecho un post
                $idGrupo=$_REQUEST['IdGrupo']; //Definimos idGrupo para poder utilizarlo tantas veces como select se hayan seleccionado
                $PERMISOS_PREVIO= new PERMISOS_Model($idGrupo,'',''); //Definimos un modelo de USU_GRUPO con el login que se nos pasa para borrar todos los grupos que tenia seleccionados de antes
                echo 'hello';
                $borrado=$PERMISOS_PREVIO->reventarPermiso(); //Se revientan todos los grupos a los que pertenece el usuario
                echo 'bye';
                if ($_REQUEST['permiso']!=''){ // Si se ha seleccionado algun grupo
                    foreach ($_REQUEST['permiso'] as  $valorPermiso){ //Recorremos todos los seleccionados
                        $temp= explode(',',$valorPermiso);
                        $PERMISO= new PERMISOS_Model($idGrupo,$temp[0],$temp[1]);
                        $respuesta=$PERMISO->ADD(); // Añadimos uno por uno a la tabla
                    }
                    new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
                    break; //Rompemos para que no continue
                }else{ //Si no se ha seleccionado ninguno
                    new Vista_MESSAGE('Inserción realizada con éxito', '../Controllers/Index_Controller.php'); //Mostramos mensaje de exito en la inserción porque ya se han borrado previamente
                }
            }
            break;
		case 'SHOWCURRENT':
      $GRUPOS = new GRUPOS_Model($_REQUEST['IdGrupo'], '', '');
      $lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
			$valores = $GRUPOS->RellenaDatos();
			new Grupo_SHOWCURRENT($lista, $valores);
			break;
		default:
			if (!$_POST){
				$GRUPOS = new GRUPOS_Model('','','');
			}
			else{
				$GRUPOS = get_data_form();
			}
			$datos = $GRUPOS->SEARCH();
			$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
			new Grupo_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>