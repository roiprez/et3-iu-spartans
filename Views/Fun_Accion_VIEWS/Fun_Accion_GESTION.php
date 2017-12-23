<?php
/**
* Author: IU Spartans
 * Vista de Gestion de las Fun_Accion 
 * Date: 04/12/2017
 */
class Fun_Accion_GESTION// declaración de clase
{
//declaracion de atributos
	var $lista_acciones;
    var $lista_nombre_acciones;
    var $funcionalidad;
	var $nombre_funcionalidad;
	var $lista_valores;

    //Constructor
    function __construct($lista_acciones,$lista_nombre_acciones,$funcionalidad,$nombre_funcionalidad,$lista_valores)
    {	
        //asignación de valores de parámetro a los atributos de la clase
        $this->lista_acciones=$lista_acciones;
        $this->lista_nombre_acciones=$lista_nombre_acciones;
        $this->funcionalidad=$funcionalidad;      
    	$this->nombre_funcionalidad=$nombre_funcionalidad;
    	$this->lista_valores=$lista_valores;
        $this->pinta();
    }

    //Envía contenido al navegador
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
        if (IsAuthenticated() && !isAllow('FunAct','Gest')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción    
        //Si esta autenticado y es administrador
        }else{

        ?>
        <h1><?php echo $strings['Funcionalidad']; ?>: <?php echo $this->nombre_funcionalidad?></h1>
        <form id="formulario-usu_grupo" name="formulario_usu_grupo" method="post">

        	<table>
            <tr>
                <th><?php echo $strings['Acción']; ?></th>
                <th><?php echo $strings['Asignado']; ?></th>
            </tr>

            <?php
            for ($i = 0; $i<count($this->lista_acciones);$i++)//recorre todos las funcionalidades creadas creando una fila por funcionalidad
            {
                ?>
                    <tr>
                    	<td class="celda">
                            <?php echo $this->lista_nombre_acciones[$i]?>
                            <input type="text" hidden value="<?php echo $this->lista_acciones[$i]?>">
                        </td>
                    	<td class="celda">
                        <?php
                            if($this->lista_valores[$i]){
                                ?>   
                                <input type="checkbox" name='IdAccion[<?php echo $i?>]' value="<?php echo $this->lista_acciones[$i]?>" checked/>
                                <?php
                            }
                            else {
                                ?>
                                <input type="checkbox" name='IdAccion[<?php echo $i?>]' value="<?php echo $this->lista_acciones[$i]?>"/>
                                <?php
                            }
                        ?>
                    	</td>
                    </tr>
                
                <?php
            }//fin del bucle for each    
            ?>

        </table>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADDACTION" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>