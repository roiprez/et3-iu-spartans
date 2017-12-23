<script type="text/javascript">
/*
Este fichero se encarga de las validaciones de los formularios.
A lo largo del fichero hay validaciones que si se usan en campos del formulario cambian el estilo del campo a rojo si el valor es incorrecto
y lo convierten a blanco en caso de que se haya corregido.
25/11/2017 por 
*/



//encripta en md5 el valor del campo password
function encriptar(){
  document.getElementById('password').value = hex_md5(document.getElementById('password').value);
  return true;
}



//Comprueba la entidad a la que pertenece el form y lo redirige a la función que comprueba sus campos
function validarEntidad(entidad, formulario){
  //Si el formulario introducido tiene es search
	if (formulario == 'search'){

    //Lo manda a distintas funciones segun el valor de la entidad
	switch(entidad){
	
  	case 'usuario':
  	return validarBusquedaUsuario();
  	break;

  	case 'grupo':
  	return validarBusquedaGrupo();
  	break;

  	case 'funcionalidad':
  	return validarBusquedaFuncionalidad();
  	break;

  	case 'accion':
  	return validarBusquedaAccion();
  	break;

  	case 'trabajo':
  	return validarBusquedaTrabajo();
  	break;

  	case 'nota_trabajo':
  	return validarBusquedaNota();
  	break;

  	case 'entrega':
  	return validarBusquedaEntrega();
  	break;

  	case 'historia':
  	return validarBusquedaHistoria();
  	break;

  	case 'evaluacion':
  	return validarBusquedaEvaluacion();
  	break;
  	
  	default:
  	alert('Se ha alcanzado el default, el nombre de la entidad está mal en el submit de la vista');
  	}// fin switch
		
		//Si el valor de formulario no es search
	}else{
	
  //Lo manda a distintas funciones en funcion del valor del formulario
	switch(entidad){
	
	case 'usuario':
	return validarFormularioUsuario(formulario);
	break;
	case 'grupo':
	return validarFormularioGrupo(formulario);
	break;
	case 'funcionalidad':
	return validarFormularioFuncionalidad(formulario);
	break;
	case 'accion':
	return validarFormularioAccion(formulario);
	break;
	case 'trabajo':
	return validarFormularioTrabajo(formulario);
	break;
	case 'nota_trabajo':
	return validarFormularioNota(formulario);
	break;
	case 'entrega':
	return validarFormularioEntrega(formulario);
	break;
	case 'historia':
	return validarFormularioHistoria(formulario);
	break;
	case 'evaluacion':
	return validarFormularioEvaluacion(formulario);
	break;
	
	default:
  alert('Se ha alcanzado el default, el nombre de la entidad está mal en el submit de la vista');
	}//Fin switch
	
	}//Fin else
}






