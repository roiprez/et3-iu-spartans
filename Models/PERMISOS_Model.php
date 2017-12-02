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

}
?>