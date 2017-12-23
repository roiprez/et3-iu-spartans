<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 13/12/2017
 * Time: 11:42
 */

class Entrega_CHECK_QA
{
    var $idTrabajo;
    var $AliasEvaluado;
    var $datos;
    var $lista_descripHist;
    var $indexphp;

    //Constructor de la clase
    function __construct($idTrabajo,$AliasEvaluado, $datos, $lista_descripHist, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase

        $this->idTrabajo=$idTrabajo;
        $this->AliasEvaluado=$AliasEvaluado;
        $this->datos = $datos;
        $this->lista_descripHist=$lista_descripHist;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		if(!isAllow('ResEt','Show')){

			echo $strings['No tienes permiso para acceder a esta vista'];

		//Si tiene permisos pero no es adminitrador
		}else if (!isAdmin() && isAllow('ResEt','Show')){
        $correctos=array();
        $comentarios=array();
        ?>
        <form id="formulario-OKS" name="formulario_OKS" method="post">
            <input type="text" hidden="true" name="IdTrabajo" value="<?php echo $this->idTrabajo?>">
            <input type="text" hidden="true" name="AliasEvaluado" value="<?php echo $this->AliasEvaluado?>">

            
            <table> 
                <?php
            for($i=1;$i<=count($this->lista_descripHist);$i++){
                $correctos=array();
                $comentarios=array();
                $evaluadores=array();
                foreach($this->datos as $tupla){//busca en el recordset las cinco correcciones de la historia
                    if($tupla['IdHistoria']==$i){
                        array_push($correctos,$tupla['CorrectoA']);//almacena en un array las correcciones
                        array_push($comentarios,$tupla['ComenIncorrectoA']);//almacena en un array los comentarios
                        array_push($evaluadores, $tupla['LoginEvaluador']);//almacena en un array el evaluador de esa historia
                    }
                }//fin bucle foreach
            ?>
            
                <tr>
                    <h3><?php echo $i . "   " . $this->lista_descripHist[$i-1]?></h3>
                </tr>
                <tr>
                    <?php
                    for($j=0;$j<5;$j++){
                        if($correctos[$j]==0){
                            ?>
                            <td class="celda-incorrecta">0</td>
                            <?php
                        } else {
                            ?>
                            <td class="celda-correcta">1</td>
                            <?php
                        } 
                    }
                    ?>
                </tr>
                <tr>
                    <?php
                        for($j=0;$j<5;$j++){
                            if($comentarios[$j]!='')
                                echo $j+1 . ":  " . $comentarios[$j] . "<br>";
                        }
                    ?>
                </tr>
                <tr>
                    <?php
                    for($j=0;$j<5;$j++){
                        
                            ?>
                            <td>
                                <input type="checkbox" name="<?php echo $i.$evaluadores[$j]?>">
                            </td>
                            <?php
                        
                    }
                    ?>

                <?php
                    } //fin bucle for
?>
                            </table>
                            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "QACHECK" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
</form>
<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
        <button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
<?php
			}
    }
}

?>