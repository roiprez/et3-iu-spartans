<?php
/**
* Author: IU Spartans
 * Vista de Edit de Asignac_QA
 * Date: 08/12/2017
 */


class Asignac_QA_EDIT// declaración de clase
{
   //Declaracion de los atributos
  var $lista_Usuarios;
  var $usuario;
  var $trabajo;
  var $alias;
  var $corrector;

    //Constructor de la clase
    function __construct($trabajo,$usuario,$alias,$corrector)
    {//asignación de valores de parámetro a los atributos de la clase
        $this->trabajo=$trabajo;
        $this->usuario=$usuario;
        $this->alias=$alias;
        $this->corrector=$corrector;
        $this->pinta();
    }
    //Envía contenido al navegador
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
         if (IsAuthenticated() && !isAllow('Asig_Qua','Edit')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarFormulario('edit') ">

            <label><?php echo $strings['Login del evaluado']; ?>
                 <input type="text" name="login" readonly="true"
                       id="login"
                       size="9" maxlength="9" value="<?php echo $this->usuario?>"
                />
            </label>
            <label><?php echo $strings['Alias']; ?>
                <input type="text" name="Alias" readonly="true"
                       id="Alias" required="true"
                       size="9" maxlength="9" value="<?php echo $this->alias?>"
                />
            </label>
            <label>I<?php echo $strings['Id del Trabajo']; ?>
                <input type="text" name="IdTrabajo" readonly="true"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6" value="<?php echo $this->trabajo?>" 
                />
            </label>
            <label><?php echo $strings['Login del evaluador']; ?>
                <select name="IdTrabajo" id="IdTrabajo" required="true" size="1">
                  
                  <option selected="true" value="<?php echo $this->corrector ?>"><?php echo $this->corrector ?></option>
                  <?php 

                    for($i=0;$i<count($this->lista_Usuarios);$i++){//recorremos todos los usuarios
                      
                      if(($this->lista_Usuarios[$i]!=$this->usuario)&&$this->lista_Usuarios[$i]!=$this->corrector){//si el usuario es distinto del usuario evaluado o del corrector ya asignado es un potencial corrector
                      ?>
                        <option value="<?php echo $this->lista_Usuarios[$i] ?>"><?php echo $this->lista_Usuarios[$i] ?></option>
                      <?php
                      }//fin del if
                    }//fin del bucle
                  ?>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
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