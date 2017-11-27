<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 25/11/17
 * Time: 12:58
 */

class Vista_EDIT// declaración de clase
{
    //Declaracion de los atributos
    var $lista_variables;//variables requeridas
    var $tamanho_variables;//tamaño de las variables para los inputs
    var $lista_valores;//valores de las variables
    var $clave;//numero de atributos que pertenecen a la clave

    //Constructor
    function __construct($lista_variables,$tamanho_variables,$lista_valores,$clave)
    {

        $this->tamanho_variables=$tamanho_variables;
        $this->lista_variables=$lista_variables;
        $this->lista_valores=$lista_valores;
        $this->clave=$clave;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post">
            <?php
            for($i =0; $i <$this->clave; $i++){//Los atributos de la clave se tratan fuera para hacerlos no editables
                ?>
                <label><?php echo $this->lista_variables[$i] ?>
                    <input type="text" name="<?php echo $this->lista_variables[$i] ?>"
                           id="<?php echo $this->lista_variables[$i] ?>" required="true"
                           readonly
                           size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
                           value="<?php echo $this->lista_valores[$this->lista_variables[$i]] ?>"
                    />
                </label>

                <?php

            }//fin bucle for

            for ($i = $this->clave; $i < count($this->lista_variables ); $i++) {//Creacion de inputs segun el numero de atributos - los de la clave

                if($this->lista_variables[$i]!='password'){
                ?>
                <label><?php echo $this->lista_variables[$i] ?>
                    <input type="text" name="<?php echo $this->lista_variables[$i] ?>"
                           id="<?php echo $this->lista_variables[$i] ?>" required="true"
                           size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
                           value="<?php echo $this->lista_valores[$this->lista_variables[$i]] ?>"
                    />
                </label>
                    <?php
                    }else{
                    ?>
                    <label><?php echo $this->lista_variables[$i] ?>
                        <input type="password" name="<?php echo $this->lista_variables[$i] ?>"
                               id="<?php echo $this->lista_variables[$i] ?>" required="true"
                               size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
                               value="<?php echo $this->lista_valores[$this->lista_variables[$i]] ?>"
                        />
                    </label>
                    <?php
                }//fin del else
            }//fin bucle for
            ?>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit"><img class="button-td" src="../Iconos/send.png" title="enviar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button> <!--Imagen para la accion back,que permite volver al menu principal-->
		</center></form>
        <?php
    }//fin pinta

}//fin clase
?>