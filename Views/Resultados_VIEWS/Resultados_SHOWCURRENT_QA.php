<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 18/12/2017
 * Time: 11:37
 */

class ResultadosSHOWCURRENT_QA
{
    var $QAS;
    var $OKS;

    var $lista_descripHist;
    var $indexphp;

    //Constructor de la clase
    function __construct($QAS,$OKS, $lista_descripHist, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase


        $this->OKS=$OKS;
        $this->QAS=$QAS;
        $this->lista_descripHist=$lista_descripHist;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		if (IsAuthenticated() && !isAllow('Nota','ShowCurrentQA')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        for($i=1;$i<=count($this->lista_descripHist);$i++){//recorre todas las historias, $i=numero de historia actual
           ?>
            <table id="tabla-resultados">
                <tr>
                    <h3><?php echo $i . "   " . $this->lista_descripHist[$i-1]?></h3>
                </tr>
                <tr>
                    <td></td>
                    <th>QA1</th>
                    <th>QA2</th>
                    <th>QA3</th>
                    <th>QA4</th>
                    <th>QA5</th>
                </tr>
                <tr>
                    <td>QA realizadas</td>
                    <?php
                    for($j=0;$j<5;$j++){
                        if($this->QAS[$j][$i]==0){
                            ?>
                            <td class="celda-incorrecta"></td>
                            <?php
                        } else {
                            ?>
                            <td class="celda-correcta"></td>
                            <?php
                        }
                    }
                    ?>
                </tr>
                <tr>
                    <td>Corrección del profesor</td>
                    <?php
                    for($j=0;$j<5;$j++){
                        if($this->OKS[$j][$i]==0){
                            ?>
                            <td class="celda-incorrecta"></td>
                            <?php
                        } else {
                            ?>
                            <td class="celda-correcta"></td>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </table>

            <?php
        } //fin bucle for
        ?>

        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
            <button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button>
        </form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
			}
    }
}

?>