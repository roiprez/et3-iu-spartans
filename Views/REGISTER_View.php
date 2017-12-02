<?php
	/*
	*Vista que muestra el formulario de registro al usuario

	*/
class Register{
    function __construct(){
        $this->render();
    }

    function render(){
        include '../Views/Header.php';
        $Header = new Header();
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <h1><?php echo $strings['Registro']; ?></h1>
        <form id="formulario-registro" name="formulario_registro" method="post" onsubmit="return validarFormulario('reg') && encriptar()">
            <label>Login
                <input type="text" name="login" id = 'login' required="true" size="9" maxlength="9" onchange="comprobarVacio(this) && comprobarTexto(this, 9)"/>
            </label>
            <label>Password
                <input type="password" name="password" id = 'password' required="true" size="20" maxlength="20" onchange="comprobarVacio(this) && comprobarTexto(this, 20)"/>
            </label>
            <label>DNI
                <input type="text" name="DNI" required="true" size="9" maxlength="9" onchange="comprobarVacio(this) && comprobarDni(this)"/>
            </label>
            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="Nombre" required="true" size="30" maxlength="30" required="true" onchange="comprobarVacio(this) && comprobarAlfabetico(this, 30)"/>
            </label>
            <label><?php echo $strings['Apellidos']; ?>
                <input type="text" name="Apellidos" required="true" size="50" maxlength="50" required="true" onchange="comprobarVacio(this) && comprobarAlfabetico(this, 50)"/>
            </label>
            <label>Email
                <input type="text" name="Correo" required="true" size="40" maxlength="40" onchange="comprobarEmail(this, 40)"/>
            </label>

            <label>Direccion
                <input type="text" name="Direccion" required="true" size="60" maxlength="60" />
            </label>
             <label><?php echo $strings['Teléfono']; ?>
                <input type="text" name="Telefono" required="true" size="11" maxlength="11" required="true" onchange="comprobarTelf(this)"/>
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../Iconos/send.png" title="enviar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
				
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button> <!--Imagen para la accion back,que permite volver al menu principal-->
		</center></form>
		
        <?php
        include '../Views/Footer.php';
        $Footer = new Footer();
    } //fin metodo render

} //fin REGISTER

?>

	