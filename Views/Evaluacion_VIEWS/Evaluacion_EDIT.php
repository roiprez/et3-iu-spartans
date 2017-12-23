<?php

/**
* Author: IU Spartans
 * Vista de Edit de Evaluacion
 * Date: 02/12/2017
 */

 

class Evaluacion_EDIT// declaración de clase
{
    //Declaracion de los atributos
    var $lista_valores;//valores de las variables

    //Constructor
    function __construct($lista_valores)
    {

        $this->lista_valores=$lista_valores;

        $this->pinta();
    }
    //Envía contenido al navegador
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarEntidad('evaluacion','edit') && encriptar()">
            <label><?php echo $strings['Id del trabajo']; ?>
                <input type="text" name="IdTrabajo" readonly="true"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdTrabajo'] ?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Login evaluador']; ?>
                <input type="text" name="LoginEvaluador"
                       id="LoginEvaluador" required="true"
                       size="9" maxlength="9" value="<?php echo $this->lista_valores['LoginEvaluador'] ?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Alias evaluado']; ?>
                <input type="text" name="AliasEvaluado"
                       id="AliasEvaluado" required="true"
                       size="9" maxlength="9" value="<?php echo $this->lista_valores['AliasEvaluado'] ?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Id de la historia']; ?>
                <input type="number" name="IdHistoria"
                       id="IdHistoria" required="true"
                       size="2" maxlength="2" value="<?php echo $this->lista_valores['IdHistoria'] ?>" onChange ="return comprobarEntero(this,0,99);"
                />
            </label>
            <label><?php echo $strings['Corrección de la historia']; ?>
                <select name="CorrectoA" id="CorrectoA" required="true" size="1">
                    <option selected="true" value="<?php echo $this->lista_valores['CorrectoA'] ?>"><?php if($this->lista_valores['CorrectoA']==1){
                             echo $strings['Correcto'];
                        }else{
                             echo $strings['Incorrecto'];
                        }?>
                    
                    </option>
                    <option value="1"><?php echo $strings['Correcto'];?></option>
                    <option value="0"><?php echo $strings['Incorrecto']; ?></option>
                </select>
            </label>
            <label><?php echo $strings['comentario']; ?>
                <textarea form="formulario-edit" maxlength="300" name="ComenIncorrectoA"><?php echo $this->lista_valores['ComenIncorrectoA']?></textarea>
            </label>

            <?php
            if (IsAuthenticated() && isAllow('Eval','Edit')){//campos solo visibles para el admin
                ?>
                <label><?php echo $strings['Corrección del profesor']; ?>
                    <select name="CorrectoP" id="CorrectoP" required="true" size="1">
                        <option selected="true" value="<?php echo $this->lista_valores['CorrectoP'] ?>"><?php if($this->lista_valores['CorrectoP']==1){
                               echo $strings['Correcto'];
                            }else{
                                echo $strings['Incorrecto'];
                            }?>
                    
                        </option>
                       <option value="1"><?php echo $strings['Correcto'];?></option>
                    <option value="0"><?php echo $strings['Incorrecto']; ?></option>
                    </select>
                </label>
                <label><?php echo $strings['comentario']; ?>
                    <textarea form="formulario-edit" maxlength="300" name="ComentIncorrectoP"><?php echo $this->lista_valores['ComentIncorrectoP'] ?></textarea>
                </label>
                <label><?php echo $strings['Corrección de la evaluación']; ?>
                    <select name="OK" id="OK" required="true" size="1">
                        <option selected="true" value="<?php echo $this->lista_valores['OK'] ?>"><?php if($this->lista_valores['OK']==1){
                                echo  $strings['Correcto']; 
                            }else{
                                echo $strings['Incorrecto'];
                            }?>
                    
                        </option>
                        <option value="1"><?php echo $strings['Correcto'];?></option>
                    <option value="0"><?php echo $strings['Incorrecto']; ?></option>
                    </select>
                </label>
                <?php
            }else{//si no es admin creamos campos ocultos con los valores antiguos para que no falle la modificacion
                ?>
                <label>
                    <input name="CorrectoP" hidden value="<?php echo$this->lista_valores['CorrectoP']?>"/>
                </label>
                <label>
                    <input name="ComenIncorrectoP" hidden value="<?php echo$this->lista_valores['ComentInorrectoP']?>"/>
                </label>
                <label>
                    <input name="OK" hidden value="<?php echo$this->lista_valores['OK']?>"/>
                </label>
                <?php
            }
            ?>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
            <button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}//fin clase
?>