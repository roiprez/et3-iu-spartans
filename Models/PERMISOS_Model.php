<?php
class PERMISOS_Model{
    var $idGrupo;
    var $idFuncionalidad;
    var $idAccion;

    var $mysqli;

    function __construct($idGrupo, $idFuncionalidad, $idAccion)
    {
        $this->idAccion=$idAccion;
        $this->idFuncionalidad=$idFuncionalidad;
        $this->idGrupo=$idGrupo;

        //Creamos el conector a la base de datos
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConectarBD();
    }

    function ADD()
    {
        if ($this->idGrupo <> '') {//Se comprueba que grupo no este vacio
            $sql = "SELECT * FROM GRUPO WHERE (IdGrupo= '$this->idGrupo')";
            if (!$result = $this->mysqli->query($sql))  // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido
                                                                      // conectar con la bd). Devolvemos un mensaje que el controlador manejara
            else {// si la query no da error
                if ($result->num_rows == 1) {//miramos que el Grupo existe en la BD
                    if ($this->idFuncionalidad <> ''&& $this->idAccion <>'') {// Se comprueba que idFuncionalidad e idAccion no esten vacios
                        $sql = "SELECT * FROM FUNC_ACCION WHERE ((IdFuncionalidad = '$this->idFuncionalidad')&&(IdAccion = '$this->idAccion'))";
                        if (!$result = $this->mysqli->query($sql)) { // si da error la ejecución de la query
                            return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido
                            // conectar con la bd). Devolvemos un mensaje que el controlador manejara
                        }
                        else {//si la query no da error
                            if ($result->num_rows == 1) {//miramos que la Funcionalidad tiene Asignada esa Accion  en la BD
                                $sql="SELECT * FROM PERMISO WHERE ((IdGrupo='$this->idGrupo')&&(IdFuncionalidad = '$this->idFuncionalidad')
                                                                                                            &&(IdAccion = '$this->idAccion'))";
                                $result = $this->mysqli->query($sql);
                                if($result->num_rows ==0){// Comprobamos que el grupo no tiene asignado ese permiso
                                    $sql="INSERT INTO PERMISO
                                            (
                                            IdGrupo,
                                            IdFuncionalidad,
                                            IdAccion)
                                            VALUES (
                                            '$this->idGrupo',
                                            '$this->idFuncionalidad',
                                            '$this->idAccion'
                                            )";
                                    if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
                                        return 'Error en la inserción';
                                    }
                                    else{ //si no da error en la insercion devolvemos mensaje de exito
                                        return 'Inserción realizada con éxito'; //operacion de insertado correcta
                                    }
                                }
                                else // Si el premiso ya estaba asignado se notifica
                                    return 'Permiso ya concedido prebiamente';
                            }
                            else // si esa funcionalidad no tiene asignada dicha accion
                                return 'No existe esa accion para la funcionalidad seleccionada'; // ya existe
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
    //Se contruye la sentencia de busqueda usando Like
$sql= "SELECT
            IdAccion,
            IdFuncionalidad,
            IdGrupo
            FROM PERMISO
            WHERE (
            (IdAccion LIKE '%$this->idAccion%')&&
            (IdFuncionalidad LIKE '%$this->idFuncionalidad%')&&
            (IdGrupo LIKE '%$this->idGrupo%')
            )";
    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
if (!($resultado = $this->mysqli->query($sql))){
return 'Error en la consulta sobre la base de datos';
}
else{ // si la busqueda es correcta devolvemos el recordset resultado
    return $resultado;
}
} // fin metodo SEARCH

    function RellenaDatos()
    {	// se construye la sentencia de busqueda de la tupla
        $sql = "SELECT * FROM PERMISO WHERE (IdAccion = '$this->idAccion' && IdFuncionalidad = '$this->idFuncionalidad' && IdGrupo='$this->idGrupo')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; //
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    } // fin del metodo RellenaDatos()
    function reventarPermiso(){

        $sql="DELETE
		FROM PERMISO
		WHERE (IdGrupo LIKE '$this->idGrupo')";
        if (!$this->mysqli->query($sql)) { // si da error en la ejecución del delete devolvemos mensaje
            return 'Error en el borrado';
        }
        else{ //si no da error en el borrado devolvemos mensaje de exito
            return 'Inserción realizada con éxito'; //operacion de borrado correcta
        }

    }

}
?>