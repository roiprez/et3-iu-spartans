<?php
/**
 * User: Diego
 * Date: 07/12/2017
 * Time: 12:32
 */


class Entrega_SEARCH// declaración de clase
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
            $respuesta="No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()" enctype="multipart/form-data" >

            <label><?php echo $strings['Login']; ?>
                <input type="text" name="login"
                       id="login" 
                       size="9" maxlength="9"
                />
            </label>
            <label><?php echo $strings['Id del Trabajo']; ?>
                <input type="text" name="IdTrabajo" 
                       id="IdTrabajo"
                       size="6" maxlength="6"  
                />
            </label>
            <label><?php echo $strings['Alias']; ?>
                <input type="text" name="Alias"
                       id="Alias" 
                       size="9" maxlength="9" 
                />
            </label>
            <label><?php echo $strings['Horas']; ?>
                <input type="number" name="Horas"
                       id="Horas"
                       size="2" maxlength="2"
                />
            </label>
            <label><?php echo $strings['Ruta']; ?>
                <input type="file" name="Ruta"
                       id="Ruta" required="true"
                       size="60" maxlength="60"
                />
            </label>
            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar']; ?>"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
    <button id="boton-mensaje" type='submit' name='action'  title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
      }//Fin else
    }//fin de pinta

}//fin de la clase
?>