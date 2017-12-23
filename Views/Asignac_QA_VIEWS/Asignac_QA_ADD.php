<?php
/**
 * Vista de Add de Asignac_QA
 * Date: 08/12/2017
 */


class Asignac_QA_ADD// declaración de clase
{

    //Constructor
    function __construct()
    {

        $this->pinta();
    }
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
         if (IsAuthenticated() && !isAllow('Asig_Qua','Add')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add') ">

            <label><?php echo $strings['Login del evaluado']; ?>
                 <input type="text" name="LoginEvaluado"
                       id="LoginEvaluado"
                       size="9" maxlength="9"
                />
            </label>
            <label><?php echo $strings['Alias']; ?>
                <input type="text" name="Alias"
                       id="Alias" required="true"
                       size="6" maxlength="6"
                />
            </label>
            <label><?php echo $strings['Id del Trabajo']; ?>
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" required="true"
                       size="6" maxlength="6"
                />
            </label>
            <label><?php echo $strings['Login del evaluador']; ?>
                <input type="text" name="LoginEvaluador"
                       id="LoginEvaluador"
                       size="9" maxlength="9"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
		
		<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->

        <?php
        }//Fin else
    }//fin pinta

}//fin clase
?>