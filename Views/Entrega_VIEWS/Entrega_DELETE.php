<?php
/**
* Author: IU Spartans
* Vista de Delete de Entrega
* Date: 07/12/2017
*/

class Entrega_DELETE{//Declaración de la clase
    //Declaracion de los atributos
    var $lista_variables;//lista de variables
    var $lista_valores;//lista de valores de las variables


    //Constructor de la clase
    function __construct($lista_variables,$lista_valores){
        //asignación de valores de parámetro a los atributos de la clase
        $this->lista_variables=$lista_variables;
        $this->lista_valores = $lista_valores;

        //Envía contenido al navegador
        $this->pinta();
    }

//Envía contenido al navegador
    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
         if (IsAuthenticated() && !isAllow('Entre','Delete')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
        ?>
        <table id="tabla-delete">
            <div id="mensaje-de-borrado">
                <img src="../Iconos/error.png">
                <p id="frase-borrado-tupla"><?php echo $strings['¿Está seguro de querer borrar los siguientes datos?'] ?></p>
            </div>
            <?php for($i=0;$i<count($this->lista_variables);$i++){//recorre las variables a mostrar

                ?>
                <tr>
                    <th><?php $fila = $this->lista_variables[$i]; echo $strings[$fila]; ?></th>
                    <td class="celda"><?php echo $this->lista_valores[$this->lista_variables[$i]]; ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <form id="formulario-borrado" method="post">
                    <td class="celda-botones">
                        <button type = "submit" name = "action" value = "DELETE" title="<?php echo $strings['borrar']; ?>"><img class="button-td" src="../Iconos/borrar.png" ></button>
                    </td>
                </form>
				<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
					 <td class="celda-botones">
					<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button><!--Imagen para la accion back,que permite volver al menu principal-->
					</td>
					</form> 
        
            </tr>
        </table>

        <?php
    }//Fin else
    }//fin pinta
}//fin clase
?>
