<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 10:55
 */

class Trabajo_SHOWALL
{

    var $lista;
    var $datos;
    var $indexphp;

    //Constructor de la clase
    function __construct($lista, $datos, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase
        $this->lista = $lista;
        $this->datos = $datos;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';

        ?>
        <form id="formulario-showall" method="">
            <div id="botones-comunes">
                <button type = "submit" name = "action" value="ADD"><img src="../../Iconos/add.png" title="añadir una fila"></button>
                <button type = "submit" name = "action" value="SEARCH"><img src="../../Iconos/search.png" title="buscar en la tabla"></button>
            </div>
        </form>
        <table id="tabla-showall">
            <tr>
                <?php
                for ($i = 0; $i < count($this->lista); $i++) {
                    ?>
                    <th><?php echo $this->lista[$i];?></th>
                    <?php
                }
                ?>
            </tr>

            <?php
            while($row = $this->datos->fetch_array())
            {
                ?>
                <form class="formulario-tupla" method="">
                    <tr>
                        <?php
                        for ($i = 0; $i < count($this->lista); $i++) {
                            ?>
                            <td class="celda"><?php echo $row[$this->lista[$i]]?><input type="hidden" name="<?php echo $this->lista[$i]?>" value="<?php echo $row[$this->lista[$i]]?>"></td>
                            <?php
                        }
                        ?>
                        <td><button type = "submit" name = "action" value="SHOWCURRENT"><img class="button-td" src="../../Iconos/details.png" title="detalles"></img></button></td>
                        <td><button type = "submit" name = "action" value="EDIT"><img class="button-td" src="../../Iconos/edit.png" title="editar"></img></button></td>
                        <td><button type = "submit" name = "action" value="DELETE"><img class="button-td" src="../../Iconos/borrar.png" title="borrar línea"></img></button></td>
                    </tr>
                </form>
                <?php
            }
            ?>

        </table>
        <button class="boton-atras" name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></img></a></button>
        <?php
    }
}

?>