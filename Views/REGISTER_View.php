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
            <label><?php echo $strings['Login']; ?>
                <input type="text" name="login" id = 'login' required="true" size="9" maxlength="9" onchange="comprobarVacio(this) && comprobarTexto(this, 9)"/>
            </label>
            <label><?php echo $strings['Password']; ?>
                <input type="password" name="password" id = 'password' required="true" size="20" maxlength="20" onchange="comprobarVacio(this) && comprobarTexto(this, 20)"/>
            </label>
            <label><?php echo $strings['DNI']; ?>
                <input type="text" name="DNI" required="true" size="9" maxlength="9" onchange="comprobarDni(this)"/>
            </label>
            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="Nombre" required="true" size="30" maxlength="30" required="true" onchange="comprobarAlfabetico(this, 30)"/>
            </label>
            <label><?php echo $strings['Apellidos']; ?>
                <input type="text" name="Apellidos" required="true" size="50" maxlength="50" required="true" onchange="comprobarAlfabetico(this, 50)"/>
            </label>
            <label><?php echo $strings['Correo']; ?>
                <input type="text" name="Correo" required="true" size="40" maxlength="40" onchange="comprobarEmail(this, 40)"/>
            </label>

            <label><?php echo $strings['Direccion']; ?>
                <input type="text" name="Direccion" required="true" size="60" maxlength="60" />
            </label>
             <label><?php echo $strings['Teléfono']; ?>
                <input type="text" name="Telefono" required="true" size="11" maxlength="11" required="true" onchange="comprobarTelf(this)"/>
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></img></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></img></button>
            </div>
        </form>
				
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Registrarse']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button> <!--Imagen para la accion back,que permite volver al menu principal-->
		</center></form>
		
        <?php
        include '../Views/Footer.php';
        $Footer = new Footer();
    } //fin metodo render

} //fin REGISTER

?>

	