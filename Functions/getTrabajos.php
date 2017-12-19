<?php
/*
Devuelve la lista de trabajos del usuario de la sesión
19/12/2017 por 
*/
include_once '../Models/ENTREGAS_Model.php';

function getTrabajos(){
	$ENTREGAS = new ENTREGAS_Model('',$_SESSION['login'],'','','');
  $entregas = $ENTREGAS->SEARCH();
  
  $trabajos = [];
  $i = 0;

	while($row = $entregas->fetch_array()) {
    if($_SESSION['login']==$row[1]){
      $trabajos[$i] = $row[0];
    } 
    $i++;
  }
	return $trabajos;
}//Fin funcion