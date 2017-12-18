<?php
/*Modelo de datos de TRABAJO*/
class TRABAJOS_Model{   //Declaracion de la clase

    var $idTrabajo;
    var $nombreTrabajo;
    var $fechIniTrabajo;
    var $fechFinTrabajo;
    var $porcentajeNota;

    var $mysqli;

    function __construct ($idTrabajo,$nombreTrabajo,$fechIniTrabajo, $fechFinTrabajo, $porcentajeNota){
        $this->idTrabajo = $idTrabajo;
        $this->nombreTrabajo = $nombreTrabajo;
        $this->fechIniTrabajo= $fechIniTrabajo;
        $this->fechFinTrabajo= $fechFinTrabajo;
        $this->porcentajeNota= $porcentajeNota;

        //si la fechIniTrabajo viene vacia la asignamos vacia
        if ($fechIniTrabajo == ''){
            $this->fechIniTrabajo = $fechIniTrabajo;
        }
        //si la fechFinTrabajo viene vacia la asignamos vacia
        if ($fechFinTrabajo == ''){
            $this->fechFinTrabajo = $fechFinTrabajo;
        }
        //Creamos el conector a la base de datos
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConectarBD();
    }

    function ADD()
    {
        if ($this->idTrabajo <> ''){//Se comprueba que el campo no este vacio
            $sql = "SELECT * FROM TRABAJO WHERE (IdTrabajo= '$this->idTrabajo')";
            if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
            }
            else{// si la query no da error
                if($result->num_rows == 0){//miramos que la clave no exista en la BD
                    //Sentencia SQL
                    $sql = "INSERT INTO TRABAJO (
                      IdTrabajo,
                      NombreTrabajo,
                      FechaIniTrabajo,
                      FechaFinTrabajo,
                      PorcentajeNota)
                      VALUES (
                        '$this->idTrabajo',
                        '$this->nombreTrabajo',
                        '$this->fechIniTrabajo',
                        '$this->fechFinTrabajo',
                        '$this->porcentajeNota'
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
            IdTrabajo,
            NombreTrabajo,
            FechaIniTrabajo,
            FechaFinTrabajo,
            PorcentajeNota
            FROM TRABAJO
            WHERE (
            (IdTrabajo LIKE REPLACE('%$this->idTrabajo%', ' ', '' ))&&
            (NombreTrabajo LIKE REPLACE('%$this->nombreTrabajo%', ' ', '' ))&&
            (FechaIniTrabajo LIKE REPLACE('%$this->FechIniTrabajo%', ' ', '' ))&&
            (FechaFinTrabajo LIKE REPLACE('%$this->fechFinTrabajo', ' ', '' ))&&
            (PorcentajeNota LIKE REPLACE('%$this->porcentajeNota%', ' ', '' ))
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
    $sql = "SELECT * FROM TRABAJO WHERE (IdTrabajo = '$this->idTrabajo')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
        // se construye la sentencia sql de borrado
        $sql = "DELETE FROM TRABAJO WHERE (IdTrabajo = '$this->idTrabajo')";
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
    $sql = "SELECT * FROM TRABAJO WHERE (IdTrabajo = '$this->idTrabajo')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si el numero de filas es igual a uno es que lo encuentra
    if ($result->num_rows == 1)
    {	// se construye la sentencia de modificacion en base a los atributos de la clase
        $sql = "UPDATE TRABAJO SET 
					IdTrabajo = '$this->idTrabajo',
					NombreTrabajo = '$this->nombreTrabajo',
					FechaIniTrabajo = '$this->fechIniTrabajo',
                    FechaFinTrabajo = '$this->fechFinTrabajo'
                    PorcentajeNota = '$this->porcentajeNota'
					
				WHERE ( IdTrabajo = '$this->idTrabajo'
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
        $sql = "SELECT * FROM TRABAJO WHERE (IdTrabajo = '$this->idTrabajo')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; //
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    } // fin del metodo RellenaDatos()
}//Fin de la clase TRABAJO

?>