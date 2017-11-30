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

        ?>

        <form id="formulario-edit" name="formulario_edit" method="post">
            <label>Login
                <input type="text" name="login"
                       id="login" required="true" readonly
                       size="9" maxlength="9"  value="<?php echo $this->lista_valores['login'] ?>"
                />
            </label>
            <label>Password
                <input type="password" name="password"
                       id="password" required="true"
                       size="20" maxlength="20"value="<?php echo $this->lista_valores['Password'] ?>"
                />
            </label>
            <label>DNI
                <input type="text" name="DNI"
                       id="DNI" required="true"
                       size="9" maxlength="9"value="<?php echo $this->lista_valores['DNI'] ?>"
                />
            </label>
            <label>Nombre
                <input type="text" name="Nombre"
                       id="Nombre" required="true"
                       size="30" maxlength="30"value="<?php echo $this->lista_valores['Nombre'] ?>"
                />
            </label>
            <label>Apellidos
                <input type="text" name="Apellidos"
                       id="Apellidos" required="true"
                       size="50" maxlength="50"value="<?php echo $this->lista_valores['Apellidos'] ?>"
                />
            </label>
            <label>Correo
                <input type="text" name="Correo"
                       id="Correo" required="true"
                       size="40" maxlength="40"value="<?php echo $this->lista_valores['Correo'] ?>"
                />
            </label>
            <label>Direccion
                <input type="text" name="Direccion"
                       id="Direccion" required="true"
                       size="60" maxlength="60"value="<?php echo $this->lista_valores['Direccion'] ?>"
                />
            </label>
            <label>Telefono
                <input type="text" name="Telefono"
                       id="Telefono" required="true"
                       size="11" maxlength="11"value="<?php echo $this->lista_valores['Telefono'] ?>"
                />
            </label>
            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit"><img class="button-td" src="../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../Controllers/Index_Controller.php"><img class="button-td" src="../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin pinta

}//fin clase
?>