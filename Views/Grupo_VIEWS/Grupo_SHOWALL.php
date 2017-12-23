<?php
/**
 * Author: IU Spartans
 * Vista de Showall de Grupo
 * Date: 30/11/2017
 */


class Grupo_SHOWALL{  // declaración de clase

//Declaracion de los atributos
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

//Envía contenido al navegador
    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Group','Show')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            //Si esta autenticado y es administrador
            }else{

        ?>
        <form id="formulario-showall" method="">
            <div id="botones-comunes">
                <button type = "submit" name = "action" value="ADD" title="<?php echo $strings['añadir una fila'];?>"><img src="../Iconos/add.png" ></button>
                <button type = "submit" name = "action" value="SEARCH" title="<?php echo $strings['buscar en la tabla'];?>"><img src="../Iconos/search.png" ></button>
            </div>
        </form>
        <table id="tabla-showall">
            <tr>
                <?php
                for ($i = 0; $i < count($this->lista); $i++) {//recorre la lista de variables
                    ?>
                    <th><?php $columna = $this->lista[$i];
					echo $strings[$columna];?></th>
                    <?php
                }
                ?>
            </tr>

            <?php
            while($row = $this->datos->fetch_array())
            {//recorre el recordset de datos tupla a tupla
                ?>
                <form class="formulario-tupla" method="">
                    <tr>
                        <?php
                        for ($i = 0; $i < count($this->lista); $i++) {//recorre la lista de variables
                            ?>
                            <td class="celda"><?php echo $row[$this->lista[$i]]?><input type="hidden" name="<?php echo $this->lista[$i]?>" value="<?php echo $row[$this->lista[$i]]?>"></td>
                            <?php
                        }
                        ?>
                        <td><button type = "submit" name = "action" value="SHOWCURRENT" title="<?php echo $strings['Ver en detalle'];?>"><img class="button-td" src="../Iconos/details.png" ></button></td>
                        <td><button type = "submit" name = "action" value="EDIT" title="<?php echo $strings['editar'];?>"><img class="button-td" src="../Iconos/edit.png" ></button></td>
                        <td><button type = "submit" name = "action" value="ADDPERMISO" title="<?php echo $strings['editar permisos'];?>"><img class="button-td" src="../Iconos/functionality_add.png" ></button></td>
                        <td><button type = "submit" name = "action" value="DELETE" title="<?php echo $strings['borrar línea'];?>"><img class="button-td" src="../Iconos/borrar.png" ></button></td>
                    </tr>
                </form>
                <?php
            }//fin del while
            ?>

        </table>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás'];?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pinta
}//fin de la clase

?>