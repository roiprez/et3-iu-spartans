<?php

/*
Controlador que se encarga de gestionar las peticiones de lectura y escritura de datos al modelo de Usuario.
25/11/2017 por IU SPARTANS
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
include_once '../Models/GRUPOS_Model.php';



//Devuelve una instancia del modelo con los objetos recibidos del formulario como parámetros
function get_data_form(){
	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'].trim();
	$DNI = $_REQUEST['DNI'].trim();
	$Nombre = $_REQUEST['Nombre'].trim();
	$Apellidos = $_REQUEST['Apellidos'].trim();
	$Correo = $_REQUEST['Correo'].trim();
	$Direccion = $_REQUEST['Direccion'].trim();
	$Telefono = $_REQUEST['Telefono'].trim();
	$action = $_REQUEST['action'].trim();
	$IdGrupo = $_REQUEST['IdGrupo'].trim();

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
//Si el formulario no ha devuelto una action la inicializamos vacía
if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}
//Si el formulario no ha devuelto un grupo lo inicializamos vacío
if (!isset($_REQUEST['IdGrupo'])){
	$_REQUEST['IdGrupo'] = '';
}

	//EN función de la action que llega del formulario ejecutamos una acción distinta	
	Switch ($_REQUEST['action']){
		//Añadimos una tupla
		case 'ADD':
			//Si no hay post
			if (!$_POST){
				//Creamos una instancia de la vista
				new Usuario_ADD();
			}
			else{
				$temp_login= $_REQUEST['login'];//Se define un login temporal para poder usarlo tanto en la insercion del usuario
                                                //como cuando se asigne el usuario al grupo por defecto.
				//Recogemos los datos, los añadimos y lanzamos la respuesta en una vista
				$USUARIOS = new USUARIOS_Model($temp_login, $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$respuesta = $USUARIOS->ADD();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
				//Añade al usuario directamente al grupo de Alumno
				$USU_GRUP = new USU_GRUPO_Model($temp_login,'Alumno'); //Todo nuevo usuario es asginado por defecto al grupo mas basico
				$USU_GRUP->ADD();
			}
			break;
		//Borramos una tupla
		case 'DELETE':
			//Si no hay post
			if (!$_POST){
				//Creamos una vista con los datos del usuario
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion','Telefono');
				$valores = $USUARIOS->RellenaDatos();
				new Usuario_DELETE($lista, $valores);
			}
			else{
				//Cogemos el usuario y lo borramos
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$respuesta = $USUARIOS->DELETE();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			break;
		//Editamos una tupla
		case 'EDIT':		
			//Si no hay post
			if (!$_POST){	
				//Rellenamos de datos la vista de edit y la mostramos
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');
				$valores = $USUARIOS->RellenaDatos();
				new Usuario_EDIT($valores);
			}
			else{	
				//Cogemos el resultado del submit del formulario y editamos en el modelo
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);							
				$respuesta = $USUARIOS->EDIT();
				new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
			}
			
			break;
		//Buscamos una tupla o un conjunto de tuplas
		case 'SEARCH':
			//Si no hay post
			if (!$_POST){
				//Lanza la vista de search
				new Usuario_SEARCH();
			}
			else{
				//Recogemos los datos y lanzamos un showall con las tuplas filtradas
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], $_REQUEST['password'], $_REQUEST['DNI'], $_REQUEST['Nombre'], $_REQUEST['Apellidos'], $_REQUEST['Correo'], $_REQUEST['Direccion'], $_REQUEST['Telefono']);
				$datos = $USUARIOS->SEARCH();
				$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo');				
				new Usuario_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
			}
			break;
		//Mostramos en detalle una tupla
		case 'SHOWCURRENT':
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '', '', '', '', '', '', '');	
			$valores = $USUARIOS->RellenaDatos();
			$lista = array('login','DNI', 'Nombre', 'Apellidos', 'Correo', 'Direccion', 'Telefono');
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
						$USU_GRUPO->ADD(); // Añadimos uno por uno a la tabla
					}
				}
				new Vista_MESSAGE('Modificado correctamente', '../Controllers/Index_Controller.php');
			}
			break;
			
		//Si la accion no coincide con las anteriores creamos un showall con todoas las tuplas de la tabla
		default:
			//Si no hay post
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model('','','', '','','', '', '');
			}
			else{
				$USUARIOS = get_data_form();
			}
			$datos = $USUARIOS->SEARCH();
			$lista = array('login', 'DNI', 'Nombre', 'Apellidos', 'Correo');
			new Usuario_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
						
	}
?>