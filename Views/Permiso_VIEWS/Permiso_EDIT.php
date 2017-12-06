<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 12:01
 */

class Permiso_EDIT
{

    var $lista_Grupos;
    var $lista_Funcion;
    var $lista_Accion;
    var $valores;



    //Constructor
    function __construct($lista_Grupos,$lista_Funcion,$lista_Accion,$valores)
    {

        $this->lista_Grupos=$lista_Grupos;
        $this->lista_Funcion=$lista_Funcion;
        $this->lista_Accion=$lista_Accion;
        $this->valores=$valores;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post">

            <label>Id grupo

                <select name="IdGrupo" id="IdGrupo" required="true">
                    <option selected value="<?php echo $this->valores['IdGrupo']?>"><?php echo $this->valores['IdGrupo']?></option>
                    <?php
                    for ($i=0;$i<count($this->lista_Grupos);$i++) {

                        ?>
                        <option value="<?php echo $this->valores['IdGrupo']?>"><?php echo $this->valores['IdGrupo']?></option>
                        <option value="<?php echo $this->lista_Grupos[$i]?>"><?php echo $this->lista_Grupos[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <label>In funcionalidad
                <select name="IdFuncionalidad" id="IdFuncionalidad" required="true">
                    <option selected value="<?php echo $this->valores['IdFuncionalidad']?>"><?php echo $this->valores['IdFuncionalidad']?></option>
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
                    <option selected value="<?php echo $this->valores['IdAccion']?>"><?php echo $this->valores['IdAccion']?></option>
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
