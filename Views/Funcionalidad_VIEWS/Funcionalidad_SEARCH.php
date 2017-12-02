<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 18:07
 */

class Funcionalidad_SEARCH
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

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label>Id funcionalidad
                <input type="text" name="IdFuncionalidad"
                       id="IdFuncionalidad"
                       size="6 maxlength="6"
                />
            </label>

            <label>Nombre
                <input type="text" name="NombreFuncionalidad"
                       id="NombreFuncionalidad"
                       size="60" maxlength="60"
                />
            </label>
            <label>Descripcion
                <textarea form="formulario-search" maxlength="100" name="DescripFuncionalidad"></textarea>
            </label>
            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit"><img class="button-td" src="../../Iconos/search.png" title="buscar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin de pinta

}//fin de la clase
?>
