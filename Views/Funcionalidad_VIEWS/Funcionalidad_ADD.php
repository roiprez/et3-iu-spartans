<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 17:59
 */

class Funcionalidad_ADD
{
    //Constructor
    function __construct()
    {
        $this->pinta();
    }
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Func','Add')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarEntidad('funcionalidad','add')">

            <label><?php echo $strings['Id funcionalidad']; ?>
                <input type="text" name="IdFuncionalidad"
                       id="IdFuncionalidad" required="true"
                       size="6" maxlength="6" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>

            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="NombreFuncionalidad"
                       id="NombreFuncionalidad" required="true"
                       size="60" maxlength="60" onChange ="return comprobarAlfabetico(this,this.size,'edit');"
                />
            </label>
            <label><?php echo $strings['Descripcion']; ?>
                <textarea form="formulario-add" maxlength="100" name="DescripFuncionalidad" required="true" onChange ="return comprobarTexto(this,this.size);"></textarea>
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido'] ;?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}
?>