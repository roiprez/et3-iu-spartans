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

            <label>Id funcionalidad

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
                <select name="IdAccion" id="IdAccion" required="true">
                    <option selected value="<?php echo $this->valores['IdAccion']?>"><?php echo $this->valores['IdAccion']?></option>
                    <?php
                    for ($i=0;$i<count($this->lista_Accion);$i++) {

                        ?>
                        <option value="<?php echo $this->lista_Accion[$i]?>"><?php echo $this->lista_Accion[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
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
