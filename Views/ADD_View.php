<?php 
/*
	Vista que muestra el formulario para añadir un nuevo usuario a la base de datos
	20/10/2017 por s84f46
	*/

class USUARIOS_ADD{  // declaración de clase
        //Constructor de la clase
        function __construct(){
            $this->pinta();
        }

        function pinta(){
            include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <form id="formulario-add" name="formulario_add" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario('add')">
            <label>Login <input type="text" name="login" id = 'login' required="true" size="15" maxlength="15" onchange="comprobarVacio(this) && comprobarTexto(this, 15)"/></label>
            <label>Password <input type="password" name="password" id = 'password' required="true" size="20" maxlength="20" onchange="comprobarVacio(this) && comprobarTexto(this, 20) && encriptar()"/></label>
            <label>DNI <input type="text" name="DNI" required="true" size="9" maxlength="9" onchange="comprobarVacio(this) && comprobarDni(this)"/></label>
            <label><?php echo $strings['Nombre']; ?> <input type="text" name="nombre" size="30" maxlength="30" required="true" onchange="comprobarVacio(this) && comprobarAlfabetico(this, 30)"/></label>
            <label><?php echo $strings['Apellidos']; ?> <input type="text" name="apellidos" size="50" maxlength="50" required="true" onchange="comprobarVacio(this) && comprobarAlfabetico(this, 50)"/></label>
            <label><?php echo $strings['Teléfono']; ?> <input type="text" name="telefono" size="11" maxlength="11" required="true" onchange="comprobarTelf(this)"/></label>
            <label>Email <input type="text" name="email" required="true" size="60" maxlength="60" onchange="comprobarEmail(this, 60)"/></label>
            <label><?php echo $strings['Fecha de Nacimiento']; ?> <input type="text" name="FechaNacimiento" class="tcal" required="true" readonly="readonly"/></label>
            <label><?php echo $strings['Foto']; ?> <input type="file" name="fotopersonal" size="50" maxlength="50" required="true" /></label>
            <label><?php echo $strings['Sexo']; ?>  <select name="sexo" required="true"/>
						<option value="hombre" selected><?php echo $strings['hombre']; ?></option>
						<option value="mujer"><?php echo $strings['mujer']; ?></option>
					</select></label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../iconos/send.png" title="enviar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../Controllers/Index_Controller.php"><img class="button-td" src="../iconos/back.png" title="atrás"></img></a></button>
        <?php 
    }
}
?>

