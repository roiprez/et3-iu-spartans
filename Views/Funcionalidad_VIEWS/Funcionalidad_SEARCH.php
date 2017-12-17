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
include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label><?php echo $strings['Id funcionalidad']; ?>
                <input type="text" name="IdFuncionalidad"
                       id="IdFuncionalidad"
                       size="6 maxlength="6"
                />
            </label>

            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="NombreFuncionalidad"
                       id="NombreFuncionalidad"
                       size="60" maxlength="60"
                />
            </label>
            <label><?php echo $strings['Descripcion']; ?>
                <textarea form="formulario-search" maxlength="100" name="DescripFuncionalidad"></textarea>
            </label>
            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar'];?>" ><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido'];?>" > <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás'];?>" ><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pinta

}//fin de la clase
?>
