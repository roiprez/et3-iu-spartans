<?php

class Fun_Accion_GESTION// declaración de clase
{
//declaracion de atributos
	var $funcionalidad;
	var $lista_acciones;
	var $lista_valores;

    //Constructor
    function __construct($funcionalidad,$lista_acciones,$lista_valores)
    {	
    	$this->funcionalidad=$funcionalidad;
    	$this->lista_valores=$lista_valores;
    	$this->lista_acciones=$lista_acciones;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-fun_accion" name="formulario_fun_accion" method="post">

        	<table>
            <tr>
                <th>Funcionalidad</th>
                <th>Acciones</th>
            </tr>

                    <tr>
                    	<td>
                            <?php echo '$funcionalidad'?>
                            <input type="text" hidden name="IdFuncionalidad"  value="<?php echo '$funcionalidad'?>">
                        </td>
                    	<td>
                            <select  multiple name="IdFuncionalidad[]">
                        <?php
                            $acciones_funcionalidad = array();
                            foreach ($this->lista_valores as $tupla) {//recorre el recordset de datos
                                if ($tupla['IdFuncionalidad']==$funcionalidad) {//almacena en un array las acciones ya definidas para la funcionalidad
                                    $acciones_funcionalidad[]=$tupla['IdAccion'];
                                }//fin if
                            }//fin foreach
                            for($i=0;$i<count($this->lista_acciones);$i++){//recorre la lista de todas las acciones posibles

                                for($j=0;$j<count($acciones_funcionalidad);$j++){//recorre las acciones de la funcionalidad
                                   if ($acciones_funcionalidad[$j]==$this->lista_acciones[$i]) {//si encuentra la accion dentro de las acciones ya definidas seleccionado=true
                                       $sel=true;
                                   }//fin del if
                                }//fin del bucle for interno

                                if ($sel==true) {//si esta seleccionado opcion seleccionada para esa accion
                                    ?>
                                    <option selected="true" name="<?php echo $this->lista_acciones[$i] ;?>" value="<?php echo $this->lista_acciones[$i] ;?>">
                                        <?php echo $this->lista_acciones[$i];?>
                                    </option>
                                    <?php
                                }else{//si no esta seleccionado opcion normal para esa accion
                                    ?>
                                    <option name="<?php echo $this->lista_acciones[$i] ;?>"  value="<?php echo $this->lista_acciones[$i] ;?>">
                                        <?php echo $this->lista_acciones[$i] ;?>
                                    </option>
                                    <?php
                                }//fin del else
                                $sel=false;//volvemos a poner seleccionado a false

                            }//fin del bucle for externo
                        
                        ?>
                        </select>
                        </td>
                    </tr>

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