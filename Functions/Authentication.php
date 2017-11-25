<?php
/*
Devuelve true si el login de la sesión existe
25/11/2017 por 
*/
function IsAuthenticated(){
	if (!isset($_SESSION['login'])){	
		return false;
	}
	else{
		return true;
	}
} 
?>

