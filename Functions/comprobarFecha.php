<?php
/*
Comprueba que el trabajo se ha entregado en la fecha correcta
22/12/2017 por IU SPARTANS 
*/
include_once '../Models/GRUPOS_Model.php';


function enFecha($IdTrabajo){
	//Guarda una nueva instancia de la clase TRABAJO
	$TRABAJO = new TRABAJOS_Model($IdTrabajo,'','','','');
	//Guarda el resultado de la búsqueda
	$TRABAJO_cmp = $TRABAJO->SEARCH();
	
	//Recorre la lista de trabajos para ver si la fecha de entrega ha expirado
	while($row = $TRABAJO_cmp->fetch_array()) {
		//Si la fecha limite ya ha pasado
		echo $row[3];
		echo  date("Y-m-d");
		//Si ha expirado devuelve falso
		if($row[3] < date("Y-m-d")){
			return false;
		}
	}//Fin while
	return true;
}//Fin funcion
