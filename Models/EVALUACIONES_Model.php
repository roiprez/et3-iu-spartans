<?php

/*
El Modelo de los datos de evaluaciones, se encarga de ejecutar las operaciones de la aplicación contra la base de datos
8/12/2017 por 
*/

class EVALUACIONES_Model { //declaración de la clase

	var $IdTrabajo;
	var $LoginEvaluador;
	var $AliasEvaluado;
	var $IdHistoria;
	var $CorrectoA;
	var $ComenIncorrectoA;
	var $CorrectoP;
	var $ComentIncorrectoP;
	var $OK;
	
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase


function __construct($IdTrabajo,$LoginEvaluador,$AliasEvaluado,$IdHistoria,$CorrectoA,$ComenIncorrectoA,$CorrectoP,$ComentIncorrectoP,$OK){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdTrabajo = $IdTrabajo;
	$this->LoginEvaluador = $LoginEvaluador;
	$this->AliasEvaluado = $AliasEvaluado;
	$this->IdHistoria = $IdHistoria;
	$this->CorrectoA = $CorrectoA;
	$this->ComenIncorrectoA = $ComenIncorrectoA;
	$this->CorrectoP = $CorrectoP;
	$this->ComentIncorrectoP = $ComentIncorrectoP;
	$this->OK = $OK;
	

	// incluimos la funcion de acceso a la bd
	include_once '../Models/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConectarBD();

} // fin del constructor


function ADD()
{	
	$sql1 = "SELECT * FROM ASIGNAC_QA WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') ";
	// se construye la sentencia de busqueda de la tupla en la bd
	if (!$result = $this->mysqli->query($sql1))  // si da error la ejecución de la query
		return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
					
	else {// si la query no da error
		if ($result->num_rows == 1){
			//sentencia que las historias de un trabajo para un alias y un login determinados
			$sql2= "SELECT * FROM HISTORIA WHERE (IdTrabajo = '$this->IdTrabajo') && (IdHistoria = '$this->IdHistoria')";
			if (!$result = $this->mysqli->query($sql2))  // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
			
			else {// si la query no da error
				if ($result->num_rows == 1){ //Si existe en la tabla Historia el IdTrabajo y el IdHistoria indicados
					$sql3= "SELECT * FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') && (IdHistoria = '$this->IdHistoria')";
					if (!$result = $this->mysqli->query($sql3))  // si da error la ejecución de la query
						return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
			
					else {// si la query no da error
						if ($result->num_rows == 0){
							$sql = "INSERT INTO EVALUACION(
										IdTrabajo,
										LoginEvaluador,
										AliasEvaluado,
										IdHistoria,
										CorrectoA,
										ComenIncorrectoA,
										CorrectoP,
										ComentIncorrectoP,
										OK)
										VALUES(
										'$this->IdTrabajo',
										'$this->LoginEvaluador',
										'$this->AliasEvaluado',
										'$this->IdHistoria',
										'$this->CorrectoA',
										'$this->ComenIncorrectoA',
										'$this->CorrectoP',
										'$this->ComentIncorrectoP',
										'$this->OK')";
										
										if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
											return 'Error al añadir la tupla';
										}//Fin if
										else{ //si no da error en la insercion devolvemos mensaje de exito
											return 'Tupla añadida con éxito'; //operacion de insertado correcta
										}//Fin else			
									}else{//Fin if
									return 'La historia de este trabajo ya existe';
									}
								}//Fin else
				 
				 
				 }//Fin if comprobacion de que tenga historias
			}//Fin else
				
		}else{
			return 'El login no tiene que evaluar el trabajo o al alias indicado';
		}
	}//Fin else
}//Fin funcion ADD


