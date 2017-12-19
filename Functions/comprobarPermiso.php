<?php
/*
Devuelve true si el usuario pertenece al grupo de Admin
25/11/2017 por 
*/
include_once '../Models/GRUPOS_Model.php';
include_once '../Models/PERMISOS_Model.php';

function isAllow($idFun,$idAcci){
	$GRUPOS_LOGIN = new USU_GRUPO_Model($_SESSION['login'],'');
	$gruposLogin = $GRUPOS_LOGIN->SEARCH();
	while($row = $gruposLogin->fetch_array()) {
		if($row[1] == 'Admin'){			
			return true;
		}
		$FUN_ACCION=  new PERMISOS_Model($row[1],$idFun,$idAcci);
		$funcAccion = $FUN_ACCION->SEARCH();
		//Si la búsqueda produce una tupla devolvemos true
		if($funcAccion->fetch_array()) return true;
	}
	return false;
}//Fin funcion