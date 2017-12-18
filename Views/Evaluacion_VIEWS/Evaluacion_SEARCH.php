<?php
/**
 * User: Diego
 * Date: 07/12/2017
 * Time: 21:03
 */


class Evaluacion_SEARCH// declaración de clase
{



    //Constructor
    function __construct()
    {
      
        $this->pinta();
    }
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
       if (IsAuthenticated() && !isAllow('Eval','Search')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarEntidad('entidad','search')"  >

            <label><?php echo $strings['Id del trabajo']; ?>
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" 
                       size="6" maxlength="6"
                />
            </label>
            <label><?php echo $strings['Login evaluador']; ?>
                <input type="text" name="LoginEvaluador"
                       id="LoginEvaluador" 
                       size="9" maxlength="9"
                />
            </label>
            <label> <label><?php echo $strings['Alias evaluado']; ?>
                <input type="text" name="AliasEvaluado"
                       id="AliasEvaluado" 
                       size="9" maxlength="9" 
                />
            </label>
            <label><?php echo $strings['Id de la historia']; ?>
                <input type="number" name="IdHistoria"
                       id="IdHistoria" 
                       size="2" maxlength="2" 
                />
            </label>
            <label><?php echo $strings['Corrección de la historia']; ?>
                <select name="CorrectoA" id="CorrectoA"  size="1">
                  <option selected="true" value="1"><?php echo $this->lista_valores['Correcto'];?></option>
                  <option value="0"><?php echo $this->lista_valores['Incorrecto'];?></option>
                </select>
            </label>
            <label> <label><?php echo $strings['comentario']; ?>
                <textarea form="formulario-search" maxlength="300" name="ComenIncorrectoA"></textarea>
            </label>
            <label><?php echo $strings['Corrección del profesor']; ?>
                <select name="CorrectoP" id="CorrectoP"  size="1">
                  <option selected="true" value="1"><?php echo $this->lista_valores['Correcto'] ?></option>
                  <option value="0"><?php echo $this->lista_valores['Incorrecto'] ?></option>
                </select>
            </label>
            <label> <label><?php echo $strings['comentario']; ?>
                <textarea form="formulario-search" maxlength="300" name="ComenIncorrectoP"></textarea>
            </label>
            <label><?php echo $strings['Corrección de la evaluación']; ?>
                <select name="OK" id="OK"  size="1">
                  <option selected="true" value="1"><?php echo $this->lista_valores['Correcto'] ?></option>
                  <option value="0"><?php echo $this->lista_valores['Incorrecto'] ?></option>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar']; ?>"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
    <button id="boton-mensaje" type='submit' name='action'  title=" <?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
      }//Fin else
    }//fin de pinta

}//fin de la clase
?>