<?php
/*
Devuelve true si el usuario pertenece a un grupo con permisos para una función concreta
25/11/2017 por IU SPARTANS
*/
include_once '../Models/GRUPOS_Model.php';
include_once '../Models/PERMISOS_Model.php';

function isAllow($idFun,$idAcci){
	//Guarda una nueva instancia de la clase USU_GRUPO_MODEL
	$GRUPOS_LOGIN = new USU_GRUPO_Model($_SESSION['login'],'');
	//Guarda el resultado de la búsqueda
	$gruposLogin = $GRUPOS_LOGIN->SEARCH();
	//Mientras haya filas en gruposLogin comprueba que uno de esos grupos sea Admin, en cuyo caso devuelve true,
	//también devuelve true si el grupo tiene permiso, y si llega al final false
	while($row = $gruposLogin->fetch_array()) {
		//Si es admin devuelve true
		if($row[1] == 'Admin'){			
			return true;
		}
		//Guarda una nueva instancia de la clase PERMISOS_Model
		$FUN_ACCION=  new PERMISOS_Model($row[1],$idFun,$idAcci);
		//Guarda el resultado de la búsqueda
		$funcAccion = $FUN_ACCION->SEARCH();
		//Si la búsqueda produce una tupla devolvemos true
		if($funcAccion->fetch_array()) return true;
	}
	return false;
}//Fin funcion