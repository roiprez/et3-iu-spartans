<?php
/**
* Author: IU Spartans
 * Vista de search de accion
 * Date: 01/12/2017
 */

class Accion_SEARCH
{

    //Constructor
    function __construct()
    {
        $this->pinta();
    }
    //Envía contenido al navegador
    function pinta()
    {
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Action','Search')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
		include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarEntidad('accion','search');">

            <label><?php echo $strings['Id Accion']; ?>
                <input type="text" name="IdAccion"
                       id="IdAccion"
                       size="6" maxlength="6"
                />
            </label>

            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="NombreAccion"
                       id="NombreAccion"
                       size="60" maxlength="60"
                />
            </label>
            <label><?php echo $strings['Descripcion']; ?>
                <textarea form="formulario-search" maxlength="100" name="DescripAccion"></textarea>
            </label>
            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar']; ?>"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'  title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pinta

}//fin de la clase
?>
