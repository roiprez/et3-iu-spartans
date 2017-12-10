<?php
/*
Devuelve true si el usuario pertenece al grupo de Admin
25/11/2017 por 
*/

function isAdmin(){

include_once '../Models/Access_DB.php';
$mysqli = ConectarBD();

//Construimos una sentencia que devuelve todos los usuarios que pertenezcan al grupo de administradores

$sql= "SELECT login
 FROM USU_GRUPO U, GRUPO G 
 WHERE (G.NombreGrupo LIKE 'admin') AND (G.IdGrupo = U.IdGrupo) ";

	if (!($resultado = $mysqli->query($sql))) { // si da error en la ejecución del insert devolvemos mensaje
	return false;
	}
	else{ //si no da error en la insercion devolvemos mensaje de exito
	    
	    //Mientras haya otro login en el resultado de la consulta
	    while($row = $resultado->fetch_array())
			{
				//Si el usuario actual coincide con algun login del grupo admin
				if($_SESSION['login'] == $row['0'] ){
					return true;
				}//Fin if
			}//Fin while
		}//Fin else
		return false;
}//Fin funcion