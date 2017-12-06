<?php

class Fun_Accion_GESTION// declaración de clase
{
//declaracion de atributos
	var $lista_funcionalidades;
	var $accion;
	var $lista_valores;

    //Constructor
    function __construct($lista_funcionalidades,$accion,$lista_valores)
    {	
    	$this->lista_funcionalidades=$lista_funcionalidades;
    	$this->accion=$accion;
    	$this->lista_valores=$lista_valores;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>
        <h1>Acción: <?php echo $this->accion?></h1>
        <form id="formulario-usu_grupo" name="formulario_usu_grupo" method="post">

        	<table>
            <tr>
                <th>Funcionalidad</th>
                <th>Asignado</th>
            </tr>

            <?php
            for ($i = 0; $i<count($this->lista_funcionalidades);$i++)//recorre todos las funcionalidades creadas creando una fila por funcionalidad
            {
                ?>
                    <tr>
                    	<td class="celda">
                            <?php echo $this->lista_funcionalidades[$i]?>
                            <input type="text" hidden value="<?php echo $this->lista_funcionalidades[$i]?>">
                        </td>
                    	<td class="celda">
                        <?php
                            if($this->lista_valores[$i]){
                                ?>   
                                <input type="checkbox" name='IdFuncionalidad[<?php echo $i?>]' value="<?php echo $this->lista_funcionalidades[$i]?>" checked/>
                                <?php
                            }
                            else {
                                ?>
                                <input type="checkbox" name='IdFuncionalidad[<?php echo $i?>]' value="<?php echo $this->lista_funcionalidades[$i]?>"/>
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
                <button id="enviar" name = "action" value = "ADDFUNCTIONALITY" type="submit" title="enviar"><img class="button-td" src="../../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="Volver atras"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}//fin clase
?>