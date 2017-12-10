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
            $respuesta= "Usted no tiene permitido acceder a esta vista, contiene información supersecreta de Mor Ardain";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post">
            <label>Id accion
                <input type="text" name="IdFuncionaAccion"
                       id="IdFuncionaAccion" required="true" readonly
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdAccion'] ?>"
                />
            </label>
            <label>Nombre
                <input type="text" name="NombreFuncionaAccion"
                       id="NombreFuncionaAccion" required="true"
                       size="60" maxlength="60"value="<?php echo $this->lista_valores['NombreAccion'] ?>"
                />
            </label>
            <label>Descripcion
                <textarea form="formulario-edit" maxlength="100" name="DescripAccion" >
                <?php echo $this->lista_valores['DescripAccion'] ?>
                </textarea>
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'  title="Volver atrás"><img class="button-td" src="../Iconos/back.png"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>

