<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 18:02
 */

class Funcionalidad_EDIT
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
            <label>Id funcionalidad
                <input type="text" name="IdFuncionalidad"
                       id="IdFuncionalidad" required="true" readonly
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdFuncionalidad'] ?>"
                />
            </label>
            <label>Nombre
                <input type="text" name="NombreFuncionalidad"
                       id="NombreFuncionalidad" required="true"
                       size="60" maxlength="60"value="<?php echo $this->lista_valores['NombreFuncionalidad'] ?>"
                />
            </label>
            <label>Descripcion
                <textarea form="formulario-edit" maxlength="100" name="DescripGrupo" >
                <?php echo $this->lista_valores['DescripFuncionalidad'] ?>
                </textarea>
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

