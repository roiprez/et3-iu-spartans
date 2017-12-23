

<?php
/*
Función única de conexión a la base de datos
25/11/2017 por IU SPARTANS
*/
function ConectarBD() //declaración de funcion
	{
		//se ejecuta la función de conexión mysqli y se recoge el manejador
		$mysqli = new mysqli('localhost', 'userET3', 'passET3', 'IUET32017'); //maquina, user, pass, bd
		// si hay error en la conexión se muestra el mensaje de error
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		// la función devuelve el manejador
		return $mysqli;
	}
?>