<?php
/**

 * User: Diego
 * Date: 08/12/2017
 * Time: 11:49
 */

class Asignac_QA_SEARCH
{


    //Constructor de la clase
    function __construct(){
        $this->pinta();
    }

    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label>Login del evaluado
                 <input type="text" name="login"
                       id="login"
                       size="9" maxlength="9" 
                />
            </label>
            <label>Alias
                <input type="text" name="Alias" 
                       id="Alias" 
                       size="6" maxlength="6" 
                />
            </label>
            <label>Id del Trabajo
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" 
                       size="6" maxlength="6" 
                />
            </label>
            <label>Login del evaluador
                <input type="text" name="login" 
                       id="login"
                       size="9" maxlength="9"  
                />
            </label>

            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="buscar"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin de pinta

}//fin de la clase
?>
