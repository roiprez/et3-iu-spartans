<?php

class Usu_Grupo_ADD// declaración de clase
{

	//declaracion de atributos
	var $lista_usuarios;
	var $lista_grupos;
	var $lista_valores;

    //Constructor
    function __construct($lista_usuarios,$lista_grupos,$lista_valores)
    {	
    	$this->lista_usuarios=$lista_usuarios;
    	$this->lista_valores=$lista_valores;
    	$this->lista_grupos=$lista_grupos;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-usu_grupo" name="formulario_usu_grupo" method="post">

        	<table>
            <tr>
                <th>Usuario</th>
                <th>Grupos</th>
            </tr>

            <?php
				


				
            foreach ($this->lista_usuarios as $usuario)//recorre todos los usuarios creados creando una fila por usuario
            {
                ?>
                    <tr>
                    	<td>
                            <?php echo $usuario['login'] ;?>
                            <input type="hidden"  name="login"  value="<?php echo $usuario['login'] ;?>">
                        </td>
                    	<td>
                            <select multiple="true">
                    	<?php
                            $grupos_usuario=array();
                            foreach ($this->lista_valores as $tupla) {//recorre el recordset de datos
                                if ($tupla['login']==$usuario['login']) {//almacena en un array los grupos a los que pertenece el usuario
									echo "esto peta";
									$grupos_usuario[]=$tupla['IdGrupo'];
								}//fin if
                            }//fin foreach
							for($i=0;$i<count($this->lista_grupos);$i++){//recorre la lista de todos los grupos posibles

                                for($j=0;j<count($grupos_usuario);$j++){//recorre los grupos a los que pertenece el usuario
					               if ($grupos_usuario[j]==$this->lista_grupos[$i]) {//si encuentra el grupo dentro de los grupos del usuario seleccionado=true
                                       $seleccionado=true;
                                   }//fin del if
                                }//fin del bucle for interno

                                if ($seleccionado==true) {//si esta seleccionado opcion seleccionada para ese grupo
                                    ?>
                                    <option selected="true" value="<?php echo $this->lista_grupos[$i] ;?>">
                                        <?php echo $this->lista_grupos[$i];?>
                                    </option>
                                    <?php
                                }else{//si no esta seleccionado opcion normal para ese grupo
                                    ?>
                                    <option value="<?php echo $this->lista_grupos[$i] ;?>">
                                        <?php echo $this->lista_grupos[$i] ;?>
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