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
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

      //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarEntidad('usuario', 'add') && encriptar()">

            <label><?php echo $strings['Login']; ?>
                <input type="text" name="login"
                       id="login" required="true"
                       size="9" maxlength="9" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Password']; ?>
                <input type="password" name="password"
                       id="password" required="true"
                       size="20" maxlength="20" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['DNI']; ?>
                <input type="text" name="DNI"
                       id="DNI" required="true"
                       size="9" maxlength="9" onChange="comprobarDni(this,'add')"
                />
            </label>
            <label><?php echo $strings['Nombre']; ?>
                <input type="text" name="Nombre"
                       id="Nombre" required="true"
                       size="30" maxlength="30" onChange="comprobarAlfabetico(this, this.size, 'add')"
                />
            </label>
            <label><?php echo $strings['Apellidos']; ?>
                <input type="text" name="Apellidos"
                       id="Apellidos" required="true"
                       size="50" maxlength="50" onChange="comprobarAlfabetico(this, this.size, 'add')"
                />
            </label>
            <label><?php echo $strings['Correo']; ?>
                <input type="text" name="Correo"
                       id="Correo" required="true"
                       size="40" maxlength="40" onChange="comprobarEmail(this,this.size,'add')"
                />
            </label>
            <label><?php echo $strings['Direccion']; ?>
                <input type="text" name="Direccion"
                       id="Direccion" required="true"
                       size="60" maxlength="60" onChange ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Telefono']; ?>
                <input type="text" name="Telefono"
                       id="Telefono" required="true"
                       size="11" maxlength="11" onChange="comprobarTelf(this)"
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