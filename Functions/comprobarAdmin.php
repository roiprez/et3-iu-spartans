<?php
/*
Devuelve true si el usuario pertenece al grupo de Admin
25/11/2017 por 
*/
include_once '../Models/GRUPOS_Model.php';

function isAdmin(){
	if(!isset($_REQUEST['login'])){
		$_REQUEST['login']='';
	}
	$GRUPOS_LOGIN = new USU_GRUPO_Model($_REQUEST['login'],'');
	
	$gruposLogin = $GRUPOS_LOGIN->SEARCH();
	
	
	while($row = $gruposLogin->fetch_array()) {
		if($row[1] == 'Admin'){
			return true;
		}//Fin if
	}
	return false;
}//Fin funcion