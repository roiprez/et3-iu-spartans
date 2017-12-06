<?php
/*Modelo de datos de ENTREGA*/
class ENTREGAS_Model{   //Declaracion de la clase
    var $idTrabajo;
    var $login;
    var $alias;
    var $horas;
    var $ruta;

    var $mysqli;

    function __construct ($idTrabajo,$login,$alias,$horas,$ruta){
        $this->idTrabajo = $idTrabajo;
        $this->login = $login;
        $this->alias= $alias;
        $this->horas= $horas;
        $this->ruta= $ruta;

        //Creamos el conector a la base de datos
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConectarBD();
    }

    function ADD()
    {
        if ($this->idTrabajo <> ''){//Se comprueba que el primer campo clave no este vacio
            //sentencia sql
            $sql = "SELECT * FROM TRABAJO WHERE (IdTrabajo= '$this->idTrabajo')";

            if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
            }

            else{// si la query no da error

                if($result->num_rows == 0){//Comprueba que no existe el trabajo en la BD.
                    return 'El trabajo con este id no existe en la base de datos.';//Avisa de que no existe ningun trabajo con ese id.
                }
                else if($result->num_rows == 1){//Si existe un solo trabajo en la BD con ese id.

                    if($this->login <> ''){//Comprueba que el campo login no está vacío

                        //Sentencia sql
                        $sql = "SELECT * FROM ENTREGA WHERE (login= '$this->login' AND IdTrabajo = '$this->idTrabajo')";
                    
                        if(!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                        return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
                        }

                        if($result->num_rows == 0){//miramos que la clave2 no exista en la BD asociada a ese trabajo
                        //Sentencia SQL
                            $sql =  "INSERT INTO ENTREGA (
                                 IdTrabajo,
                                 login,
                                 Alias)
                                  VALUES (
                                    '$this->idTrabajo',
                                    '$this->login',
                                    '$this->alias',
                                    '$this->horas',
                                    '$this->ruta'
                                )";

                            if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
                            
                            return 'Error en la inserción';
                        
                            }else{ //si no da error en la insercion devolvemos mensaje de exito
                        
                                return 'Inserción realizada con éxito'; //operacion de insertado correcta
                            }

                        }else{
                            return 'Ya existe en la base de datos';
                        }
                    }else{
                         // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
                         return 'Introduzca un valor para login'; // introduzca un valor para el usuario
                    }

                }
               
             }
        }
        else{ // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
            return 'Introduzca un valor para IdTrabajo'; // introduzca un valor para el usuario
        }
    } // fin del metodo ADD


function SEARCH(){
//Se contruye la sentencia de busqueda usando Like
    $sql= "SELECT
            IdTrabajo,
            login,
            Alias,
            Horas,
            Ruta
            FROM ENTREGA
            WHERE (
            (IdTrabajo LIKE '%$this->idTrabajo%')&&
            (login LIKE '%$this->login%')&&
            (Alias LIKE '%$this->alias%')&&
            (Horas LIKE '%$this->horas%')&&
            (Ruta LIKE '%$this->ruta%')
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
    $sql = "SELECT * FROM ENTREGA WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
        // se construye la sentencia sql de borrado
        $sql = "DELETE FROM ENTREGA WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
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
    $sql = "SELECT * FROM ENTREGA WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si el numero de filas es igual a uno es que lo encuentra
    if ($result->num_rows == 1)
    {	// se construye la sentencia de modificacion en base a los atributos de la clase
        $sql = "UPDATE ENTREGA SET 
					IdTrabajo = '$this->idTrabajo',
					login = '$this->login',
					Alias = '$this->alias',
					Horas = '$this->horas',
					Ruta = '$this->ruta'
          
					
				WHERE ( IdTrabajo = '$this->idTrabajo' AND login = '$this->login'
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
        $sql = "SELECT * FROM ENTREGA WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; //
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    } // fin del metodo RellenaDatos()
}//Fin de la clase ENTREGA
?>