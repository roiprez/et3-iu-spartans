<?php
/*Modelo de datos de NOTAS*/
class NOTAS_Model{   //Declaracion de la clase
    var $login;
    var $idTrabajo;
    var $notaTrabajo;

    var $mysqli;

    function __construct ($login,$idTrabajo,$notaTrabajo){
        $this->login = $login;
        $this->idTrabajo = $idTrabajo;
        $this->notaTrabajo= $notaTrabajo;

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
                else{//Si existe un solo trabajo en la BD con ese id.

                    if($this->login <> ''){//Comprueba que el campo idHistoria no está vacío

                        //Sentencia sql
                        $sql = "SELECT * FROM USUARIO WHERE (login= '$this->login')";
                    
                        if(!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                        return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
                        }
                        if($result->num_rows==0){//si no existe ese usuario

                            return 'No existe un usuario con ese login';

                        }else if($result->num_rows==1){//Si existe el usuario

                            //Sentencia sql que comprueba que hay una entrega con ese id de trabajo y ese login
                            $sql = "SELECT * FROM ENTREGA WHERE (login= '$this->login' AND IdTrabajo= '$this->idTrabajo')";

                            if(!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                             return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
                             }

                             if($result->num_rows==1){//Si hay un unico trabajo con ese id para esa persona

                                //sql busca si existe ya una nota para ese trabajo
                                $sql= "SELECT * FROM NOTA_TRABAJO WHERE (login= '$this->login' AND IdTrabajo= '$this->idTrabajo')";

                                if(!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
                                 return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
                                }

                                //Si no existe una nota para el trabajo del usuario
                                if($result->num_rows==0){

                                    //sql inserta nota
                                 $sql =  "INSERT INTO NOTA_TRABAJO (
                                 login,
                                 IdTrabajo,
                                 NotaTrabajo)
                                  VALUES (
                                    '$this->login',
                                    '$this->idTrabajo',
                                    '$this->notaTrabajo'
                                    )";

                                     if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
                            
                                     return 'Error en la inserción';
                        
                                    }else{ //si no da error en la insercion devolvemos mensaje de exito
                        
                                     return 'Inserción realizada con éxito'; //operacion de insertado correcta
                                    }

                                }else{

                                    return 'Ya existe una nota para este trabajo';
                                     }
                            
                            }else{

                             return 'No existe una entrega con este login y este id de trabajo';
                                 }
                        
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
            login,
            IdTrabajo,
            NotaTrabajo
            FROM NOTA_TRABAJO
            WHERE (
            (login LIKE '%$this->login%')&&
            (IdTrabajo LIKE '%$this->idTrabajo%')&&
            (NotaTrabajo LIKE '%$this->notaTrabajo%')
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
    $sql = "SELECT * FROM NOTA_TRABAJO WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
        // se construye la sentencia sql de borrado
        $sql = "DELETE FROM NOTA_TRABAJO WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
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
    $sql = "SELECT * FROM NOTA_TRABAJO WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si el numero de filas es igual a uno es que lo encuentra
    if ($result->num_rows == 1)
    {	// se construye la sentencia de modificacion en base a los atributos de la clase
        $sql = "UPDATE NOTA_TRABAJO SET 
					login = '$this->login',
					IdTrabajo = '$this->idTrabajo',
					NotaTrabajo = '$this->notaTrabajo'
					
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
        $sql = "SELECT * FROM NOTA_TRABAJO WHERE (IdTrabajo = '$this->idTrabajo' AND login = '$this->login')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; //
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    } // fin del metodo RellenaDatos()
}//Fin de la clase NOTAS






?>