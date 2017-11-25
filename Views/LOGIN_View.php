<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 25/11/17
 * Time: 15:40
 */

class Vista_LOGIN{

    function __construct(){
        $this->render();
    }

    function render(){
        /*<?php echo $strings['Login']; ?>*/

        include '../Views/Header.php';
        $Header = new Header();
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';

        ?>
        <h1>Login</h1>
        <form id="formulario-login" name = 'formulario_login' action='./Login_Controller.php' method='post' onsubmit="return encriptar();">

            <input type = 'text' name = 'login' placeholder = 'login' size = '15' maxlength="15" onchange="comprobarVacio(this) && comprobarTexto(this, 15)"  ><br>
            <input type = 'password' name = 'password' id='password' placeholder = 'password' maxlength="20" size = '20' value = '' onchange="comprobarVacio(this) && comprobarTexto(this, 20)"  ><br>

            <button id="enviar" type='submit' name='action'><img class="button-td" src="../Iconos/send.png" title="enviar"></img></button>
        </form>
        <button id="boton-registro"><a href='../Controllers/Registro_Controller.php'><img class="button-td" src="../Iconos/ic_person_add.png" title="Registrarse"></img></a></button>

        <?php

        include '../Views/Footer.php';
        $Footer = new Footer();
    } //fin metodo render

} //fin Login

?>
