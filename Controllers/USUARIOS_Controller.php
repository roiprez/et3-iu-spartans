<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo.
20/10/2017 por s84f46
*/

include '../Models/USUARIOS_Model.php';
include '../Views/Usuario_VIEWS/Usuario_SHOWALL.php';
include '../Views/Usuario_VIEWS/Usuario_SEARCH.php';
include '../Views/Usuario_VIEWS/Usuario_ADD.php';
include '../Views/Usuario_VIEWS/Usuario_EDIT.php';
include '../Views/Usuario_VIEWS/Usuario_DELETE.php';
include '../Views/Usuario_VIEWS/Usuario_SHOWCURRENT.php';
include '../Views/MESSAGE_View.php';
include '../Views/Usu_Grupo_VIEWS/Usu_Grupo_ADD.php';
include '../Models/GRUPOS_Model.php';




function get_data_form(){
	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$DNI = $_REQUEST['DNI'];
	$Nombre = $_REQUEST['Nombre'];
	$Apellidos = $_REQUEST['Apellidos'];
	$Correo = $_REQUEST['Correo'];
	$Direccion = $_REQUEST['Direccion'];
	$Telefono = $_REQUEST['Telefono'];
	$action = $_REQUEST['action'];
	$IdGrupo = $_REQUEST['IdGrupo'];

	$USUARIOS = new USUARIOS_Model(
		$login,
		$password,
		$DNI,
		$Nombre,
		$Apellidos,
		$Correo,
		$Direccion,
		$Telefono
		);

	return $USUARIOS;
}
//Como la password en la vista delete no está, al volver atrás del delete muestra un error de que no se encuentra inicializada
if (!isset($_REQUEST['password'])){
	$_REQUEST['password'] = '';
}
if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

if (!isset($_REQUEST['IdGrupo'])){
	$_REQUEST['IdGrupo'] = '';
}

	
	Switch ($_REQUEST['action']){
		case 'ADD':
			if (!$_POST){
				new Usuario_ADD();
			}
			else{
				
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$respuesta = $USUARIOS->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'DELETE':
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$lista = array('login', 'password', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
				$valores = $USUARIOS->RellenaDatos();
				new Usuario_DELETE($lista, $valores);
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$respuesta = $USUARIOS->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		case 'EDIT':		
			if (!$_POST){	
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$valores = $USUARIOS->RellenaDatos();

				new Usuario_EDIT($valores);
			}
			else{	
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);							
				$respuesta = $USUARIOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		case 'SEARCH':
			if (!$_POST){

				new Usuario_SEARCH();
			}
			else{
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$datos = $USUARIOS->SEARCH();
				$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');				
				new Usuario_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		case 'SHOWCURRENT':
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');	
			$valores = $USUARIOS->RellenaDatos();
			$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');
			new Usuario_SHOWCURRENT($lista, $valores);
			break;
			
		case 'ADDGROUP':
			if(!$_POST){ //Si no hay informacion
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'],'','', '','','', '', ''); //Nuevo modelo de usuario
				$GRUPOS =new GRUPOS_Model('','',''); //Nuevo modelo de grupo
				
				$datosUsu = $USUARIOS->SEARCH(); // Devuelve la tupla del usuario

				$datosGru = $GRUPOS->SEARCH(); //Devuelve toda la tabla de grupos
				
				$grupostotales = array(); //Array que contendrá todos los grupos existentes
				while($rowgrupos = $datosGru->fetch_array()){
				$grupostotales[]=$rowgrupos[0];
				}
						
				$USU_GRUP =new USU_GRUPO_Model('',''); // Nuevo modelo de USU_GRUPO
				$datosUsuGrup = $USU_GRUP->SEARCH(); //Devolverá todos los pares usuario_grupo		
				new Usu_Grupo_ADD($datosUsu,$grupostotales,$datosUsuGrup); //Muestra la vista de USU_GRUPO
			}
			else{//Si se ha hecho un post
				
				$login=$_REQUEST['login']; //Definimos login para poder utilizarlo tantas veces como select se hayan seleccionado
				$USU_GRUPOPREVIO= new USU_GRUPO_Model($login,''); //Definimos un modelo de USU_GRUPO con el login que se nos pasa para borrar todos los grupos que tenia seleccionados de antes
				$borrado=$USU_GRUPOPREVIO->reventarUsuario(); //Se revientan todos los grupos a los que pertenece el usuario
				
				if ($_REQUEST['IdGrupo']!=''){ // Si se ha seleccionado algun grupo
				foreach ($_REQUEST['IdGrupo'] as $indice => $valor){ //Recorremos todos los seleccionados
				$USU_GRUPO= new USU_GRUPO_Model($login,$valor);
				$respuesta=$USU_GRUPO->ADD(); // Añadimos uno por uno a la tabla
				}
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
				break; //Rompemos para que no continue
				}else{ //Si no se ha seleccionado ninguno
					new Vista_MESSAGE('Inserción realizada con éxito', '../Controllers/Index_Controller.php'); //Mostramos mensaje de exito en la inserción porque ya se han borrado previamente
				}
				

			

			}
			break;
			
		default:
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model('','','', '','','', '', '');
			}
			else{
				$USUARIOS = get_data_form();
			}
			$datos = $USUARIOS->SEARCH();
			$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
			new Usuario_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>