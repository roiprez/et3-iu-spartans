<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 01/12/2017
 * Time: 18:16
 */

class Accion_EDIT
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
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>


        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarEntidad('accion','edit')">

            <label><?php echo $strings['Id Accion']; ?>
                <input type="text" name="IdFuncionaAccion"
                       id="IdFuncionaAccion" required="true" readonly
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdAccion'] ?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="NombreFuncionaAccion"
                       id="NombreFuncionaAccion" required="true"
                       size="60" maxlength="60" value="<?php echo $this->lista_valores['NombreAccion'] ?>" onChange ="return comprobarAlfabetico(this,this.size,'edit');"
                />
            </label>
            <label><?php echo $strings['Descripcion']; ?>
                <textarea form="formulario-edit" maxlength="100" name="DescripAccion" onChange ="return comprobarTexto(this,this.size);">
                <?php echo $this->lista_valores['DescripAccion'] ?>
                </textarea>
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="<?php echo $strings['enviar']?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'  title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>

