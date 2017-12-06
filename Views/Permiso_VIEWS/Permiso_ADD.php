<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 18:23
 */

class Permiso_ADD
{

    var $lista_Grupos;
    var $lista_Funcion;
    var $lista_Accion;



    //Constructor
    function __construct($lista_Grupos,$lista_Funcion,$lista_Accion)
    {

        $this->lista_Grupos=$lista_Grupos;
        $this->lista_Funcion=$lista_Funcion;
        $this->lista_Accion=$lista_Accion;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">

            <label>Id grupo

                <select name="IdGrupo" id="IdGrupo" required="true">
                    <?php
                    for ($i=0;$i<count($this->lista_Grupos);$i++) {

                        ?>
                        <option value="<?php echo $this->lista_Grupos[$i]?>"><?php echo $this->lista_Grupos[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <label>In funcionalidad
                <select name="IdFuncionalidad" id="IdFuncionalidad" required="true">
                    <?php
                    for ($i=0;$i<count($this->lista_Funcion);$i++) {

                        ?>
                        <option value="<?php echo $this->lista_Funcion[$i]?>"><?php echo $this->lista_Funcion[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <label>id accion
                <select name="IdAccion" id="IdAccion" required="true">
                    <?php
                    for ($i=0;$i<count($this->lista_Accion);$i++) {

                        ?>
                        <option value="<?php echo $this->lista_Accion[$i]?>"><?php echo $this->lista_Accion[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}
?>