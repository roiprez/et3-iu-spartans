<?php
/**
* Author: IU Spartans
* Vista de Showall de Entrega
* Date: 07/12/2017
*/

class Entrega_SHOWALL{  // declaración de clase

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

        //Envía contenido al navegador
        $this->pinta();
	}

//Envía contenido al navegador
    function pinta(){

        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
       //Si no tiene permiso
        if(!isAllow('Entre','Show')){
            echo $strings['No tienes permiso para acceder a esta vista'];

        }//Si no es administrador pero tiene permisos
       else if (!isAdmin() && isAllow('Entre','Show')){
        ?>
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
            while($row = $this->datos->fetch_array())//recorre el recordset de datos tupla a tupla
            {
                //Comprobamos si el login de la entrega coincide con el usuario que está logeado y si coincide se muestra la entrega
                if($row[1] == $_SESSION['login']){
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
						
                       <?php
						//Comprobacion de la fecha de entrega
						
					   if(enFecha($row[0])){?>
                        <td><button type = "submit" name = "action" value="EDIT" title="<?php echo $strings['editar']; ?>"><img class="button-td" src="../Iconos/edit.png" ></img></button></td>
					   <?php } ?>
                    </tr>
                </form>
                <?php
            }//Fin if
        }//Fin while
            ?>

        </table>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
        <button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php

            //Si esta autenticado y es administrador
            }else{
        ?>
        <form id="formulario-showall" method="">
            <div id="botones-comunes">
                <button type = "submit" name = "action" value="ADD" title="<?php echo $strings['añadir una fila']; ?>"><img src="../Iconos/add.png" ></button>
                <button type = "submit" name = "action" value="SEARCH" title="<?php echo $strings['buscar en la tabla']; ?>"><img src="../Iconos/search.png" ></button>
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
            while($row = $this->datos->fetch_array())//recorre el recordset de datos tupla a tupla
            {
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
                        <td><button type = "submit" name = "action" value="SHOWCURRENT"  title="<?php echo $strings['Ver en detalle']; ?>"><img class="button-td" src="../Iconos/details.png"></img></button></td>
                        <td><button type = "submit" name = "action" value="EDIT" title="<?php echo $strings['editar']; ?>"><img class="button-td" src="../Iconos/edit.png" ></img></button></td>
                        <td><button type = "submit" name = "action" value="QACHECK" title="<?php echo $strings['qaChek']; ?>"><img class="button-td" src="../Iconos/functionality_add.png" ></img></button></td>
                        <td><button type = "submit" name = "action" value="DELETE"  title="<?php echo $strings['borrar línea']; ?>"><img class="button-td" src="../Iconos/borrar.png"></img></button></td>
                    </tr>
                </form>
                <?php
            }

        ?>

        </table>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
    <?php
}

}
}
?>

