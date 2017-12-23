<?php
/**
 * Author: IU Spartans
 * Vista de Search de Historia
 * Date: 02/12/2017
 */

class Historia_SEARCH
{
//Declaracion de los atributos
    var $lista_Trabajos;




//Constructor
    function __construct()
    {
        $this->pinta();
    }

    //Envía contenido al navegador
    function pinta()
    {
include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Hist','Search')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarEntidad('historia','search')">

            <label><?php echo $strings['Id trabajo']; ?>
                <input type="text" name="IdTrabajo" 
                id="IdTrabajo" 
                maxlength="6" size="6"/>
            </label>

            <label><?php echo $strings['Id historia']; ?>
                <input type="number" name="IdHistoria"
                       id="IdHistoria"
                       size="2" maxlength="2"
                />
            </label>

            <label><?php echo $strings['Texto']; ?>
                <textarea form="formulario-add" maxlength="300" name="TextoHistoria"></textarea>
            </label>

            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar']; ?>"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pinta

}//fin de la clase
?>


