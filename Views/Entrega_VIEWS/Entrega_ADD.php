<?php
/**
* Author: IU Spartans
* Vista de Add de Entrega
* Date: 07/12/2017
*/


class Entrega_ADD// declaración de clase
{

  //Declaracion de los atributos
  var $lista_Usuarios;//lista de usuarios dados de alta
  var $lista_Trabajos;//lista de trabajos posibles
  var $alias;

    //Constructor
    function __construct($lista_usuarios,$lista_trabajos,$alias)
    {
      //asignación de valores de parámetro a los atributos de la clase
        $this->lista_Usuarios=$lista_usuarios;
        $this->lista_Trabajos=$lista_trabajos;
        $this->alias=$alias;

        //Envía contenido al navegador
        $this->pinta();
    }
    
    //Envía contenido al navegador
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
    	 if (IsAuthenticated() && !isAllow('Entre','Add')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        ?>

        <form id="formulario-add" name="formulario_add" method="post" enctype="multipart/form-data" onSubmit="return validarEntidad('entrega','add') ">

            <label><?php echo $strings['Login']; ?>
                <select name="login" id="login" required="true" size="1">
                  <?php 
                    for($i=0;$i<count($this->lista_Usuarios);$i++){//recorre todos los usuarios
                      ?>
                      <option value="<?php echo $this->lista_Usuarios[$i]?>"><?php echo $this->lista_Usuarios[$i] ?></option>
                      <?php
                    }//fin del bucle
                  ?>
                </select>
            </label>
            <label><?php echo $strings['Id del Trabajo']; ?>
                <select name="IdTrabajo" id="IdTrabajo" required="true" size="1">
                  <?php 
                    for($i=0;$i<count($this->lista_Trabajos);$i++){//recorre todos los trabajos
                      ?>
                      <option value="<?php echo $this->lista_Trabajos[$i] ?>"><?php echo $this->lista_Trabajos[$i] ?></option>
                      <?php
                    }//fin del bucle
                  ?>
                </select>
            </label>
            <label><?php echo $strings['Alias']; ?>
                <input type="text" name="Alias" readonly="true"
                       id="Alias" required="true"
                       size="6" maxlength="6" value="<?php echo $this->alias?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Horas']; ?>
                <input type="text" name="Horas"
                       id="Horas" 
                       size="2" maxlength="2" onChange ="return comprobarEntero(this,0,99);"
                />
            </label>
            <label><?php echo $strings['Ruta']; ?>
                <input type="file" name="Ruta"
                       id="Ruta" 
                       size="60" maxlength="60" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
		
		<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->

        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>