<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 10:57
 */

class Trabajo_SEARCH
{


    //Constructor de la clase
    function __construct(){
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        ?>
        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label><?php echo $strings['Id Trabajo']; ?>
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo"
                       size="6" maxlength="6"
                />
            </label>
            <label><?php echo $strings['Nombre Trabajo']; ?>
                <input type="text" name="NombreTrabajo"
                       id="NombreTrabajo"
                       size="60" maxlength="60"
                />
            </label>
            <label><?php echo $strings['Fecha inicio']; ?>
                <input type="text" name="FechaIniTrabajo" class="tcal"  readonly="readonly"/>
            </label>

            <label><?php echo $strings['Fecha fin']; ?>
                <input type="text" name="FechaFinTrabajo" class="tcal"  readonly="readonly"/>
            </label>

            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar']; ?>"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pinta

}//fin de la clase
?>
