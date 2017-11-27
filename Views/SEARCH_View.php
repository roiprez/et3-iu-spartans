<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 25/11/17
 * Time: 15:23
 */

class Vista_SEARCH{  // declaración de clase

    var $lista_variables;//declaracion de la lista de variables que se van a pedir en el formulario
    var $tamanho_variables;//declaracion de la lista de tamaños de las variables


    //Constructor de la clase
    function __construct($lista_variables,$tamanho_variables){
        $this->lista_variables=$lista_variables;
        $this->tamanho_variables=$tamanho_variables;
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">>

            <?php
            for($i=0;$i<count($this->lista_variables);$i++) {
                ?>
                <label><?php echo $this->lista_variables[$i] ?>
                    <input type="text" name="<?php echo $this->lista_variables[$i] ?>"
                           size="<?php echo $this->tamanho_variables[$i] ?>"
                           maxlength="<?php echo $this->tamanho_variables[$i] ?>" />
                </label>
                <?php
            }//fin bucle for
            ?>

            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit"><img class="button-td" src="../Iconos/search.png" title="buscar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button> <!--Imagen para la accion back,que permite volver al menu principal-->
		</center></form>
        <?php
    }//fin de pinta

}//fin de la clase
?>