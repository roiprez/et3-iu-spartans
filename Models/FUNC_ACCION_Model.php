<?php

/*
El Modelo de los datos de func_accion, se encarga de ejecutar las operaciones de la aplicación contra la base de datos
30/11/2017 por 
*/

class FUNCACCION_Model { //declaración de la clase
	//Campos de una funcionalidad
	var $IdFuncionalidad;
	//Campos de una accion
	var $IdAccion;

	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase
	function __construct($IdFuncionalidad,$IdAccion){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdFuncionalidad = $IdFuncionalidad;
	$this->IdAccion = $IdAccion;

	// incluimos la funcion de acceso a la bd
	include_once '../Models/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConectarBD();

} // fin del constructor

function ADD(){
        
        if ($this->IdFuncionalidad <> '') {//Se comprueba que IdFuncionalidad no este vacia
            $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad= '$this->idFuncionalidad')";
            if (!$result = $this->mysqli->query($sql)){  // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
            }else {// si la query no da error
                if ($result->num_rows == 1) {//miramos que la Funcionalidad existe en la BD
                    if ($this->IdAccion <> '') {// Se comprueba que IdAccion no este vacio
                        $sql = "SELECT * FROM ACCION WHERE (IdAccion= '$this->IdAccion')";
                        if (!$result = $this->mysqli->query($sql)) { // si da error la ejecución de la query
                            return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido
                            // conectar con la bd). Devolvemos un mensaje que el controlador manejara
                        }
                        else {//si la query no da error
                            if ($result->num_rows == 1) {//miramos que la Accion existe en la BD
                                $sql="SELECT * FROM FUNC_ACCION WHERE ((IdAccion='$this->IdAccion')&&(IdFuncionalidad='$this->idFuncionalidad'))";
                                $result = $this->mysqli->query($sql);
                                if($result->num_rows ==0){// Comprobamos que la accion no este ya asignado a la funcionalidad
                                    $sql="INSERT INTO FUNC_ACCION
                                            (
                                            IdFuncionalidad,
                                            IdAccion)
                                            VALUES (
                                            '$this->IdFuncionalidad',
                                            '$this->idAccion'
                                            )";
                                    if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
                                        return 'Error en la inserción';
                                    }
                                    else{ //si no da error en la insercion devolvemos mensaje de exito
                                        return 'Inserción realizada con éxito'; //operacion de insertado correcta
                                    }
                                }
                                else // Si la accion ya estaba asignada a la funcionalidad se notifica
                                return 'La accion ya esta asignada a esa funcionalidad';
                            }
                            else // si no existe ese valor en ACCION se avisa de que el usuario no existe o es incorrecto
                                return 'La accion no existe o el Id es incorrecto'; // ya existe
                        }
                    }
                }else // si no existe ese valor en FUNCIONALIDAD se avisa de que el grupo no existe o es incorrecto
                    return 'La funcionalidad no existe o el Id es incorrecto'; // ya existe
            }
    }
        else // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
            return 'Introduzca un valor'; // introduzca un valor
 } // Fin funcion ADD

