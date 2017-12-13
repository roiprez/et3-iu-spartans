<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 13/12/2017
 * Time: 11:42
 */

class Resultados_SHOWCURRENT_ET
{

    var $datos;
    var $lista_descripHist;
    var $indexphp;

    //Constructor de la clase
    function __construct( $datos,$lista_descripHist, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase


        $this->datos = $datos;
        $this->lista_descripHist=$lista_descripHist;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

    function pinta(){
        //include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        if (IsAuthenticated()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
        }else{
            ?>
            <table id="tabla-resultados">
            <?php
                for($i=0;count($this->lista_descripHist);$i++){
                    $correctos=array();
                    $comentarios=array();
                    foreach($this->datos as $tupla){//busca en el recordset las cinco correcciones de la historia
                        if($tupla['idHistoria']==$i){
                            array_push($correctos,$tupla['correctoA']);//almacena en un array las correcciones
                            array_push($comentarios,$tupla['ComenIncorrectoA']);//almacena en un array los comentarios
                            $correctoP=$tupla['correctoP'];
                            $incorrectoP=$tupla['comenIncorrectoP'];
                        }
                    }//fin bucle foreach
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $this->lista_descripHist[$i] ?></td>
                </tr>
                <tr>
                    <td><?php echo $correctoP ?></td>
                    <?php
                    for($j=0;$j<5;$j++){
                        ?>
                        <td><?php echo $correctos[$j]?></td>
                        <?php
                    }
                    ?>

                </tr>
                <tr>
                    <td>
                    <?php echo $incorrectoP?>
                    <?php
                    for($j=0;$j<5;$j++){
                       echo $comentarios[$j];
                    }
                    ?>
                    </td>
                </tr>


                <?php
                    } //fin bucle for
                ?>
            </table>
            <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
                <button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
            <?php
        }//Fin else
    }
}

?>