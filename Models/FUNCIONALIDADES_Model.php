<?php
class FUNCIONALIDADES_MODEL{
    var $idFuncionalidad;
    var $nombreFuncionalidad;
    var $descripFuncionalidad;

    var $mysqli;

    function __construct($idFuncionalidad,$nobreFuncionalidad,$descripFuncionalidad)
    {
        $this->idFuncionalidad=$idFuncionalidad;
        $this->descripFuncionalidad=$descripFuncionalidad;
        $this->nombreFuncionalidad=$nobreFuncionalidad;

        //Creamos el conector a la base de datos
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConectarBD();
    }

    function ADD()
    {
        if ($this->idFuncionalidad <> ''){//Se comprueba que el campo no este vacio
            $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad= '$this->idFuncionalidad')";
            if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
            }
            else{// si la query no da error
                if($result->num_rows == 0){//miramos que la clave no exista en la BD
                    //Sentencia SQL
                    $sql = "INSERT INTO FUNCIONALIDAD(
                      IdFuncionalidad,
                      NombreFuncionalidad,
                      DescripFuncionalidad)
                      VALUES (
                        '$this->idFuncionalidad',
                        '$this->nombreFuncionalidad',
                        '$this->descripFuncionalidad'
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
            IdFuncionalidad,
            NombreFuncionalidad,
            DescripFuncionalidad
            FROM FUNCIONALIDAD
            WHERE (
            (IdFuncionalidad LIKE '%$this->idFuncionalidad%')&&
            (NombreFuncionalidad LIKE '%$this->nombreFuncionalidad%')&&
            (DescripFuncionalidad LIKE '%$this->descripFuncionalidad%')
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
        $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->idFuncionalidad')";
        // se ejecuta la query
        $result = $this->mysqli->query($sql);
        // si existe una tupla con ese valor de clave
        if ($result->num_rows == 1)
        {
            // se construye la sentencia sql de borrado
            $sql = "DELETE FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->idFuncionalidad')";
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
        $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->idFuncionalidad')";
        // se ejecuta la query
        $result = $this->mysqli->query($sql);
        // si el numero de filas es igual a uno es que lo encuentra
        if ($result->num_rows == 1)
        {	// se construye la sentencia de modificacion en base a los atributos de la clase
            $sql = "UPDATE FUNCIONALIDAD SET 
					IdFuncionalidad = '$this->idFuncionalidad',
					NombreFuncionalidad = '$this->nombreFuncionalidad',
					DescripFuncionalidad = '$this->descripFuncionalidad'
					
				WHERE ( IdFuncionalidad = '$this->idFuncionalidad'
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
        $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->idFuncionalidad')";
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
?>