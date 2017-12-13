<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 13/12/2017
 * Time: 11:42
 */

class Resultados_SHOWCURRENT_ET
{
    var $lista;
    var $datos;
    var $lista_descripHist;
    var $indexphp;

    //Constructor de la clase
    function __construct($lista, $datos,$lista_descripHist, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase

        $this->lista = $lista;
        $this->datos = $datos;
        $this->lista_descripHist=$lista_descripHist;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
        }else{
            ?>
            <table id="tabla-showall">
            <?php
                for($i=0;count($this->lista_descripHist);$i++){
            ?>
                <tr></tr>
                <tr></tr>
                <tr></tr>


                <?php
                    } //fin bucle for
                ?>
            </table>
            <form id="Formulario-mensaje" action="../../Controllers/Index_Controller.php" method="get">
                <button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
            <?php
        }//Fin else
    }
}

?>