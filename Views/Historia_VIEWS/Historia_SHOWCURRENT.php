<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 12:30
 */

class Historia_SHOWCURRENT
{
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
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
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
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pintar
}//fin de la clase
?>

