<?php

class Usu_Grupo_ADD// declaración de clase
{

	//declaracion de atributos
	var $datos_grupo;
	var $lista_fun_accion;
	var $lista_valores;
	
	var $grupo;
    //Constructor
    function __construct($datos_grupo,$lista_fun_accion,$lista_valores)
    {	
    	$this->datos_grupo=$datos_grupo;
    	$this->lista_valores=$lista_valores;//recordset de la tabla permiso
    	$this->lista_fun_accion=$lista_fun_accion;//lista de fun_accion disponibles
		$this->grupo;
        $this->pinta();
    }
    function pinta()
    {
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            //Si esta autenticado y es administrador
            }else{
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

		
			$this->grupo = $this->datos_grupo->fetch_array(); //Asignamos al array usuario la tupla contenida en el sql datosUsuario

		
        ?>

        	<table>
            <tr>
                <th>Grupo</th>
                <th>Funcionalidad y accion</th>
				<th>Accion</th>
            </tr>
                    <tr>
                    	<td>
						<form id="formulario-permisos" name="formulario_permisos" method="post">
                            <?php echo $this->grupo['IdGrupo'] ;?>
                            <input type="hidden"  name="IdGrupo"  value="<?php echo $this->grupo['IdGrupo'] ;?>">
                        </td>
                    	<td>
                            <select  multiple name="permiso[]">
                    	<?php
                            $permisos_grupo = array();
                            foreach ($this->lista_valores as $tupla) {//recorre el recordset de datos de permiso
                                if ($tupla['IdGrupo']==$this->grupo['IdGrupo']) {//almacena en un array los permisos que ya tiene el grupo
                                    $permiso=$tupla['IdFuncionalidad'] . ",".$tupla['IdAccion'];//concatenacion de funcionalidad y accion para ser manejado como uno
									$permisos_grupo[]=$permiso;
								}//fin if
                            }//fin foreach
							foreach ($this->lista_fun_accion as $fun_accion){//recorre la lista de todas las fun_accion posibles
                                 $valor=$fun_accion['IdFuncionalidad'] . ",".$fun_accion['IdAccion'];//concatenacion de los dos valores para ser manejados como uno

                                for($j=0;$j<count($permisos_grupo);$j++){//recorre los permisos que ya tenia el grupo
					               if ($permisos_grupo[$j]==$valor) {//si encuentra el permiso en la lista de fun_accion seleccionado=true
                                       $sel=true;
                                   }//fin del if
                                }//fin del bucle for interno

                                if ($sel==true) {//si esta seleccionado opcion seleccionada para ese grupo
                                    ?>
                                    <option selected="true" name="<?php echo $valor ;?>" value="<?php echo $valor ;?>">
                                        <?php echo $valor;?>
                                    </option>
                                    <?php
                                }else{//si no esta seleccionado opcion normal para ese grupo
                                    ?>
                                    <option name="<?php echo $valor;?>"  value="<?php echo $valor ;?>">
                                        <?php echo $valor ;?>
                                    </option>
                                    <?php
                                }//fin del else
                                $sel=false;//volvemos a poner seleccionado a false

							}//fin del bucle for externo
						
                    	?>
                        </select>
                    	</td>
						<td><div class="botones-formulario">
						<button id="enviar" name = "action" value = "ADDGROUP" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
						<button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
						</div></td>
        </form>
                    </tr>

        </table>

            
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'  title="Volver atrás"><img class="button-td" src="../Iconos/back.png"></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>