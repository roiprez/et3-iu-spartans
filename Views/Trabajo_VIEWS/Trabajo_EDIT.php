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
                <button id="enviar" name = "action" value = "EDIT" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin pinta

}//fin clase
?>