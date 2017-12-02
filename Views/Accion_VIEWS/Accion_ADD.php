<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 18:14
 */

class Accion_ADD
{
    //Constructor
    function __construct()
    {
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">

            <label>Id accion
                <input type="text" name="IdAccion"
                       id="IdAccion" required="true"
                       size="6 maxlength="6"
                />
            </label>

            <label>Nombre
                <input type="text" name="NombreAccion"
                       id="NombreAccion" required="true"
                       size="60" maxlength="60"
                />
            </label>
            <label>Descripcion
                <textarea form="formulario-add" maxlength="100" name="DescripAccion" required="true">
                </textarea>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin pinta

}
?>