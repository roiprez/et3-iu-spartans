<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 25/11/17
 * Time: 13:11
 */

class Vista_DELETE{

    var $lista_variables;
    var $lista_valores;


    //Constructor de la clase
    function __construct($lista_variables,$lista_valores){
        //asignación de valores de parámetro a los atributos de la clase
        $this->lista_variables=$lista_variables;
        $this->lista_valores = $lista_valores;
        $this->pinta();
    }

    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <table id="tabla-delete">
            <div id="mensaje-de-borrado">
                <img src="../iconos/error.png">
                <p id="frase-borrado-tupla"><?php echo $strings['¿Está seguro de querer borrar los siguientes datos?'] ?></p>
            </div>
            <?php for($i=0;$i<count($this->lista_variables);$i++){

                ?>
                <tr>
                    <th><?php echo $this->lista_variables[$i]; ?></th>
                    <td class="celda"><?php echo $this->lista_valores[$i]; ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <form id="formulario-borrado" method="post">
                    <td class="celda-botones">
                        <button name="atras" type="button"><a href="../Controllers/Index_Controller.php"><img class="button-td" src="../Iconos/back.png" title="atrás"></img></a></button>
                    </td>
                    <td class="celda-botones">
                        <button type = "submit" name = "action" value = "DELETE"><img class="button-td" src="../Iconos/borrar.png" title="borrar"></img></button>
                    </td>
                </form>
            </tr>
        </table>

        <?php
    }//fin pinta
}//fin clase
?>
