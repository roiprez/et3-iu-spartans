<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 10:42
 */

class Trabajo_ADD
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
            if (IsAuthenticated() && !isAllow('Jobs','Add')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarEntidad('trabajo','add')">

            <label><?php echo $strings['Id Trabajo']; ?>
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6"
                />
            </label>
            <label><?php echo $strings['Nombre Trabajo']; ?>
                <input type="text" name="NombreTrabajo"
                       id="NombreTrabajo" required="true"
                       size="60" maxlength="60"
                />
            </label>
            <label><?php echo $strings['Porcentaje Trabajo']; ?>
                <input type="text" name="PorcentajeNota"
                       id="PorcentajeNota" required="true"
                       size="2" maxlength="2"
                />
            </label>
            <label><?php echo $strings['Fecha inicio']; ?>
                <input type="text" name="FechaIniTrabajo" class="tcal" required="true" readonly="readonly"/>
            </label>

            <label><?php echo $strings['Fecha fin']; ?>
                <input type="text" name="FechaFinTrabajo" class="tcal" required="true" readonly="readonly"/>
            </label>


            <div class="botones-formulario">
                <button id="enviar" name="action" value="ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
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