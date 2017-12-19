<?php
/**
 * User: Diego
 * Date: 08/12/2017
 * Time: 10:51
 */

class Asignac_QA_SHOWALL
{
    var $lista;
    var $datos;
    var $indexphp;

    //Constructor de la clase
    function __construct($lista, $datos, $indexphp)
    {
        //asignación de valores de parámetro a los atributos de la clase
        $this->lista = $lista;
        $this->datos = $datos;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

    function pinta()
    {
        if (IsAuthenticated() && !isAllow('Aisg_Qua','Show')) {
            $respuesta = "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción


            //Si esta autenticado y es administrador
        } else {
            include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
             if (IsAuthenticated() && !isAllow('Asig_Qua','ShowAll')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

            ?>
            <form id="formulario-showall" method="">
                <div id="botones-comunes">
                    <button type="submit" name="action" value="SEARCH" title="<?php echo $strings['buscar en la tabla']; ?>"><img
                                src="../Iconos/search.png"></button>
                </div>
            </form>
            <table id="tabla-showall">
                <tr>
                    <?php
                    for ($i = 0; $i < count($this->lista); $i++) {
                        ?>
                        <th><?php $columna = $this->lista[$i];
					echo $strings[$columna];?></th>
                        <?php
                    }
                    ?>
                </tr>

                <?php
                while ($row = $this->datos->fetch_array()) {
                    ?>
                    <form class="formulario-tupla" method="">
                        <tr>
                            <?php
                            for ($i = 0; $i < count($this->lista); $i++) {
                                ?>
                                <td class="celda"><?php echo $row[$this->lista[$i]] ?><input type="hidden"
                                                                                             name="<?php echo $this->lista[$i] ?>"
                                                                                             value="<?php echo $row[$this->lista[$i]] ?>">
                                </td>
                                <?php
                            }
                            ?>
                            <td>
                                <button type="submit" name="action" value="SHOWCURRENT" title="<?php echo $strings['Ver en detalle']; ?>"><img
                                            class="button-td" src="../Iconos/details.png"></img></button>
                            </td>
                        </tr>
                    </form>
                    <?php
                }
                ?>

            </table>
            <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
                <button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td"
                                                                                                 src="../Iconos/back.png"></img>
                </button>
            </form> <!--Imagen para la accion back,que permite volver al menu principal-->
            <?php
        }
    }
}


?>