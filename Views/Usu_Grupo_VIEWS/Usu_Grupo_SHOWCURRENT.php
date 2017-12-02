<?php


class Usu_Grupo_SHOWCURRENT{  // declaración de clase

    var $lista_variables;//lista de variables a mostrar
    var $lista_valores;//lista de valores de las variables

    //Constructor de la clase
    function __construct($lista_variables,$lista_valores){

        //asignación de valores de parámetro a los atributos de la clase
        $this->lista_variables = $lista_variables;
        $this->lista_valores=$lista_valores;
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>
        <table id="tabla-detail">

            <h1 class="titulo-categoria">Detalle</h1>

            <?php
            for($i=0;$i<count($this->lista_variables);$i++){
                ?>
                <tr>
                    <th><?php echo $this->lista_variables[$i]?></th>
                    <td class="celda"><?php echo $this->lista_valores[$this->lista_variables[$i]]; ?></td>
                </tr>
                <?php
            }//fin de bucle for
            ?>


        </table>
        <button class="boton-atras" name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></img></a></button>
        <?php
    }//fin de pintar
}//fin de la clase
?>

