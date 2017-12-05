<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 30/11/2017
 * Time: 13:22
 */

class Usuario_SEARCH
{

    //Constructor de la clase
    function __construct(){
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label>Login
                <input type="text" name="login"
                       id="login"
                       size="9" maxlength="9"
                />
            </label>
            <label>Password
                <input type="password" name="password"
                       id="password"
                       size="20" maxlength="20"
                />
            </label>
            <label>DNI
                <input type="text" name="DNI"
                       id="DNI"
                       size="9" maxlength="9" onBlur="comprobarDni(this,'search')"
                />
            </label>
            <label>Nombre
                <input type="text" name="Nombre"
                       id="Nombre"
                       size="30" maxlength="30" onBlur="comprobarAlfabetico(this, this.size, 'search')"
                />
            </label>
            <label>Apellidos
                <input type="text" name="Apellidos"
                       id="Apellidos"
                       size="50" maxlength="50" onBlur="comprobarAlfabetico(this, this.size, 'search')"
                />
            </label>
            <label>Correo
                <input type="text" name="Correo"
                       id="Correo"
                       size="40" maxlength="40" onBlur="comprobarEmail(this,this.size,'search')"
                />
            </label>
            <label>Direccion
                <input type="text" name="Direccion"
                       id="Direccion"
                       size="60" maxlength="60" onBlur="comprobarAlfabetico(this, this.size, 'search')"
                />
            </label>
            <label>Telefono
                <input type="text" name="Telefono"
                       id="Telefono"
                       size="11" maxlength="11" onBlur="comprobarTelf(this)"
                />
            </label>

            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit"><img class="button-td" src="../../Iconos/search.png" title="buscar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin de pinta

}//fin de la clase
?>