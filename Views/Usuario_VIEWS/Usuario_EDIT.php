<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 30/11/2017
 * Time: 13:10
 */



class Usuario_EDIT// declaración de clase
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
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
      //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarFormulario('edit') && encriptar()">
            <label>Login
                <input type="text" name="login"
                       id="login" required="true" readonly
                       size="9" maxlength="9"  value="<?php echo $this->lista_valores['login'] ?>" 
                />
            </label>
            <label>Password
                <input type="password" name="password"
                       id="password" required="true"
                       size="20" maxlength="20" value="<?php echo $this->lista_valores['password'] ?>"
                />
            </label>
            <label>DNI
                <input type="text" name="DNI"
                       id="DNI" required="true"
                       size="9" maxlength="9" value="<?php echo $this->lista_valores['DNI'] ?>" onBlur="comprobarDni(this,'edit')"
                />
            </label>
            <label>Nombre
                <input type="text" name="Nombre"
                       id="Nombre" required="true"
                       size="30" maxlength="30" value="<?php echo $this->lista_valores['Nombre'] ?>" onBlur="comprobarAlfabetico(this, this.size, 'edit')"
                />
            </label>
            <label>Apellidos
                <input type="text" name="Apellidos"
                       id="Apellidos" required="true"
                       size="50" maxlength="50" value="<?php echo $this->lista_valores['Apellidos'] ?>" onBlur="comprobarAlfabetico(this, this.size, 'edit')"
                />
            </label>
            <label>Correo
                <input type="text" name="Correo"
                       id="Correo" required="true"
                       size="40" maxlength="40" value="<?php echo $this->lista_valores['Correo'] ?>" onBlur="comprobarEmail(this,this.size,'edit')"
                />
            </label>
            <label>Direccion
                <input type="text" name="Direccion"
                       id="Direccion" required="true"
                       size="60" maxlength="60" value="<?php echo $this->lista_valores['Direccion'] ?>" onBlur="comprobarAlfabetico(this, this.size, 'edit')"
                />
            </label>
            <label>Telefono
                <input type="text" name="Telefono"
                       id="Telefono" required="true"
                       size="11" maxlength="11" value="<?php echo $this->lista_valores['Telefono'] ?>" onBlur="comprobarTelf(this)"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
      }//Fin else
    }//fin pinta

}//fin clase
?>