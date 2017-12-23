<?php
/*
Devuelve la lista de trabajos del usuario de la sesión
19/12/2017 por IU SPARTANS
*/
include_once '../Models/ENTREGAS_Model.php';

function getTrabajos(){
  //Guarda una nueva instancia de la clase ENTREGAS_Model
	$ENTREGAS = new ENTREGAS_Model('',$_SESSION['login'],'','','');
  //Guarda el resultado de la búsqueda
  $entregas = $ENTREGAS->SEARCH();
  
  //Array que va a almacenar la lista de trabajos en las que el usuario de la sesión tiene entregas
  $trabajos = [];
  //Varable incremental del bucle
  $i = 0;
  //Mientras haya tuplas en entregas añade trabajos al array
	while($row = $entregas->fetch_array()) {
    //Comprueba que el login de la sesión es igual al de la tupla y añade un trabajo al array
    if($_SESSION['login']==$row[1]){
      $trabajos[$i] = $row[0];
    } 
    $i++;
  }
	return $trabajos;
}//Fin funcion