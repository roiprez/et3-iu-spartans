<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 30/11/2017
 * Time: 13:25
 */

class Grupo_ADD
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

            <label>Id del grupo
                <input type="text" name="IdGrupo"
                       id="IdGrupo" required="true"
                       size="6 maxlength="6"
                />
            </label>

            <label>Nombre
                <input type="text" name="NombreGrupo"
                       id="NombreGrupo" required="true"
                       size="60" maxlength="60"
                />
            </label>
            <label>Descripcion
                <textarea form="formulario-add" maxlength="100" name="DescripGrupo" required="true">
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

}//fin clase
?>