<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 25/11/17
 * Time: 10:50
 */
class Vista_ADD// declaración de clase
{  
    //Declaracion de los atributos
    var $lista_variables;//variables requeridas
    var $tamanho_variables;//tamaño de las variables para los inputs

	
	//Constructor
    function __construct($lista_variables,$tamanho_variables)
    {
        $this->tamanho_variables=$tamanho_variables;
        $this->lista_variables=$lista_variables;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post">
        <?php

        for ($i = 0; $i < count($this->lista_variables); $i++) {//Creacion de inputs segun el numero de atributos
            ?>
            <label><?php echo $this->lista_variables[$i] ?>
                <input type="text" name="<?php echo $this->lista_variables[$i] ?>"
                       id="<?php echo $this->lista_variables[$i] ?>" required="true"
                       size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
                />
            </label>


            <?php

        }//fin bucle for
        ?>
		<div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../Iconos/send.png" title="enviar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../Controllers/Index_Controller.php"><img class="button-td" src="../Iconos/back.png" title="atrás"></img></a></button>
        <?php
    }//fin pinta

}//fin clase
?>