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

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">

        	<table>
            <tr>
                <th>Usuario</th>
                <th>Grupos</th>
                <th>Grupos a los que ya pertenece</th> 
            </tr>

            <?php
            foreach ($this->lista_usuarios as $usuario) 
            {
                ?>
                <form class="formulario-tupla" method="">
                    <tr>
                    	<td><?php echo '$usuario'?></td>
                    	<td>
                    	<?php
							for($i=0;$i<count($this->lista_grupos);$i++){
							?>
								<label><?php echo "$this->lista_grupos[$i]"?>
								<input type="checkbox" name="IdGrupo"  value="<?php echo "$this->lista_grupos[$i]"?>">
								</label>
							<?php
							}//fin del bucle for
                    	?>
                    	</td>
                    	<td>
                    	<?php
							$row=$this->lista_valores['$usuario']->fetch_array();
							for($i=0;$i<count($row);$i++){
								echo "$row,";
							}//fin de bucle for
                    	?>
                    	</td>
                    </tr>
                </form>
                <?php
            }//fin del bucle for each
            ?>

        </table>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../../Iconos/send.png" title="enviar"></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../../Iconos/borrar_campo.png" title="borrar el contenido introducido"></button>
            </div>
        </form>
        <button name="atras" type="button"><a href="../../Controllers/Index_Controller.php"><img class="button-td" src="../../Iconos/back.png" title="atrás"></a></button>
        <?php
    }//fin pinta

}//fin clase
?>