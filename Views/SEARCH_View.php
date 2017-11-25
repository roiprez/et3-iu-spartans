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
        <form id="formulario-search" name="formulario_search" method="post">

            <?php
            for($i=0;$i<count($this->lista_variables);$i++) {
                ?>
                <label><?php echo $this->lista_variables[$i] ?>
                    <input type="text" name="<?php echo $this->lista_variables[$i] ?>"
                           size="<?php echo $this->tamanho_variables[$i] ?>"
                           maxlength="<?php echo $this->tamanho_variables[$i] ?>" onchange="comprobarTexto(this, 15)"/>
                </label>
                <?php
            }//fin bucle for
            ?>

            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit"><img class="button-td" src="../Iconos/search.png" title="buscar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../Controllers/Index_Controller.php"><img class="button-td" src="../Iconos/back.png" title="atrás"></img></a></button>
        <?php
    }//fin de pinta

}//fin de la clase
?>