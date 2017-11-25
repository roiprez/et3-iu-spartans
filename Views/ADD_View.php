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
    var $tamaño_variables;//tamaño de las variables para los inputs
	var $ruta_envio;//ruta a la que enviar los datos
	
	//Constructor
    function __construct($lista_variables,$tamaño_variables,$ruta_envio)
    {
		$this->ruta_envio=$ruta_envio;
        $this->tamaño_variables=$tamaño_variables;
        $this->lista_variables=$lista_variables;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" action="<?php echo $this->ruta_envio?>">
        <?php

        for ($i = 0; $i < count($this->lista_variables); $i++) {//Creacion de inputs segun el numero de atributos
            ?>
            <label><?php echo $this->lista_variables[$i] ?>
                <input type="text" name="<?php echo $this->lista_variables[$i] ?>"
                       id="<?php echo $this->lista_variables[$i] ?>" required="true"
                       size="<?php echo $this->tamaño_variables[$i] ?>" maxlength="<?php echo $this->tamaño_variables[$i] ?>"
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
        <?php
    }//fin pinta

}//fin clase
?>