<?php
/*
Devuelve true si el login de la sesión existe
25/11/2017 por IU SPARTANS
*/
function IsAuthenticated(){
	//Comprueba que el login existe y devuelve true en caso afirmativo y false en el contrario
	if (!isset($_SESSION['login'])){	
		return false;
	}
	else{
		return true;
	}
} 
?>

