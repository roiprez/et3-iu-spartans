<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 10:53
 */

class Trabajo_EDIT
{
    //Declaracion de los atributos
    var $lista_valores;//valores de las variables

    //Constructor
    function __construct($lista_valores)
    {

        $this->lista_valores=$lista_valores;

        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post">
            <label>Id trabajo
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" required="true" readonly
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdTrabajo'] ?>"
                />
            </label>
            <label>NombreTrabajo
                <input type="text" name="NombreTrabajo"
                       id="NombreTrabajo" required="true"
                       size="60" maxlength="60" value="<?php echo $this->lista_valores['NombreTrabajo'] ?>"
                />
            </label>
            <label>Fecha inicio
                <input type="text" name="FechaIniTrabajo" class="tcal" required="true" readonly="readonly" value="<?php echo $this->lista_valores['FechaIniTrabajo'] ?>"/>
            </label>

            <label>Fecha fin
                <input type="text" name="FechaFinTrabajo" class="tcal" required="true" readonly="readonly" value="<?php echo $this->lista_valores['FechaFinTrabajo'] ?>"/>
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