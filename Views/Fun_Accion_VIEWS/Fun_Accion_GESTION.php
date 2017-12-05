<?php

class Fun_Accion_GESTION// declaración de clase
{
//declaracion de atributos
	var $lista_usuarios;
	var $lista_grupos;
	var $lista_valores;

    //Constructor
    function __construct($lista_funcionalidades,$accion,$lista_valores)
    {	
    	$this->lista_funcionalidades=$lista_funcionalidades;
    	$this->lista_valores=$lista_valores;
    	$this->accion=$accion;
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
                <th>Acciones</th>
            </tr>

            <?php
            for ($i = 0; $i<count($this->lista_funcionalidades);$i++)//recorre todos las funcionalidades creadas creando una fila por funcionalidad
            {
                ?>
                    <tr>
                    	<td>
                            <?php echo $this->lista_funcionalidades[$i]?>
                            <input type="text" hidden value="<?php echo $this->lista_funcionalidades[$i]?>">
                        </td>
                    	<td>
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
                <button id="enviar" name = "action" value = "ADDFUNCTIONALITY" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}//fin clase
?>