<?php
/**
* Author: IU Spartans
 * Vista de Edit de Nota_Trabajo
 * Date: 08/12/2017
 */

class Nota_Trabajo_EDIT
{
    //Declaracion de los atributos
    var $lista_valores;//valores de las variables

    //Constructor
    function __construct($lista_valores)
    {
//asignación de valores de parámetro a los atributos de la clase
        $this->lista_valores=$lista_valores;

        $this->pinta();
    }

    //Envía contenido al navegador
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Nota','Edit')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>
        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarEntidad('notatrabajo','edit') && encriptar()">
            <label><?php echo $strings['Login']; ?>
                <input type="text" name="login" readonly="true" 
                       id="login" required="true"
                       size="9" maxlength="9" value="<?php echo $this->lista_valores['login']?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Id del Trabajo']; ?>
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" required="true" readonly="true"
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdTrabajo']?>" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Nota del Trabajo']; ?>
                <input type="text" name="NotaTrabajo"
                       id="NotaTrabajo" required="true"
                       size="4" maxlength="4" value="<?php echo $this->lista_valores['NotaTrabajo']?>" onChange ="return comprobarReal(this,3,0,10);"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
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