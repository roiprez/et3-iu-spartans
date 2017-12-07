<?php
/*Modelo de datos de Grupo*/
class GRUPOS_Model{   //Declaracion de la clase
    var $idGrupo;
    var $nombreGrupo;
    var $descripGrupo;

    var $mysqli;

    function __construct ($idGrupo,$nombreGrupo,$descripGrupo){
        $this->idGrupo = $idGrupo;
        $this->nombreGrupo = $nombreGrupo;
        $this->descripGrupo= $descripGrupo;

        //Creamos el conector a la base de datos
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConectarBD();
    }

    function ADD()
    {
        if ($this->idGrupo <> ''){//Se comprueba que el campo no este vacio
            $sql = "SELECT * FROM GRUPO WHERE (IdGrupo= '$this->idGrupo')";
            if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
            }
            else{// si la query no da error
                if($result->num_rows == 0){//miramos que la clave no exista en la BD
                    //Sentencia SQL
                    $sql = "INSERT INTO GRUPO (
                      IdGrupo,
                      NombreGrupo,
                      DescripGrupo)
                      VALUES (
                        '$this->idGrupo',
                        '$this->nombreGrupo',
                        '$this->descripGrupo'
                      )";
                    if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
                        return 'Error en la inserción';
                    }
                    else{ //si no da error en la insercion devolvemos mensaje de exito
                        return 'Inserción realizada con éxito'; //operacion de insertado correcta
                    }

                }
                else // si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
                    return 'Ya existe en la base de datos'; // ya existe
            }
        }
        else{ // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
            return 'Introduzca un valor'; // introduzca un valor para el usuario
        }
    } // fin del metodo ADD
function SEARCH(){
//Se contruye la sentencia de busqueda usando Like
    $sql= "SELECT
            IdGrupo,
            NombreGrupo,
            DescripGrupo
            FROM GRUPO
            WHERE (
            (IdGrupo LIKE '%$this->idGrupo%')&&
            (NombreGrupo LIKE '%$this->nombreGrupo%')&&
            (DescripGrupo LIKE '%$this->descripGrupo%')
            )";
    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
        return 'Error en la consulta sobre la base de datos';
    }
    else{ // si la busqueda es correcta devolvemos el recordset resultado
        return $resultado;
    }
} // fin metodo SEARCH

function DELETE(){
    //se comprueba que existe existe la tupla a borrar si es asi se borra
    //si no, se alerta de que no existe
    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idGrupo')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
        // se construye la sentencia sql de borrado
        $sql = "DELETE FROM GRUPO WHERE (IdGrupo = '$this->idGrupo')";
        // se ejecuta la query
        $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        return "Borrado correctamente";
    } // si no existe el login a borrar se devuelve el mensaje de que no existe
    else
        return "No existe";
} // fin metodo DELETE

