<?php
/*
Devuelve true si el usuario pertenece al grupo de Admin
25/11/2017 por 
*/
include_once '../Models/GRUPOS_Model.php';


function enFecha($IdTrabajo){
	
	$TRABAJO = new TRABAJOS_Model($IdTrabajo,'','','','');
	$TRABAJO_cmp = $TRABAJO->SEARCH();
	
	while($row = $TRABAJO_cmp->fetch_array()) {
		//Si la fecha limite ya ha pasado
		echo $row[3];
		echo  date("Y-m-d");
	if($row[3] < date("Y-m-d")){
		return false;
	}
	
	}//Fin while
	return true;
}//Fin funcion