function EDIT()
{
		//No estoy del todo seguro de que esta sentencia sea necesario
	$sql1 = "SELECT * FROM ASIGNAC_QA WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') ";
			// se construye la sentencia de busqueda de la tupla en la bd
			if (!$result = $this->mysqli->query($sql1))  // si da error la ejecución de la query
						return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
					
		else {// si la query no da error
		if ($result->num_rows == 1){
					//sentencia que las historias de un trabajo para un alias y un login determinados
			$sql2= "SELECT IdHistoria FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado')";
			if (!$result = $this->mysqli->query($sql2))  // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
			
			else {// si la query no da error
				 if ($result->num_rows == 0){ //Si no tienen asignadas historias se le añaden automaticamente
				 //Sentencia que devuelve todas las historias de un trabajo determinado
				 $sql3 = "SELECT IdHistoria FROM HISTORIA WHERE (IdTrabajo = '$this->IdTrabajo')";
								if(!$result = $this->mysqli->query($sql3))
									return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
								
								else{
									//Mientras haya más historias en el recordset, se insertan en la tabla EVALUACION
									while($row = $result->fetch_array()){
									$sql = "INSERT INTO EVALUACION(
										IdTrabajo,
										LoginEvaluador,
										AliasEvaluado,
										IdHistoria,
										CorrectoA,
										ComenIncorrectoA,
										CorrectoP,
										ComentIncorrectoP,
										OK)
										VALUES(
										'$this->IdTrabajo',
										'$this->LoginEvaluador',
										'$this->AliasEvaluado',
										'$row[0]',
										'',
										'',
										'',
										'',
										'')";
										
										if (!$this->mysqli->query($sql)) { // si da error en la ejecución del insert devolvemos mensaje
											return 'Error al añadir la tupla';
										}//Fin if
										else{ //si no da error en la insercion devolvemos mensaje de exito
											return 'Tupla añadida con éxito'; //operacion de insertado correcta
										}//Fin else			
									}//Fin bucle while
									
								}//Fin else
				 
				 
				 }//Fin if comprobacion de que tenga historias

			}//Fin else
				
		}else{
		return 'El login no tiene que evaluar el trabajo o al alias indicado';
		}
	}//Fin else
	
	// se construye la sentencia de busqueda de la tupla en la bd
    $sql = "SELECT * FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') && (IdHistoria = '$this->IdHistoria')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si el numero de filas es igual a uno es que lo encuentra
    if ($result->num_rows == 1)
    {	// se construye la sentencia de modificacion en base a los atributos de la clase
		$sql = "UPDATE EVALUACION SET 
					IdTrabajo = '$this->IdTrabajo',
					LoginEvaluador = '$this->LoginEvaluador',
					AliasEvaluado = '$this->AliasEvaluado',
					IdHistoria = '$this->IdHistoria',
					CorrectoA = '$this->CorrectoA',
					ComenIncorrectoA = '$this->ComenIncorrectoA',
					CorrectoP = '$this->CorrectoP',
					ComentIncorrectoP = '$this->ComentIncorrectoP',
					OK = '$this->OK'
				WHERE ( (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') && (IdHistoria = '$this->IdHistoria')
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



//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

} // fin del metodo destruct


//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
function SEARCH()
{ 	// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
		$sql = "SELECT
					*
       			FROM EVALUACION
    			WHERE
    				(
					(IdTrabajo LIKE REPLACE('%$this->IdTrabajo%', ' ', '' )) &&
					(LoginEvaluador LIKE REPLACE('%$this->LoginEvaluador%', ' ', '' )) &&
	 				(AliasEvaluado LIKE REPLACE('%$this->AliasEvaluado%', ' ', '' )) &&
	 				(IdHistoria LIKE REPLACE('%$this->IdHistoria%', ' ', '' ))
    				)";
    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la consulta sobre la base de datos';
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
} // fin metodo SEARCH

function SEARCH_STRICT_EV()
{ 	// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
	$sql = "SELECT
				*
					 FROM EVALUACION
				WHERE
					(
						(IdTrabajo LIKE REPLACE('$this->IdTrabajo', ' ', '' )) &&
						 (AliasEvaluado LIKE REPLACE('$this->AliasEvaluado', ' ', '' ))
					)";
	// si se produce un error en la busqueda mandamos el mensaje de error en la consulta
	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la consulta sobre la base de datos';
	}
	else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
} // fin metodo SEARCH

function SEARCH_STRICT_QA()
{ 	// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
	$sql = "SELECT
				*
					 FROM EVALUACION
				WHERE
					(
						(IdTrabajo LIKE REPLACE('$this->IdTrabajo', ' ', '' )) &&
						(LoginEvaluador LIKE REPLACE('$this->LoginEvaluador', ' ', '' ))
					)";
	// si se produce un error en la busqueda mandamos el mensaje de error en la consulta
	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la consulta sobre la base de datos';
	}
	else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
} // fin metodo SEARCH

// funcion DELETE()
// comprueba que exista el valor de clave por el que se va a borrar,si existe se ejecuta el borrado, sino
// se manda un mensaje de que ese valor de clave no existe
function DELETE()
{	// se construye la sentencia sql de busqueda con los atributos de la clase
    $sql = "SELECT * FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') && (IdHistoria = '$this->IdHistoria')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') && (IdHistoria = '$this->IdHistoria')";
        // se ejecuta la query
        $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
    	return "Borrado correctamente";
    } // si no existe el login a borrar se devuelve el mensaje de que no existe
    else
        return "No existe";
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo') && (LoginEvaluador = '$this->LoginEvaluador') && (AliasEvaluado = '$this->AliasEvaluado') && (IdHistoria = '$this->IdHistoria')";
    // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe en la base de datos'; // 
	}
    else{ // si existe se devuelve la tupla resultado
		$result = $resultado->fetch_array();
		return $result;
	}
} // fin del metodo RellenaDatos()


}//fin de clase

?> 