function EDIT(){
// se construye la sentencia de busqueda de la tupla en la bd
    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idGrupo')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si el numero de filas es igual a uno es que lo encuentra
    if ($result->num_rows == 1)
    {	// se construye la sentencia de modificacion en base a los atributos de la clase
        $sql = "UPDATE GRUPO SET 
					IdGrupo = '$this->idGrupo',
					NombreGrupo = '$this->nombreGrupo',
					DescripGrupo = '$this->descripGrupo'
					
				WHERE ( IdGrupo = '$this->idGrupo'
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
} // fin del metodo EDIT

    function RellenaDatos()
    {	// se construye la sentencia de busqueda de la tupla
        $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idGrupo')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; //
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    } // fin del metodo RellenaDatos()
}//Fin de la clase GRUPO

class USU_GRUPO_Model{//Declaracion de la clase
    var $login;
    var $idGrupo;

function __construct($login,$idGrupo)
{
    $this->login=$login;
    $this->idGrupo=$idGrupo;

    //Creamos el conector a la base de datos
    include_once '../Models/Access_DB.php';
    $this->mysqli = ConectarBD();

}

	function reventarUsuario(){
		
   $sql="DELETE
		FROM USU_GRUPO
		WHERE (login LIKE '$this->login')";
		if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
			return 'Error en el borrado';
		}
		else{ //si no da error en la insercion devolvemos mensaje de exito
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}
		
	}
    function ADD()
    {
        if ($this->idGrupo <> '') {//Se comprueba que grupo no este vacio
            $sql = "SELECT * FROM GRUPO WHERE (IdGrupo= '$this->idGrupo')";
            if (!$result = $this->mysqli->query($sql))  // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
            else {// si la query no da error
                if ($result->num_rows == 1) {//miramos que el Grupo existe en la BD
                    if ($this->login <> '') {// Se comprueba que login no este vacio
                        $sql = "SELECT * FROM USUARIO WHERE (login= '$this->login')";
                        if (!$result = $this->mysqli->query($sql)) { // si da error la ejecución de la query
                            return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido
                            // conectar con la bd). Devolvemos un mensaje que el controlador manejara
                        }
                        else {//si la query no da error
                            if ($result->num_rows == 1) {//miramos que el Usuario existe en la BD
                                $sql="SELECT * FROM USU_GRUPO WHERE ((login='$this->login')&&(IdGrupo='$this->idGrupo'))";
                                $result = $this->mysqli->query($sql);
                                if($result->num_rows ==0){// Comprobamos que el usuario no este ya asignado al grupo
									$sql="INSERT INTO USU_GRUPO
                                            (
                                            login,
                                            IdGrupo)
                                            VALUES (
                                            '$this->login',
                                            '$this->idGrupo'
                                            )";
                                    if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
                                        return 'Error en la inserción';
                                    }
                                    else{ //si no da error en la insercion devolvemos mensaje de exito
                                        return 'Inserción realizada con éxito'; //operacion de insertado correcta
                                    }
                                }
                                else // Si el usuario ya estaba asignado se notifica
                                return 'Inserción realizada con éxito';
                            }
                            else // si no existe ese valor en USUARIO se avisa de que el usuario no existe o es incorrecto
                                return 'El Usuario no existe o el codigo es incorrecto'; // ya existe
                        }
                    }
                }else // si no existe ese valor en GRUPO se avisa de que el grupo no existe o es incorrecto
                    return 'El grupo no existe o el codigo es incorrecto'; // ya existe
            }
    }
        else // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
            return 'Introduzca un valor'; // introduzca un valor para el grupo
    } // fin del metodo ADD
    
	function SEARCH(){
		$sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idGrupo')";
                $sql = "SELECT * FROM USU_GRUPO WHERE ((login LIKE '%$this->login%') && (IdGrupo LIKE '%$this->idGrupo%'))";
    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
        return 'Error en la consulta sobre la base de datos';
    }
    else{ // si la busqueda es correcta devolvemos el recordset resultado
        return $resultado;
    }
    } // fin metodo SEARCH
	
	
	
	function DELETE(){
        //se comprueba que existe existe la tupla a borrar si es asi se borra
        //si no, se alerta de que no existe
        $sql = "SELECT * FROM USU_GRUPO WHERE ((IdGrupo = '$this->idGrupo')&&(Login = '$this->login'))";
        // se ejecuta la query
        $result = $this->mysqli->query($sql);
        // si existe una tupla con ese valor de clave
        if ($result->num_rows == 1)
        {
            // se construye la sentencia sql de borrado
            $sql = "DELETE FROM USU_GRUPO WHERE ((IdGrupo = '$this->idGrupo')&&(Login='$this->login'))";
            // se ejecuta la query
            $this->mysqli->query($sql);
            // se devuelve el mensaje de borrado correcto
            return "Borrado correctamente";
        } // si no existe el login a borrar se devuelve el mensaje de que no existe
        else
            return "No existe";
    } // fin metodo DELETE
}
?>