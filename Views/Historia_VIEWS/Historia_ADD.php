<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 12:11
 */

class Historia_ADD
{
    var $lista_Trabajos;




    //Constructor
    function __construct($lista_Trabajos)
    {

        $this->lista_Trabajos=$lista_Trabajos;

        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">

            <label>Id trabajo

                <select name="IdTrabajo" id="IdTrabajo" required="true">
                    <?php
                    for ($i=0;$i<count($this->lista_Trabajos);$i++) {

                        ?>
                        <option value="<?php echo $this->lista_Trabajos[$i]?>"><?php echo $this->lista_Trabajos[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>

            <label>Id historia
                <input type="number" name="IdHistoria"
                       id="IdHistoria" required="true"
                       size="2" maxlength="2"
                />
            </label>

            <label>Texto
                <textarea form="formulario-add" maxlength="300" name="TextoHistoria" required="true">
                </textarea>
            </label>



                <div class="botones-formulario">
                    <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                    <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
                </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}
?>