//Permite borrar un par Funcionalidad-Accion
function DELETE(){
        //se comprueba que existe existe la tupla a borrar si es asi se borra
        //si no, se alerta de que no existe
        $sql = "SELECT * FROM FUNC_ACCION WHERE ((IdFuncionalidad = '$this->IdFuncionalidad')&&(IdAccion = '$this->IdAccion'))";
        // se ejecuta la query
        $result = $this->mysqli->query($sql);
        // si existe una tupla con ese valor de clave
        if ($result->num_rows == 1)
        {
            // se construye la sentencia sql de borrado
            $sql = "DELETE FROM FUNC_ACCION WHERE ((IdFuncionalidad = '$this->IdFuncionalidad')&&(IdAccion='$this->IdAccion'))";
            // se ejecuta la query
            $this->mysqli->query($sql);
            // se devuelve el mensaje de borrado correcto
            return "Borrado correctamente";
        } // si no existe el login a borrar se devuelve el mensaje de que no existe
        else{
            return "No existe";
        }
    } // fin metodo DELETE
}//Fin de clase FUNCACCION_Model
/*
class FUNCIONALIDAD_Model { //declaración de la clase


	//Campos de una funcionalidad
	var $IdFuncionalidad;
	var $NombreFuncionalidad;
	var $DescripFuncionalidad;
	
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

	function __construct($IdFuncionalidad,$NombreFuncionalidad,$DescripFuncionalidad){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdFuncionalidad = $IdFuncionalidad;
	$this->NombreFuncionalidad = $NombreFuncionalidad;
	$this->DescripFuncionalidad = $DescripFuncionalidad;

	// incluimos la funcion de acceso a la bd
	include_once '../Models/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConectarBD();

} // fin del constructor



//Permite añadir una funcionalidad
function ADD(){


    if (($this->IdFuncionalidad <> '')){ // si el atributo clave de la entidad no esta vacio
		
		// construimos el sql para buscar esa clave en la tabla
        $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";

		if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
			return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
		}
		else { // si la ejecución de la query no da error
			if ($result->num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el login)
				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO FUNCIONALIDAD (
					IdFuncionalidad,
					NombreFuncionalidad,
					DescripFuncionalidad)
						VALUES (
							'$this->IdFuncionalidad',
							'$this->NombreFuncionalidad',
							'$this->DescripFuncionalidad')";
				
				if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
					return 'Error en la inserción de la funcionalidad';
				}
				else{ //si no da error en la insercion devolvemos mensaje de exito
					return 'Inserción de funcionalidad realizada con éxito'; //operacion de insertado correcta
				}
				
			}
			else // si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
				return 'El IdFuncionalidad ya existe en la base de datos'; // ya existe
		}
	}
}//Fin funcion ADD

//Devuelve toda la informacion de una funcionalidad
function SEARCH(){

	if ($this->IdFuncionalidad <> ''){


			// construimos el sql para buscar esa clave en la tabla
		        $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";

		        //Si no se puede realizar la consulta sobre la bd devuelve mensaje de error
			if (!($resultado = $this->mysqli->query($sql))){
				return 'Error en la consulta sobre la base de datos';
			}
		    else{ // si la busqueda es correcta devolvemos el recordset resultado
				return $resultado;
			}        


	}else{ // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
	        return 'Introduzca un valor para la funcionalidad'; // introduzca un valor para el usuario
		}
}//Fin funcion search

//Permite modificar los campos de una funcionalidad
function EDIT(){

	// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    // si el numero de filas es igual a uno es que lo encuentra
	    if ($result->num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE FUNCIONALIDAD SET 
						IdFuncionalidad = '$this->IdFuncionalidad',
						NombreFuncionalidad = '$this->NombreFuncionalidad',
						DescripFuncionalidad = '$this->DescripFuncionalidad'
					WHERE ( IdFuncionalidad = '$this->IdFuncionalidad'
					)";
			// si hay un problema con la query se envia un mensaje de error en la modificacion
	        if (!($resultado = $this->mysqli->query($sql))){
				return 'Error en la modificación'; 
			}
			else{ // si no hay problemas con la modificación se indica que se ha modificado
				return 'Modificado correctamente';
			}
	    }
	    else // si no se encuentra la tupla se manda el mensaje de que no existe la tupla
	    	return 'No existe en la base de datos';


}//Fin funcion EDIT

 } //Fin de clase FUNCIONALIDAD_Model


class Accion_Model { //declaración de la clase

	//Campos de una accion
	var $IdAccion;
	var $NombreAccion;
	var $DescripAccion;

	
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase
	function __construct($IdAccion,$NombreAccion,$DescripAccion){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdAccion = $IdAccion;
	$this->NombreAccion = $NombreAccion;
	$this->DescripAccion = $DescripAccion;

	// incluimos la funcion de acceso a la bd
	include_once '../Models/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConectarBD();

} // fin del constructor

//Permite añadir una funcionalidad
function ADD(){


    if (($this->IdAccion <> '')){ // si el atributo clave de la entidad no esta vacio
		
		// construimos el sql para buscar esa clave en la tabla
        $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')";

		if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
			return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
		}
		else { // si la ejecución de la query no da error
			if ($result->num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el login)
				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO ACCION (
					IdAccion,
					NombreAccion,
					DescripAccion)
						VALUES (
							'$this->IdAccion',
							'$this->NombreAccion',
							'$this->DescripAccion')";
				
				if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
					return 'Error en la inserción de la accion';
				}
				else{ //si no da error en la insercion devolvemos mensaje de exito
					return 'Inserción de accion realizada con éxito'; //operacion de insertado correcta
				}
				
			}
			else // si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
				return 'El IdAccion ya existe en la base de datos'; // ya existe
		}
	}
}//Fin funcion ADD

//Devuelve toda la informacion de una accion
function SEARCH(){

if ($this->IdAccion <> ''){


			// construimos el sql para buscar esa clave en la tabla
		        $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')";

		        //Si no se puede realizar la consulta sobre la bd devuelve mensaje de error
			if (!($resultado = $this->mysqli->query($sql))){
				return 'Error en la consulta sobre la base de datos';
			}
		    else{ // si la busqueda es correcta devolvemos el recordset resultado
				return $resultado;
			}        


	}else{ // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
	        return 'Introduzca un valor para la accion'; // introduzca un valor para el usuario
		}
}//Fin funcion SEARCH

//Permite modificar los campos de una accion
function EDIT(){

// se construye la sentencia de busqueda de la tupla en la bd
    $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si el numero de filas es igual a uno es que lo encuentra
    if ($result->num_rows == 1)
    {	// se construye la sentencia de modificacion en base a los atributos de la clase
		$sql = "UPDATE ACCION SET 
					IdAccion = '$this->IdAccion',
					NombreAccion = '$this->NombreAccion',
					DescripAccion = '$this->DescripAccion'
				WHERE ( IdAccion = '$this->IdAccion'
				)";
		// si hay un problema con la query se envia un mensaje de error en la modificacion
        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la modificación'; 
		}
		else{ // si no hay problemas con la modificación se indica que se ha modificado
			return 'Modificado correctamente';
		}
    }
    else // si no se encuentra la tupla se manda el mensaje de que no existe la tupla
    	return 'No existe en la base de datos';


	}//Fin funcion EDIT

}//Fin de la clase Accion_Model
*/
?>