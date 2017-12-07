<?php
/**
 * User: Diego
 * Date: 07/12/2017
 * Time: 12:48
 */


class Entrega_EDIT// declaración de clase
{

  var $lista_Valores;

    //Constructor
    function __construct($lista_Valores)
    {
        $this->lista_Valores=$lista_Valores;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" enctype="multipart/form-data" onSubmit="return validarFormulario('edit') ">

            <label>Login
                <input type="text" name="login"
                       id="login" required="true" readonly="true"
                       size="9" maxlength="9" value="<?php echo "$this->lista_Valores['login']"?>" 
                />
            </label>
            <label>Id del Trabajo
                <input type="text" name="IdTrabajo" readonly="true"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6" value="<?php echo "$this->lista_Valores['IdTrabajo']"?>" 
                />
            </label>
            <label>Alias
                <input type="text" name="Alias" readonly="true"
                       id="Alias" required="true"
                       size="9" maxlength="9" value="<?php echo "$this->lista_Valores['Alias']"?>" 
                />
            </label>
            <label>Horas
                <input type="number" name="Horas"
                       id="Horas" required="true"
                       size="2" maxlength="2" value="<?php echo "$this->lista_Valores['Horas']"?>" 
                />
            </label>
            <label>Ruta
                <input type="text" hidden="true" name="RutaOriginal"
                       id="RutaOriginal" 
                       size="60" maxlength="60" value="<?php echo "$this->lista_Valores['Ruta']"?>" 
                />
                <input type="file" name="Ruta"
                       id="Ruta"  
                       size="60" maxlength="60"
                />
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