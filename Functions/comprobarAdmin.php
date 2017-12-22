<?php
/*
Devuelve true si el usuario pertenece al grupo de Admin
25/11/2017 por 
*/
include_once '../Models/GRUPOS_Model.php';

function isAdmin(){
	$GRUPOSLOGIN = new USU_GRUPO_Model($_SESSION['login'],'');
	$gruposLogin = $GRUPOSLOGIN->SEARCH();
	while($row = $gruposLogin->fetch_array()) {
		if($row[1] == 'Admin'){
			return true;
		}//Fin if
	}
	return false;
}//Fin funcion