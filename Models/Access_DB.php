

<?php
/*
Función única de conexión a la base de datos
26/10/2017 por s84f46
*/
function ConectarBD() //declaración de funcion
	{
		//se ejecuta la función de conexión mysqli y se recoge el manejador
		$mysqli = new mysqli('localhost', 'root', 'iu', 'IU_USUARIO'); //maquina, user, pass, bd
		// si hay error en la conexión se muestra el mensaje de error
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		// la función devuelve el manejador
		return $mysqli;
	}
?>