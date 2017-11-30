<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 30/11/2017
 * Time: 13:29
 */

class Grupo_EDIT
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
            <label>Id del grupo
                <input type="text" name="IdGrupo"
                       id="IdGrupo" required="true" readonly
                       size="6" maxlength="6"  value="<?php echo $this->lista_valores['IdGrupo'] ?>"
                />
            </label>
            <label>Nombre
                <input type="text" name="NombreGrupo"
                       id="NombreGrupo" required="true"
                       size="60" maxlength="60"value="<?php echo $this->lista_valores['NombreGrupo'] ?>"
                />
            </label>
            <label>Descripcion
                <input type="text" name="DescripGrupo"
                       id="DescripGrupo" required="true"
                       size="100" maxlength="100"value="<?php echo $this->lista_valores['DNI'] ?>"
                />
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit"><img class="button-td" src="../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../Controllers/Index_Controller.php"><img class="button-td" src="../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin pinta

}//fin clase
?>



