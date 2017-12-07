<?php
/**
 
 * User: Diego
 * Date: 02/12/2017
 * Time: 13:19
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
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarFormulario('edit') && encriptar()">
             <label>Id del trabajo
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6" value="<?php echo "$this->lista_valores['IdTrabajo']" ?>" 
                />
            </label>
            <label>Login evaluador
                <input type="text" name="LoginEvaluador"
                       id="LoginEvaluador" required="true"
                       size="9" maxlength="9" value="<?php echo "$this->lista_valores['LoginEvaluador']" ?>"
                />
            </label>
            <label>Alias evaluado
                <input type="text" name="AliasEvaluado"
                       id="AliasEvaluado" required="true"
                       size="9" maxlength="9" value="<?php echo "$this->lista_valores['AliasEvaluado']" ?>"
                />
            </label>
            <label>Id de la historia
                <input type="number" name="IdHistoria"
                       id="IdHistoria" required="true"
                       size="2" maxlength="2" value="<?php echo "$this->lista_valores['IdHistoria']" ?>"
                />
            </label>
            <label>Corrección de la historia
                <select name="CorrectoA" id="CorrectoA" required="true" size="1">
                  <option selected="true"> value="<?php echo "$this->lista_valores['CorrectoA']" ?>"><?php if($this->lista_valores['CorrectoA']==1){
                    echo "Correcto";
                  }else{
                    echo "Incorrecto";
                  }?>
                    
                  </option>
                  <option value="1">Correcto</option>
                  <option value="0">Incorrecto</option>
                </select>
            </label>
            <label>Comentario
                <textarea form="formulario-edit" maxlength="300" name="ComenIncorrectoA"><?php echo "$this->lista_valores['ComenIncorrectoA']" ?></textarea>
            </label>
            <label>Corrección del profesor
                <select name="CorrectoP" id="CorrectoP" required="true" size="1">
                  <option selected="true"> value="<?php echo "$this->lista_valores['CorrectoP']" ?>"><?php if($this->lista_valores['CorrectoP']==1){
                    echo "Correcto";
                  }else{
                    echo "Incorrecto";
                  }?>
                    
                  </option>
                  <option value="1">Correcto</option>
                  <option value="0">Incorrecto</option>
                </select>
            </label>
            <label>Comentario
                <textarea form="formulario-edit" maxlength="300" name="ComenIncorrectoP"><?php echo "$this->lista_valores['ComenIncorrectoP']" ?></textarea>
            </label>
            <label>Corrección de la evaluación
                <select name="OK" id="OK" required="true" size="1">
                  <option selected="true"> value="<?php echo "$this->lista_valores['OK']" ?>"><?php if($this->lista_valores['OK']==1){
                    echo "Correcto";
                  }else{
                    echo "Incorrecto";
                  }?>
                    
                  </option>
                  <option value="1">Correcto</option>
                  <option value="0">Incorrecto</option>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}//fin clase
?>