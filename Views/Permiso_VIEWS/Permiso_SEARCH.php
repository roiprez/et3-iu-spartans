<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 11:57
 */

class Permiso_SEARCH
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

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label>Id grupo

                <select name="IdGrupo" id="IdGrupo">
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
                <select name="IdFuncionalidad" id="IdFuncionalidad">
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
                <select name="IdAccion" id="IdAccion" >
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
                <button id="buscar" name = "action" value = "SEARCH" type="submit"><img class="button-td" src="../../Iconos/search.png" title="buscar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin de pinta

}//fin de la clase
?>

}
