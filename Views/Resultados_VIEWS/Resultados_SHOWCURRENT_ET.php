<?php
/**
* Author: IU Spartans
 * Vista de Showcurrent de ET
 * Date: 13/12/2017
 */

class Resultados_SHOWCURRENT_ET
{
//Declaracion de los atributos
    var $datos;
    var $lista_descripHist;
    var $indexphp;

    //Constructor de la clase
    function __construct($lista, $datos, $lista_descripHist, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase


        $this->datos = $datos;
        $this->lista_descripHist=$lista_descripHist;
        $this->indexphp = $indexphp;
        $this->pinta();
    }

//Envía contenido al navegador
    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		if(!isAllow('ResEt','Show')){

			echo $strings['No tienes permiso para acceder a esta vista'];

		//Si tiene permisos pero no es adminitrador
		}else if (!isAdmin() && isAllow('ResEt','Show')){
        $correctos=array();
        $comentarios=array();
            for($i=1;$i<=count($this->lista_descripHist);$i++){//recorre las descripciones de historias
                $correctoP='1';
                $incorrectoP='';
                $correctos=array();
                $comentarios=array();
                foreach($this->datos as $tupla){//busca en el recordset las cinco correcciones de la historia
                    if($tupla['IdHistoria']==$i){
                        array_push($correctos,$tupla['CorrectoA']);//almacena en un array las correcciones
                        array_push($comentarios,$tupla['ComenIncorrectoA']);//almacena en un array los comentarios
                        if($tupla['CorrectoP']==0){
                             $correctoP=$tupla['CorrectoP'];
                             $incorrectoP=$tupla['ComentIncorrectoP'];
                        }
                    }
                }//fin bucle foreach
            ?>
            <table id="tabla-resultados">    
                <tr>
                    <h3><?php echo $i . "   " . $this->lista_descripHist[$i-1]?></h3>
                </tr>
                <tr>
                    <?php
                    for($j=0;$j<5;$j++){
                        if($correctos[$j]==0){
                            ?>
                            <td class="celda-incorrecta"></td>
                            <?php
                        } else {
                            ?>
                            <td class="celda-correcta"></td>
                            <?php
                        } 
                    }
                    if($correctoP==0){
                        ?>
                        <td class="celda-incorrecta">P</td>
                        <?php
                    } else {
                        ?>
                        <td class="celda-correcta">P</td>
                        <?php
                    } 
                    ?>
                </tr>
                <tr>
                    <?php
                    if($incorrectoP!='') 
                        echo "Profesor:  " .$incorrectoP . "<br>"?>
                    <?php
                        for($j=0;$j<5;$j++){
                            if($comentarios[$j]!='')
                                echo $j+1 . ":  " . $comentarios[$j] . "<br>";
                        }
                    ?>
                </tr>
            </table>

                <?php
                    } //fin bucle for
			}
    }
}

?>