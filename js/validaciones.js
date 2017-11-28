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
/*
//Comprueba la entidad a la que pertenece el form y lo redirige a la función que comprueba sus campos
function validarEntidad(entidad, formulario){
	
	switch(entidad)
	
	case 'usuario'
	validarFormularioUsuario(formulario);
	break;
	case 'grupo'
	validarFormularioGrupo(formulario);
	break;
	case 'funcionalidad'
	validarFormularioFuncionalidad(formulario);
	break;
	case 'accion'
	validarFormularioAccion(formulario);
	break;
	case 'trabajo'
	validarFormularioTrabajo(formulario);
	break;
	case 'nota_trabajo'
	validarFormularioNota(formulario);
	break;
	case 'entrega'
	validarFormularioEntrega(formulario);
	break;
	case 'historia'
	validarFormularioHistoria(formulario);
	break;
	case 'evaluacion'
	validarFormularioEvaluacion(formulario);
	break;
	
	default:
	alert('algo ha petado');
	
}*/


/*Se encarga de validar los formularios de ADD, EDIT y REGISTER una vez enviados, 
la variable formulario nos indica cual de los tres formularios hay que validar.
Si alguna validación falla devuelve false y termina la función, si llega al final
sin incidencias devuelve true*/
function validarFormulario(formulario){
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
  //Comprueba que el login no está vacío y tiene la cantidad de caracteres adecuada
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

  //Comprueba que el DNI no está vacía y tiene un formato válido
  campo = objetivo.DNI;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarDni(campo,'')){
    return false;
  }
  
  //Comprueba que el nombre no está vacío y tiene la cantidad de caracteres adecuada
  campo = objetivo.Nombre;
  if(!comprobarVacio(campo)){
    return false;
   }
  if(!comprobarAlfabetico(campo, 30,'')){
    return false;
  }

  //Comprueba que los apellidos no están vacíos y tiene la cantidad de caracteres adecuada
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
  
//Comprueba que la direccion tenga un formato válido
  campo = objetivo.Direccion;
  
  if(!comprobarVacio(campo)){
    return false;
   }
   
  if(!comprobarTexto(campo, 60)){
    return false;
  }

   //Comprueba que el Teléfono no esté vacío y tiene un formato válido
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

//Valida la búsqueda
function validarBusqueda(){
 
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
	  if(formulario == 'search'){
		  if(campo.value.length==0){//Si el valor del campo está vacio, que devuelva cierto
		
		return true;
	}
if (!campo.value.match(/^[a-zA-ZÁÉÍÓÚÜáéíóüúñÑ-\s]*$/)){//Si el valor del campo contiene algo que no sea un caracter alfabetico permitido en nuestro idioma,devuelve falso y un aviso indicando el campo que tiene el error
		if(campo.name=='Nombre'){
		alert('El campo nombre solo puede contener letras');
		
		campo.focus();
		return false;
		}
		if(campo.name=='Apellidos'){
		alert('El campo apellidos solo puede contener letras');
		campo.focus();
		return false;
		}
}
if (campo.value.length>size){//Si el numero de caracteres del campo es mayor que el tamaño permitido, que devuelva false{
		if(campo.name=='Nombre'){
			alert( 'El tamaño de nombre sobrepasa');
			
			campo.focus();
			return false;
		}
		if(campo.name=='Apellidos'){
			alert('El tamaño de apellidos sobrepasa');
			
			campo.focus();
			return false;
		}
    }

	return true;//Si ninguno de los if anteriores se cumple,devuelve true	
		  
		  
	  }else{

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
  else{
    alert("El campo " + campo.name + " no admite caracteres no alfabéticos");
    campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
    return false;
  }
  
	  }
}

//Comprueba que el formato del dni sea correcto
function comprobarDni(campo,formulario){
	
	if(formulario == 'search'){
					
					if(campo.value.length==0){
						return true;
				}else if(campo.value.length<9){ // Sino, comprueba si la longitud del dni es menor que nueve
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
		
		if(/^[a-z]+$/.test(campo.value)){//Comprueba que la letra DNI sea mayuscula y sino lo es, de un aviso
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
								if(campo.value.trim().length === 0){
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
					//Comprueba que el campo tenga una longitud superior a la indicada y lanza una alerta y devuelve un flase en ese caso
			  if (campo.value.length>size) {
				alert('Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + size + ' y es ' + campo.value.length);
				campo.focus();
				
				return false;
			  }

			  
			  return true;
					
				
	}else{
	if(campo.value.trim().length === 0){
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


function comprobarTelf(campo) {
	if(campo.value.length==0){//Si el campo telefono esta vacio que devuelva true
	campo.style.backgroundColor = "white";
		return true;
	}
	
	if(/^[0-9]+$/.test(campo.value)==false){
		alert('El telefono solo tiene numeros y se escrien con mayuscula');
		campo.focus();
		campo.style.backgroundColor = "rgba(255, 117, 117, 0.58)";
		return false;
	}
	//Expresion regular que indica los numeros de telefono validos
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


function comprobarTelfSearch(campo) {
	if(campo.value.length==0){//Si el campo telefono esta vacio que devuelva true
	
		return true;
	}
	if(/^[0-9]+$/.test(campo.value)==false){
		alert('El telefono solo tiene numeros');
		
		campo.focus();
		return false;
	}
	
	if(campo.value.length<11){
		 
		return true;
	}else if(/^((34)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/.test(campo.value)){
		 
		return true;
	}else{
		
		//Si el numero no coincide,devuelve false y un aviso explicando los formatos de numero permitidos
		alert('Telefono malo, indicalo en uno de los siguientes formatos: 34(puedes escribirlo o no) 9XXXXXXXX | 6XXXXXXXX ');
		
		campo.focus();
		return false;
		}
}
