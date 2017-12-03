<?php

class Fun_Accion_GESTION// declaración de clase
{
//declaracion de atributos
	var $lista_usuarios;
	var $lista_grupos;
	var $lista_valores;

    //Constructor
    function __construct($lista_funcionalidades,$lista_acciones,$lista_valores)
    {	
    	$this->lista_funcionalidades=$lista_funcionalidades;
    	$this->lista_valores=$lista_valores;
    	$this->lista_acciones=$lista_acciones;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-usu_grupo" name="formulario_usu_grupo" method="post">

        	<table>
            <tr>
                <th>Funcionalidad</th>
                <th>Acciones</th>
            </tr>

            <?php
            foreach ($this->lista_funcionalidades as $funcionalidad)//recorre todos las funcionalidades creadas creando una fila por funcionalidad
            {
                ?>
                    <tr>
                    	<td>
                            <?php echo '$funcionalidad'?>
                            <input type="text" hidden name="IdFuncionalidad"  value="<?php echo '$funcionalidad'?>">
                        </td>
                    	<td>
                            <select multiple="true">
                    	<?php
                            var $acciones_funcionalidad [];
                            foreach ($this->lista_valores as $tupla) {//recorre el recordset de datos
                                if ($tupla['IdFuncionalidad']==$funcionalidad) {//almacena en un array con las acciones que pertenecen ya esa funcionalidad
                                    array_push($acciones_funcionalidad, $tupla['IdAccion'])
                                }//fin if
                            }//fin foreach
                            
							for($i=0;$i<count($this->lista_acciones);$i++){//recorre la lista de todas las acciones posibles

                                for($j=0;j<count($acciones_funcionalidad);j++){//recorre las acciones asignadas a esa funcionalidad
					               if ($acciones_funcionalidad[j]==$this->lista_acciones[$i]) {//si encuentra la accion ya asignada a esa funcionalidad seleccionado=true
                                       $seleccionado=true;
                                   }//fin del if
                                }//fin del bucle for interno

                                if ($seleccionado==true) {//si esta seleccionado opcion seleccionada para esa accion
                                    ?>
                                    <option selected="true" value="<?php echo "$this->lista_acciones[$i]"?>">
                                        <?php echo "$this->lista_acciones[$i]"?>
                                    </option>
                                    <?php
                                }else{//si no esta seleccionado opcion normal para ese accion
                                    ?>
                                    <option value="<?php echo "$this->lista_acciones[$i]"?>">
                                        <?php echo "$this->lista_acciones[$i]"?>
                                    </option>
                                    <?php
                                }//fin del else
                                $seleccionado=false;//volvemos a poner seleccionado a false

							}//fin del bucle for externo
                    	?>
                        </select>
                    	</td>
                    </tr>
                
                <?php
            }//fin del bucle for each
            ?>

        </table>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//fin pinta

}//fin clase
?>