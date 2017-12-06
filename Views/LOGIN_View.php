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

            <input type = 'text' name = 'login' placeholder = 'login' size = '9' maxlength="9" onchange="comprobarVacio(this) && comprobarTexto(this, 9)"  ><br>
            <input type = 'password' name = 'password' id='password' placeholder = 'password' maxlength="20" size = '20' value = '' onchange="comprobarVacio(this) && comprobarTexto(this, 20)"  ><br>

            <button id="enviar" type='submit' name='action'  title="enviar"><img class="button-td" src="../Iconos/send.png"></img></button>
        </form>


        <form id="formulario-registro" action="../Controllers/Registro_Controller.php" method="post" style="border:none;">

        <button id="boton-registro" type='submit' name='action' title="Registrarse"><img class="button-td" src="../Iconos/ic_person_add.png" ></img></button>
        </form>


        <?php

        include '../Views/Footer.php';
        $Footer = new Footer();
    } //fin metodo render

} //fin Login

?>
