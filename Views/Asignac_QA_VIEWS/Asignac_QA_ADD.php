<?php
/**
 * User: Diego
 * Date: 08/12/2017
 * Time: 10:57
 */


class Asignac_QA_ADD// declaración de clase
{

  var $lista_Usuarios;
  var $usuario;
  var $trabajo;
  var $alias;

    //Constructor
    function __construct($lista_usuarios,$trabajo,$usuario,$alias)
    {
        $this->lista_Usuarios=$lista_usuarios;
        $this->trabajo=$trabajo;
        $this->usuario=$usuario;
        $this->alias=$alias;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" enctype="multipart/form-data" onSubmit="return validarFormulario('add') ">

            <label>Login del evaluado
                 <input type="text" name="login" readonly="true"
                       id="login"
                       size="9" maxlength="9" value="<?php echo $this->usuario?>"
                />
            </label>
            <label>Alias
                <input type="text" name="Alias" readonly="true"
                       id="Alias" required="true"
                       size="6" maxlength="6" value="<?php echo $this->alias?>"
                />
            </label>
            <label>Id del Trabajo
                <input type="text" name="IdTrabajo" readonly="true"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6" value="<?php echo $this->trabajo?>"
                />
            </label>
            <label>Login del evaluador
                <select name="IdTrabajo" id="IdTrabajo" required="true" size="1">
                  <?php 
                    for($i=0;$i<count($this->lista_Usuarios);$i++){//recorre todos los usuarios
                      
                      if($this->lista_Usuarios[$i]!=$this->usuario){//si el usuario es distinto del evaluado es un posible corrector
                      ?>
                        <option value="<?php echo "$this->lista_Usuarios[$i]" ?>"><?php echo "$this->lista_Usuarios[$i]" ?></option>
                      <?php
                      }//fin del if
                    }//fin del bucle
                  ?>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
		
		<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->

        <?php
    }//fin pinta

}//fin clase
?>