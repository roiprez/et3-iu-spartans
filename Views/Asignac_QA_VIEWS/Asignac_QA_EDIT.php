<?php
/**
 * User: Diego
 * Date: 08/12/2017
 * Time: 11:38
 */


class Asignac_QA_EDIT// declaración de clase
{

  var $lista_Usuarios;
  var $usuario;
  var $trabajo
  var $alias;
  var $corrector;

    //Constructor
    function __construct($lista_usuarios,$trabajo,$usuario,$alias,$corrector)
    {
        $this->lista_Usuarios=$lista_usuarios;
        $this->trabajo=$trabajo;
        $this->usuario=$usuario;
        $this->alias=$alias;
        $this->corrector=$corrector;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarFormulario('edit') ">

            <label>Login del evaluado
                 <input type="text" name="login" readonly="true"
                       id="login"
                       size="9" maxlength="9" value="<?php echo "$usuario"?>" 
                />
            </label>
            <label>Alias
                <input type="text" name="Alias" readonly="true"
                       id="Alias" required="true"
                       size="9" maxlength="9" value="<?php echo "$alias"?>" 
                />
            </label>
            <label>Id del Trabajo
                <input type="text" name="IdTrabajo" readonly="true"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6" value="<?php echo "$this->trabajo"?>" 
                />
            </label>
            <label>Login del evaluador
                <select name="IdTrabajo" id="IdTrabajo" required="true" size="1">
                  
                  <option selected="true"> value="<?php echo "$this->corrector" ?>"><?php echo "$this->corrector" ?></option>
                  <?php 

                    for($i=0;$i<count($this->lista_Usuarios);$i++){//recorremos todos los usuarios
                      
                      if(($this->lista_Usuarios[$i]!=$this->usuario)&&$this->lista_Usuarios[$i]!=$this->corrector){//si el usuario es distinto del usuario evaluado o del corrector ya asignado es un potencial corrector
                      ?>
                        <option value="<?php echo "$this->lista_Usuarios[$i]" ?>"><?php echo "$this->lista_Usuarios[$i]" ?></option>
                      <?php
                      }//fin del if
                    }//fin del bucle
                  ?>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
    <button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}//fin clase
?>