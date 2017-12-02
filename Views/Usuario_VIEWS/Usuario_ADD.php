<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 30/11/2017
 * Time: 12:56
 */


class Usuario_ADD// declaración de clase
{

    //Constructor
    function __construct()
    {
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">

            <label>Login
                <input type="text" name="login"
                       id="login" required="true"
                       size="9" maxlength="9"
                />
            </label>
            <label>Password
                <input type="password" name="password"
                       id="password" required="true"
                       size="20" maxlength="20"
                />
            </label>
            <label>DNI
                <input type="text" name="DNI"
                       id="DNI" required="true"
                       size="9" maxlength="9"
                />
            </label>
            <label>Nombre
                <input type="text" name="Nombre"
                       id="Nombre" required="true"
                       size="30" maxlength="30"
                />
            </label>
            <label>Apellidos
                <input type="text" name="Apellidos"
                       id="Apellidos" required="true"
                       size="50" maxlength="50"
                />
            </label>
            <label>Correo
                <input type="text" name="Correo"
                       id="Correo" required="true"
                       size="40" maxlength="40"
                />
            </label>
            <label>Direccion
                <input type="text" name="Direccion"
                       id="Direccion" required="true"
                       size="60" maxlength="60"
                />
            </label>
            <label>Telefono
                <input type="text" name="Telefono"
                       id="Telefono" required="true"
                       size="11" maxlength="11"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
		
		<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->

        <?php
    }//fin pinta

}//fin clase
?>