/*Se encarga de validar los formularios de ADD, EDIT y REGISTER de la entidad USUARIOS, una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioUsuario(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de ADD, de Registro o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  if(formulario == "reg"){
    objetivo = document.formulario_registro;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.login;
  //Comprueba que el login no está vacío y que tiene la cantidad de caracteres adecuada
  if(!comprobarVacio(campo)){
    return false;
  }
  if(!comprobarTexto(campo, 9)){
    return false; 
  }

  //Comprueba que la contraseña no está vacía y tiene la cantidad de caracteres adecuada
  campo = objetivo.password;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarTexto(campo, 128)){
    return false;
  }

  //Comprueba que el DNI no esté vacío y tiene un formato válido
  campo = objetivo.DNI;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarDni(campo,'')){
    return false;
  }
  
  //Comprueba que el nombre no esté vacío, que tiene el formato adecuado y que tiene la cantidad de caracteres adecuada
  campo = objetivo.Nombre;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarAlfabetico(campo, 30,'')){
    return false;
  }

  //Comprueba que el apellidos no esté vacío, que tiene el formato adecuado y que tiene la cantidad de caracteres adecuada
  campo = objetivo.Apellidos;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarAlfabetico(campo, 50,'')){
    return false;
  }

  //Comprueba que el email no está vacío y tiene un formato válido
  campo = objetivo.Correo;
  if(!comprobarVacio(campo)){
    return false; 
    }
  if(!comprobarEmail(campo, 40,'')){
    return false;
  }
  
//Comprueba que la direccion tenga un formato válido y que no esté vacía
  campo = objetivo.Direccion;
  
  if(!comprobarVacio(campo)){
    return false;
   }
   
  if(!comprobarTexto(campo, 60,'')){
    return false;
  }

   //Comprueba que el Teléfono no esté vacío y que tiene un formato válido
  campo = objetivo.Telefono;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarTelf(campo)){
    return false;
  }

  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}




/*Se encarga de validar los formularios de ADD o EDIT de la entidad GRUPOS,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioGrupo(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de ADD, de Registro o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.IdGrupo;
  //Comprueba que IdGrupo no está vacío y que tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que NombreGrupo no esté vacío, que tiene la cantidad de caracteres adecuada y que tenga el formato válido
  campo = objetivo.NombreGrupo;
  if((comprobarVacio(campo)) == false){
    return false;
   }

  if((comprobarAlfabetico(campo, 60,'')) == false){
    return false;
  }

  //Comprueba que DescripGrupo no esté vacío y que tiene un formato válido
  campo = objetivo.DescripGrupo;
  if((comprobarVacio(campo)) == false){
    return false;
   }
   if((comprobarTexto(campo, 100)) == false){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



/*Se encarga de validar los formularios de ADD, EDIT de la entidad HISTORIAS,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioHistoria(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.IdHistoria;
  //Comprueba que IdHistoria no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if(comprobarEntero(this, 0, 99)) == false){
    return false; 
  }

 //Comprueba que TextoHistoria no esté vacío y que tiene la cantidad de caracteres adecuada
  campo = objetivo.TextoHistoria;
  if((comprobarVacio(campo)) == false){
    return false;
   }

  if((comprobarTexto(campo, 300,'')) == false){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}




/*Se encarga de validar los formularios de ADD o EDIT de la entidad Funcionalidad,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioFuncionalidad(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de  ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.IdFuncionalidad;
  //Comprueba que IdFuncionalidad no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que NombreFuncionalidad no esté vacío, que tiene la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.NombreFuncionalidad;
  if((comprobarVacio(campo)) == false){
    return false;
   }

  if((comprobarAlfabetico(campo, 60,'')) == false){
    return false;
  }

  //Comprueba que DescripFuncionalidad no esté vacío y tenga la cantidad de carácteres adecuada
  campo = objetivo.DescripFuncionalidad;
  if((comprobarVacio(campo)) == false){
    return false;
   }
   if((comprobarTexto(campo, 100)) == false){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



/*Se encarga de validar los formularios de ADD o EDIT de la entidad EVALUACIONES,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioEvaluacion(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de  ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.IdTrabajo;
  //Comprueba que IdTrabajo no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que LoginEvaluador no esté vacío y que tiene la cantidad de caracteres adecuada
  campo = objetivo.LoginEvaluador;
  if((comprobarVacio(campo)) == false){
    return false;
   }

 if((comprobarTexto(campo, 9)) == false){
    return false; 
  }

  //Comprueba que AliasEvaluado no esté vacío y que tiene la cantidad de crácteres adecuada
  campo = objetivo.AliasEvaluado;
  if((comprobarVacio(campo)) == false){
    return false;
   }
   if((comprobarTexto(campo, 9)) == false){
    return false;
  }
//Comprueba que IdHistoria no está vacio, solo acepta enteros entre 0 y 99 y que sean enteros
  campo = objetivo.IdHistoria;
  if((comprobarVacio(campo)) == false){
    return false;
   }
   if((comprobarEntero(campo,0,99)) == false){
    return false;
  }
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}





/*Se encarga de validar los formularios de ADD o EDIT de la entidad ENTREGAS,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioEntrega(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de  ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.login;
  //Comprueba que el login no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que IdTrabajo no esté vacío y que tiene la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que Alias no esté vacía y tiene la cantidad de carácteres adecuada
  campo = objetivo.Alias;
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 9)) == false){
    return false; 
  }
//Comprueba que Horas sea un entero entre 0 y 99 y que no esté vacío
  campo = objetivo.Horas;
  
  if((comprobarEntero(campo,0,99)) == false){
    return false; 
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}


/*Se encarga de validar los formularios de ADD o EDIT de la entidad TRABAJO,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioTrabajo(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.IdTrabajo;
  //Comprueba que el login no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que la contraseña no está vacía y tiene la cantidad de caracteres adecuada
  campo = objetivo.NombreTrabajo;
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarAlfabetico(campo, 60)) == false){
    return false; 
  }

  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



/*Se encarga de validar los formularios de ADD o EDIT de la entidad Accion,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioAccion(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de  ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.IdAccion;
  //Comprueba que el IdAccion no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 6)) == false){
    return false; 
  }

  //Comprueba que NombreAccion no esté vacío y tiene el formato válido
  campo = objetivo.NombreAccion;
  if((comprobarVacio(campo)) == false){
    return false;
   }

  if((comprobarAlfabetico(campo, 60,'')) == false){
    return false;
  }

  //Comprueba que el DescripAcccion no está vacío y tiene un numero de carácteres válido
  campo = objetivo.DescripAccion;
  if((comprobarVacio(campo)) == false){
    return false;
   }
   if((comprobarTexto(campo, 100)) == false){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



/*Se encarga de validar los formularios de ADD o EDIT de la entidad NOTA_TRABAJO,  una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormularioNotaTrabajo(formulario){
  //Contendrá la referencia al formulario que queremos validar
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;

  //Comprueba que el formulario es el de  ADD o EDIT y le asigna a la variable objetivo la referencia correspondiente
  if(formulario == "add"){
    objetivo = document.formulario_add;   
  }
  else if(formulario == "edit"){
    objetivo = document.formulario_edit;
  } 
  campo = objetivo.login;
  //Comprueba que el login no está vacío y tiene la cantidad de caracteres adecuada
  if((comprobarVacio(campo)) == false){
    return false;
  }
  if((comprobarTexto(campo, 9)) == false){
    return false; 
  }

  //Comprueba que IdTrabajo no esté vacío y tiene la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if((comprobarVacio(campo)) == false){
    return false;
   }

  if((comprobarTexto(campo,6)) == false){
    return false;
  }

  //Comprueba que el NotaTrabajo no esté vacía y que sea un entero con valores entre 0 y 10
  campo = objetivo.NotaTrabajo;
  if((comprobarVacio(campo)) == false){
    return false;
   }
   if((comprobarReal(campo,3,0,10)) == false){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Valida la búsqueda de un usuario
function validarBusquedaUsuario(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que el login tenga la cantidad de caracteres adecuada
  campo = objetivo.login;
  if(!comprobarTexto(campo, 9)){
    return false; 
  }
  
  //Comprueba que la contraseña tenga la cantidad de caracteres adecuada
  campo = objetivo.password;
  if(!comprobarTexto(campo, 128)){
    return false;
  }
  
  
  //Comprueba que el DNI tenga un formato válido
  campo = objetivo.DNI;

  if(!comprobarDni(campo,'search')){
    return false;
  }
  
  
  //Comprueba que el nombre tenga la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.Nombre;
  if(!comprobarAlfabetico(campo, 30,'search')){
    return false;
  }
  
  
  //Comprueba que los apellidos tengan la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.Apellidos;

  if(!comprobarAlfabetico(campo, 50,'search')){
    return false;
  }
  
  //Comprueba que la direccion tenga la cantidad de caracteres adecuada
  campo = objetivo.Direccion;

  if(!comprobarTexto(campo, 60)){
    return false;
  }
  
  //Comprueba que el email tenga un formato válido
  campo = objetivo.Correo;
  
  if(!comprobarEmail(campo, 40,'search')){
    return false;
  }
 
  //Comprueba que el Teléfono tiene un formato válido
  campo = objetivo.Telefono;
 
  if(!comprobarTelfSearch(campo)){
    return false;
  }
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Valida la búsqueda de un grupo
function validarBusquedaGrupo(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que IdGrupo tenga la cantidad de caracteres adecuada
  campo = objetivo.IdGrupo;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  
  //Comprueba que el nombre de grupo tenga la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.NombreGrupo;
  if(!comprobarAlfabetico(campo, 60,'search')){
    return false;
  }
  
  
  //Comprueba que DescripGrupo tengan la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.DescripGrupo;

  if(!comprobarTexto(campo, 100)){
    return false;
  }
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}


//Valida la búsqueda de una funcionalidad
function validarBusquedaFuncionalidad(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que el IdFuncionalidad tenga la cantidad de caracteres adecuada
  campo = objetivo.IdFuncionalidad;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  
  //Comprueba que el nombreFuncionalidad tenga la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.NombreFuncionalidad;
  if(!comprobarAlfabetico(campo, 60,'search')){
    return false;
  }
  
  
  //Comprueba que la descripFuncionalidad tengan la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.DescripFuncionalidad;

  if(!comprobarTexto(campo, 100,'search')){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}


//Valida la búsqueda de una accion
function validarBusquedaAccion(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que IdAccion tenga la cantidad de caracteres adecuada
  campo = objetivo.IdAccion;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  //Comprueba que el nombreAccion tenga la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.NombreAccion;
  if(!comprobarAlfabetico(campo, 60,'search')){
    return false;
  }
  
  
  //Comprueba que DescripAccion tengan la cantidad de caracteres adecuada
  campo = objetivo.DescripAccion;

  if(!comprobarTexto(campo, 100,'search')){
    return false;
  }
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Valida la búsqueda de un trabajo
function validarBusquedaTrabajo(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que IdTrabajo tenga la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  //Comprueba que NombreTrabajo tenga la cantidad de caracteres adecuada y el formato válido
  campo = objetivo.NombreTrabajo;
  if(!comprobarAlfabetico(campo, 60,'search')){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Valida la búsqueda de una nota
function validarBusquedaNota(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que el login tenga la cantidad de caracteres adecuada
  campo = objetivo.login;
  if(!comprobarTexto(campo, 9)){
    return false; 
  }
  
  //Comprueba que IdTrabajo tenga la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  //Comprueba que NotaTrabajo tenga la cantidad de caracteres adecuada
  campo = objetivo.NotaTrabajo;
  if(!comprobarTexto(campo, 4)){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}

//Valida la búsqueda de un usuario
function validarBusquedaEntrega(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que el login tenga la cantidad de caracteres adecuada
  campo = objetivo.login;
  if(!comprobarTexto(campo, 9)){
    return false; 
  }
  
   //Comprueba que IdTrabajo tenga la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  //Comprueba que Alias tenga la cantidad de caracteres adecuada
  campo = objetivo.Alias;
  if(!comprobarTexto(campo, 9)){
    return false;
  }
  
  //Comprueba que Horas tenga la cantidad de carácteres adecuada
  campo = objetivo.Horas;

  if(!comprobarTexto(campo,2)){
    return false;
  }
  
  
  //Comprueba que la ruta tenga la cantidad de caracteres adecuada
  campo = objetivo.Ruta;
  if(!comprobarTexto(campo, 60)){
    return false;
  }
  
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Valida la búsqueda de una historia
function validarBusquedaHistoria(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
  //Comprueba que IdTrabajo tenga la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  //Comprueba que TextoHistoria tenga la cantidad de caracteres adecuada
  campo = objetivo.TextoHistoria;
  if(!comprobarTexto(campo, 300)){
    return false;
  }
 
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Valida la búsqueda de una evaluacion
function validarBusquedaEvaluacion(){
 
 //Contendrá la referencia al formulario search
  let objetivo;
  //Contendrá la referencia al campo a validar
  let campo;
 
  //Se le asigna a objetivo el valor del formulario_search
  objetivo = document.formulario_search;
  
   //Comprueba que IdTrabajo tenga la cantidad de caracteres adecuada
  campo = objetivo.IdTrabajo;
  if(!comprobarTexto(campo, 6)){
    return false; 
  }
  
  //Comprueba que LoginEvaluador tenga la cantidad de caracteres adecuada
  campo = objetivo.LoginEvaluador;
  if(!comprobarTexto(campo, 9)){
    return false;
  }
  
   //Comprueba que AliasEvaluado tenga la cantidad de caracteres adecuada
  campo = objetivo.AliasEvaluado;
  if(!comprobarTexto(campo, 9)){
    return false;
  }
  
  //Comprueba que IdHistoria tenga la cantidad de caracteres adecuada
  campo = objetivo.IdHistoria;
  if(!comprobarTexto(campo, 2)){
    return false; 
  }
  
  
  //Comprueba que ComenIncorrectoA tenga un formato válido
  campo = objetivo.ComenIncorrectoA;

  if(!comprobarTexto(campo,300)){
    return false;
  }
  
  
  //Comprueba que ComenIncorrectoP tenga un formato válido
  campo = objetivo.ComenIncorrectoP;

  if(!comprobarTexto(campo,300)){
    return false;
  }
  
  //Devuelve true una vez hemos comprobado todos los campos sin fallar ninguna validación
  return true;
}



//Comprueba que el campo no está vacío
function comprobarVacio(campo){
  //Valor almacena el valor del campo quitando los espacios en blanco al principio y final del fichero
  const valor = campo.value.replace(/^\s+|\s+$/g,"");
  //Comprueba que el valor sea nulo o de longitud 0 y lanza una alerta y retorna falso, si no se cumple devuelve true
  if ((valor == null) || (valor.length == 0)){
    alert('El atributo ' + campo.name + ' no puede ser vacio');
    campo.focus();
    campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
    return false;
  }
  else{
    campo.style.backgroundColor = "white";
    return true;
  }
}

//Comprueba que el campo no supere la longitud indicada por la variable size
function comprobarTexto(campo, size){
  //Si supera la longitud que le pasamos por parámetro devuelve una alerta y un false, en caso contrario un true
  if (campo.value.length>size) {
      alert('Longitud incorrecta. El atributo ' + campo.name + ' debe ser maximo ' + size + ' y es ' + campo.value.length);
      campo.focus();
      campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
      return false;
    }
    campo.style.backgroundColor = "white";
    return true;
  }

 //Comprueba que el campo solo contenga carácteres alfabéticos 
  function comprobarAlfabetico(campo, size, formulario){
	  //Si el formulario es search
    if(formulario == 'search'){
		  if(campo.value.length==0){//Si el valor del campo está vacio, que devuelva cierto
		
		return true;
	}
if (!campo.value.match(/^[a-zA-ZÁÉÍÓÚÜáéíóüúñÑ-\s]*$/)){//Si el valor del campo contiene algo que no sea un caracter alfabetico permitido en nuestro idioma,devuelve falso y un aviso indicando el campo que tiene el error
		//Si el campo es nombre
    if(campo.name=='Nombre'){
		alert('El campo nombre solo puede contener letras');
		
		campo.focus();
		return false;
		}
		//Si el campo es direccion
		if(campo.name=='Direccion'){
		alert('El campo direccion solo puede contener letras');
		
		campo.focus();
		return false;
		}
		//Si el campo es apellidos
		if(campo.name=='Apellidos'){
		alert('El campo apellidos solo puede contener letras');
		campo.focus();
		return false;
		}
}
if (campo.value.length>size){//Si el numero de caracteres del campo es mayor que el tamaño permitido, que devuelva false{
		//Si el campo es nombre
    if(campo.name=='Nombre'){
			alert( 'El tamaño de nombre sobrepasa');
			
			campo.focus();
			return false;
		}
		//Si el campo es direccion
		if(campo.name=='Direccion'){
		alert('El tamaño de direccion sobrepasa');
		
		campo.focus();
		return false;
		}
		//Si el campo es apellidos
		if(campo.name=='Apellidos'){
			alert('El tamaño de apellidos sobrepasa');
			
			campo.focus();
			return false;
		}
    }

	return true;//Si ninguno de los if anteriores se cumple,devuelve true	
		  
		  
	  }else{//Sino

			  //Si supera la longitud que le pasamos por parámetro devuelve una alerta y un false
			  if (campo.value.length>size) {
				alert('Longitud incorrecta. El atributo ' + campo.name + ' debe ser maximo ' + size + ' y es ' + campo.value.length);
				campo.focus();
				campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
				return false;
			  }
			  //Si el campo está vacío devuelve falso pero reestablece el color de fondo
			  else if(campo.value.trim().length === 0){
				campo.style.backgroundColor = "white";
				return false;
			  }
			  //Comprueba con la expresión regular que solo se incluyen caracteres alfabéticos y devuelve true en caso afirmativo, y una alerta y false en el contrario
			  else if (/^[a-zA-ZÁÉÍÏÓÚÜáéíïóüúñÑ-\s]+$/.test(campo.value)){
				campo.style.backgroundColor = "white";
				return true;
				} 
				else{//Sino
				alert('El atributo '+ campo.name +'  no admite caracteres no alfabéticos');
				campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
				return false;
			  }	  
			}
}



//Funcion que comprueba que un numero sea entero y se situe entre dos valores
function comprobarEntero(campo, valormenor, valormayor){
  //Si el valor del campo está vacio, que devuelva cierto
  if(campo.value.length==0){
    return true;
    
  }else
    //Si el valor del campo empieza  por uno o mas numeros seguidos de punto o coma y terminan por numero
    if ( /^[0-9]+/.test(campo.value)){ 
        
        //Comprueba si el valor del campo tiene decimales y devuelve false y un aviso junto al nombre del campo si los tiene
        if(/^[0-9]*(\.|,)[0-9]*$/.test(campo.value)){
          alert("El campo "+campo.name+" no puede contener decimales");
          return false;
        }else
        //Si el valor del campo es mayor que el valor maximo, devuelve false y un aviso indicando que campo tiene el error
        if(campo.value>valormayor){
        alert("El tamaño de " + campo.name + " sobrepasa"); 
        return false;
        }else
          //Si el valor del campo es mayor que el valor maximo, devuelve false y un aviso indicando que campo tiene el error
          if(campo.value<valormenor){
          alert("El tamaño de " + campo.name + " no es lo suficientemente grande"); 
          return false;
        }else 
        //Comprueba que el numero sea entero y sino lo es devuelve false y un aviso indicando cual es el campo que tiene el error
        if(/(^[0-9]+)$/.test(campo.value)==false){
        alert('Solo puedes escribir numeros enteros en : '+campo.name);
        return false;
        }else //Si lo anterior no se cumple,devuelve true
            return true;
      }else{//Sino
        alert('Solo puedes escribir numeros');
        return false;
        }
}


//Comprueba que un numero sea real,comprueba el numero de decimales y que el valor esté entre dos valores
function comprobarReal(campo, numerosdecimales, valormenor, valormayor){
  var numero=campo.value; // variable numero que tiene el valor que tiene el campo
  //Si el campo está vacio,devuelve cierto
  if(numero.length==0){
    return true;
  }

  //Comprueba que el campo sea un numero real con parte decimal indicada por punto o coma
  else if (/^([-]?[0-9]+)(\.|,)?[0-9]*$/.test(campo.value)){
    //Comprueba si el numero real es mayor que el maximo valor permitido y si lo es, devuelve false
     if(numero>valormayor){
        alert("El tamaño de " + campo.name + " sobrepasa"); 
        return false;
          }else 
          //Comprueba si el numero real es menor que el numero minimo permitido y si lo es,devuelve false 
          if(numero<valormenor){
                  alert("El tamaño de " + campo.name + " no es lo suficientemente grande"); 
                  return false;
              }else{
                //Coge la parte decimal del valor y pone cada digito decimal en un array y cuenta los numeros que son, si son mayores que los permitidos, devuelve false
              if ( numero.split(/\.|,/)[1].length>numerosdecimales){
              alert('El campo'+ campo.name + 'sobrepasa numero de decimales');
              return false;
              }
            }
  }else{
    //Si el numero no es real, devuelve false y un aviso
    alert('Solo puedes escribir numeros reales');
    return false;
    }

}



//Comprueba que el formato del dni sea correcto
function comprobarDni(campo,formulario){
	//Si el formulario es search
	if(formulario == 'search'){
					//Si la longitud del campo es 0
					if(campo.value.length==0){
						return true;
            //Sino si el valor del campo es menor de 9(tamaño maximo de dni)
				}else if(campo.value.length<9){
					if(/[a-z-A-Z]{2,}/.test(campo.value)){//Comprueba que solo haya una letra 
						alert('Los dni solo tienen una letra mayúscula');
						campo.focus();
						
						return false;
					} else if(/^[0-9]+[a-z]+$/.test(campo.value) || (/^[a-z]+$/.test(campo.value) )){ //Comprueba que tenga una letra mayuscula
						alert('Los dni solo tienen una letra mayúscula');
						campo.focus();
						
						return false;
					}else{//Sino, devuelve cierto
					
					return true;
					}
					
				}else{//Si la longitud es de 9 o mayor
						if(campo.value.trim().length === 0){
						
						return false;
						}
						if(/^[a-z]+$/.test(campo.value)){//Comprueba que la letra DNI sea mayuscula y sino lo es, de un aviso
							alert('Los Dni se escriben con mayuscula');
							campo.focus();
							
							return false;
						}else{
							//Se mete en una variable una subcadena del valor de campo
							  numero = campo.value.substr(0,campo.value.length-1);
							  //Se mete en otra variable una subcadena del valor de campo
							  let = campo.value.substr(campo.value.length-1,1);
							  //Se coge el resto de la division de la primera variable entre 23
							  numero = numero % 23;
							  //Se forma un array con todas las letras en mayuscula
							  letra='TRWAGMYFPDXBNJZSQVHLCKET';
							  //Se hace una cadena con letra 
							  letra=letra.substring(numero,numero+1);
							  //Si el valor de la variable letra no coincide con la letra mayuscula del campo,se devuelve false y un error.Si coinciden,devuelve true
							  if (letra!=let) {
								alert('Dni erroneo');
							return false;
							}
						return true;
					}
				}
				
	}else{
		
		if((/^[0-9]*[a-z]+$/.test(campo.value))){//Comprueba que la letra DNI sea mayuscula y sino lo es, de un aviso
							alert('Los Dni se escriben con mayuscula');
							campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
							campo.focus();
							return false;
						}else{
							//Se mete en una variable una subcadena del valor de campo
							  numero = campo.value.substr(0,campo.value.length-1);
							  //Se mete en otra variable una subcadena del valor de campo
							  let = campo.value.substr(campo.value.length-1,1);
							  //Se coge el resto de la division de la primera variable entre 23
							  numero = numero % 23;
							  //Se forma un array con todas las letras en mayuscula
							  letra='TRWAGMYFPDXBNJZSQVHLCKET';
							  //Se hace una cadena con letra 
							  letra=letra.substring(numero,numero+1);
							  //Si el valor de la variable letra no coincide con la letra mayuscula del campo,se devuelve false y un error.Si coinciden,devuelve true
							  if (letra!=let) {
								alert('Dni erroneo');
								campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
								campo.focus();
                //Si el valor del campo sin espacios es 0
								if(campo.value.trim().length == 0){
								campo.style.backgroundColor = "white";
								return false;
								}
							return false;
							}
						campo.style.backgroundColor = "white";	
						return true;
						}		
	}
 	
}

//Comprueba que el email tiene un formato correcto y que el tamaño no excede el límite de size
function comprobarEmail(campo,size,formulario){
	
	if(formulario == 'search'){
					//Comprueba que el campo tenga una longitud superior a la indicada y lanza una alerta y devuelve un false en ese caso
			  if (campo.value.length>size) {
				alert('Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + size + ' y es ' + campo.value.length);
				campo.focus();
				
				return false;
			  }

			  return true;
					
	}else{
    //Si el valor del campo sin espacios es igual a 0
	if(campo.value.trim().length == 0){
    campo.style.backgroundColor = "white";
    return false;}
  //Comprueba que el campo tenga una longitud superior a la indicada y lanza una alerta y devuelve un false en ese caso
  if (campo.value.length>size) {
    alert('Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + size + ' y es ' + campo.value.length);
    campo.focus();
    campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
    return false;
  }
  //Comprueba que el email no tiene un formato adecuado y devuelve una alerta y un false en ese caso
  if(!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(campo.value))) {
    alert("El email tiene un formato incorrecto");
    campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
    return false;
  }

  campo.style.backgroundColor = "white";
  return true;
	}
}

//Funcion que comprueba que el campo telefono que se le pase tenga un formato válido
function comprobarTelf(campo) {
	if(campo.value.length==0){//Si el campo telefono esta vacio que devuelva true
	campo.style.backgroundColor = "white";
		return true;
	}
	
	if(/^[0-9]+$/.test(campo.value)==false){//Si el formato del campo  tiene algo que no sea un numero devuelve un alert
		alert('El telefono solo tiene numeros');
		campo.focus();
		campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
		return false;
	}
	//Si el campo no coincide con la expresion regular que indica los numeros de telefono validos
	if(/^(((34)?)?[9|8|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/.test(campo.value)){
		campo.style.backgroundColor = "white";
		return true;
	}else{
		
		//Si el numero no coincide,devuelve false y un aviso explicando los formatos de numero permitidos
		alert('Telefono malo, indicalo en uno de los siguientes formatos: 34(puedes escribirlo o no) 9XXXXXXXX | 8XXXXXXXX | 7XXXXXXXX | 6XXXXXXXX ');
		campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
		return false;
		}
}

//Funcion que comprueba que el formato de telefono para la vista search de usuarios sea válido
function comprobarTelfSearch(campo) {
	if(campo.value.length==0){//Si el campo telefono esta vacio que devuelva true
	
		return true;
	}
  //Si el campo tiene algo que no sean numeros devuelve un alert
	if(/^[0-9]+$/.test(campo.value)==false){
		alert('El telefono solo tiene numeros');
		
		campo.focus();
		return false;
	}
	//Si la longitud es menor a 11 devuelve cierto siempre
	if(campo.value.length<11){
		 
		return true;
    //Si no lo es, comprueba que el campo tenga un formato válido
	}else if(/^((34)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/.test(campo.value)){
		 
		return true;
	}else{ //Si no tiene un formato válido
		
		//devuelve false y un aviso explicando los formatos de numero permitidos
		alert('Telefono malo, indicalo en uno de los siguientes formatos: 34(puedes escribirlo o no) 9XXXXXXXX | 6XXXXXXXX ');
		
		campo.focus();
		return false;
		}
}
</script>