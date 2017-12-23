<?php
/*
Devuelve true si el usuario pertenece al grupo de Admin
25/11/2017 por IU SPARTANS
*/
include_once '../Models/GRUPOS_Model.php';

function isAdmin(){
	//Guarda una nueva instancia de la clase USU_GRUPO_MODEL
	$GRUPOSLOGIN = new USU_GRUPO_Model($_SESSION['login'],'');
	//Guarda el resultado de la búsqueda
	$gruposLogin = $GRUPOSLOGIN->SEARCH();
	//Mientras haya filas en gruposLogin comprueba que uno de esos grupos sea Admin, en cuyo caso devuelve true, y si llega al final false
	while($row = $gruposLogin->fetch_array()) {
		if($row[1] == 'Admin'){
			return true;
		}//Fin if
	}
	return false;
}//Fin funcion