<?php

class Usu_Grupo_ADD// declaración de clase
{

	//declaracion de atributos
	var $datosusuario;
	var $lista_grupos;
	var $lista_valores;
	
	var $usuario;
    //Constructor
    function __construct($datosUsuario,$lista_grupos,$lista_valores)
    {	
    	$this->datosUsuario=$datosUsuario;
    	$this->lista_valores=$lista_valores;
    	$this->lista_grupos=$lista_grupos;
		$this->usuario;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
//Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{
		
			$this->usuario = $this->datosUsuario->fetch_array(); //Asignamos al array usuario la tupla contenida en el sql datosUsuario

		
        ?>

        	<table>
            <tr>
                <th>Usuario</th>
                <th>Grupos</th>
				<th>Accion</th>
            </tr>
                    <tr>
                    	<td>
						<form id="formulario-usu_grupo" name="formulario_usu_grupo" method="post">
                            <?php echo $this->usuario['login'] ;?>
                            <input type="hidden"  name="login"  value="<?php echo $this->usuario['login'] ;?>">
                        </td>
                    	<td>
                            <select  multiple name="IdGrupo[]">
                    	<?php
                            $grupos_usuario = array();
                            foreach ($this->lista_valores as $tupla) {//recorre el recordset de datos
                                if ($tupla['login']==$this->usuario['login']) {//almacena en un array los grupos a los que pertenece el usuario
									$grupos_usuario[]=$tupla['IdGrupo'];
								}//fin if
                            }//fin foreach
							for($i=0;$i<count($this->lista_grupos);$i++){//recorre la lista de todos los grupos posibles

                                for($j=0;$j<count($grupos_usuario);$j++){//recorre los grupos a los que pertenece el usuario
					               if ($grupos_usuario[$j]==$this->lista_grupos[$i]) {//si encuentra el grupo dentro de los grupos del usuario seleccionado=true
                                       $sel=true;
                                   }//fin del if
                                }//fin del bucle for interno

                                if ($sel==true) {//si esta seleccionado opcion seleccionada para ese grupo
                                    ?>
                                    <option selected="true" name="<?php echo $this->lista_grupos[$i] ;?>" value="<?php echo $this->lista_grupos[$i] ;?>">
                                        <?php echo $this->lista_grupos[$i];?>
                                    </option>
                                    <?php
                                }else{//si no esta seleccionado opcion normal para ese grupo
                                    ?>
                                    <option name="<?php echo $this->lista_grupos[$i] ;?>"  value="<?php echo $this->lista_grupos[$i] ;?>">
                                        <?php echo $this->lista_grupos[$i] ;?>
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