<?php
/*
Vista que muestra la vista principal de la aplicación
23/11/2017 por IU SPARTANS
*/

class Index {
	function __construct(){
		$this->render();
	}
	function render(){
		include '../Locales/Strings_SPANISH.php';
		include '../Views/Header.php'; 
		$Header = new Header();
		include '../Views/Footer.php';
		$Footer = new Footer();
	}
}
?>