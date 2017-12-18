<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 18:02
 */

class Funcionalidad_EDIT
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
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Func','Edit')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarEntidad('funcionalidad','edit')">
            <label><?php echo $strings['Id funcionalidad']; ?>
                <input type="text" name="IdFuncionalidad"
                       id="IdFuncionalidad" required="true" readonly
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdFuncionalidad'] ?>"
                />
            </label>
            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="NombreFuncionalidad"
                       id="NombreFuncionalidad" required="true"
                       size="60" maxlength="60" value="<?php echo $this->lista_valores['NombreFuncionalidad'] ?>"
                />
            </label>
            <label><?php echo $strings['Descripcion']; ?>
                <textarea form="formulario-edit" maxlength="100" name="DescripFuncionalidad" ><?php echo $this->lista_valores['DescripFuncionalidad'] ?></textarea>
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido'];?>"><img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás'];?>" ><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>

