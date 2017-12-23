<?php
/**
* Author: IU Spartans
 * Vista de Showcurrent de Notas
 * Date: 15/12/2017
 */

class Notas_SHOWCURRENT
{
//Declaracion de los atributos
    var $trabajos;
    var $notas_trabajos;
    var $lista_atributos;
    var $indexphp;

    //Constructor de la clase
    function __construct($trabajos,$notas_trabajos,$lista_atributos, $indexphp){
        //asignación de valores de parámetro a los atributos de la clase


        $this->trabajos = $trabajos;//recordset de trabajos que incluye el id del trabajo,nombre y su porcentaje
        $this->notas_trabajos=$notas_trabajos;//recordset con id trabajo y su nota
        $this->lista_atributos=$lista_atributos;//lista de atributos a mostrar(idtrabajo,nota,porcentaje)
        $this->indexphp = $indexphp;
        $this->pinta();
    }

//Envía contenido al navegador
    function pinta(){
        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		if (IsAuthenticated() && !isAllow('Nota','Show')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
            ?>
            <table id="tabla-resultados">
           <table id="tabla-showall">
            <tr>
                <?php
                for ($i = 0; $i < count($this->lista_atributos); $i++) {//recorre la lista de atributos
                    ?>
                    <th><?php echo $this->lista_atributos[$i];?></th>
                    <?php
                }
                ?>
            </tr>

            <?php
            $i=0;
            $notas_totales=array();
            while($row = $this->trabajos->fetch_array())//recorre el recordset de datos tupla a tupla
            {
                

                
                foreach ($this->notas_trabajos as $fila) {//recorre las notas de los trabajos
                    if($fila['idTrabajo']==$row['idTrabajo']){
                        $nota=$fila['NotaTrabajo'];
                    }
                }
                $notas_totales[$i]=$nota*$this->trabajos['PorcentajeNota'];
                ?>

                
                    <tr>
                        <td><?php echo $this->trabajos['NombreTrabajo'];?></td>
                        <td><?php if (!is_null($nota)) {
                            echo $nota;
                        }else{
                            echo "-";
                        }?></td>
                        <td><?php echo $this->trabajos['PorcentajeNota'];?></td>
                    </tr>
                    
                <?php
            $i++;
            }
            ?>
            <tr>
                <td>Nota total</td>
                <td><?php
                    $notas=0;
                    for($i=0;$i<count($notas_totales);$i++){
                    $notas+=$notas_totales[$i];
                }
                echo $notas;
                ?></td>
            </tr>

        </table>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
        <button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin else
}//fin pinta
}//fin clase

?>