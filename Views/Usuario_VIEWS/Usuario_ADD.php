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

      //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add') && encriptar()">

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
                       size="9" maxlength="9" onBlur="comprobarDni(this,'add')"
                />
            </label>
            <label>Nombre
                <input type="text" name="Nombre"
                       id="Nombre" required="true"
                       size="30" maxlength="30" onBlur="comprobarAlfabetico(this, this.size, 'add')"
                />
            </label>
            <label>Apellidos
                <input type="text" name="Apellidos"
                       id="Apellidos" required="true"
                       size="50" maxlength="50" onBlur="comprobarAlfabetico(this, this.size, 'add')"
                />
            </label>
            <label>Correo
                <input type="text" name="Correo"
                       id="Correo" required="true"
                       size="40" maxlength="40" onBlur="comprobarEmail(this,this.size,'add')"
                />
            </label>
            <label>Direccion
                <input type="text" name="Direccion"
                       id="Direccion" required="true"
                       size="60" maxlength="60" onBlur="comprobarAlfabetico(this, this.size, 'add')"
                />
            </label>
            <label>Telefono
                <input type="text" name="Telefono"
                       id="Telefono" required="true"
                       size="11" maxlength="11" onBlur="comprobarTelf(this)"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
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