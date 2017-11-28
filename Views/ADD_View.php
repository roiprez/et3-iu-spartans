<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 25/11/17
 * Time: 10:50
 */
class Vista_ADD// declaración de clase
{  
    //Declaracion de los atributos
    var $lista_variables;//variables requeridas
    var $tamanho_variables;//tamaño de las variables para los inputs

	
	//Constructor
    function __construct($lista_variables,$tamanho_variables)
    {
        $this->tamanho_variables=$tamanho_variables;
        $this->lista_variables=$lista_variables;
        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">
        <?php

        for ($i = 0; $i < count($this->lista_variables); $i++) {//Creacion de inputs segun el numero de atributos

           if($this->lista_variables[$i]!='password'){
				
				switch ($i){
					case 2:
						?>
						<label><?php echo $this->lista_variables[$i] ?>
						<input type="text" name="<?php echo $this->lista_variables[$i] ?>" id="<?php echo $this->lista_variables[$i] ?>" required="true" size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
						onBlur="return comprobarDni(this,'') && comprobarVacio(this)"/>
						</label>
						<?php
						break;
					case 3:
					?>
						<label><?php echo $this->lista_variables[$i] ?>
						<input type="text" name="<?php echo $this->lista_variables[$i] ?>" id="<?php echo $this->lista_variables[$i] ?>" required="true" size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
						onBlur="comprobarAlfabetico(this, 30,'')"/>
						</label>
						<?php
					break;
					case 4:
					?>
						<label><?php echo $this->lista_variables[$i] ?>
						<input type="text" name="<?php echo $this->lista_variables[$i] ?>" id="<?php echo $this->lista_variables[$i] ?>" required="true" size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
						onBlur="comprobarAlfabetico(this, 50,'')"/>
						</label>
						<?php
					break;
					case 5:
					?>
						<label><?php echo $this->lista_variables[$i] ?>
						<input type="text" name="<?php echo $this->lista_variables[$i] ?>" id="<?php echo $this->lista_variables[$i] ?>" required="true" size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
						onBlur="comprobarEmail(this, 40,'')"/>
						</label>
						<?php
					break;
					case 7:
					?>
						<label><?php echo $this->lista_variables[$i] ?>
						<input type="text" name="<?php echo $this->lista_variables[$i] ?>" id="<?php echo $this->lista_variables[$i] ?>" required="true" size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
						onBlur="comprobarTelf(this)"/>
						</label>
						<?php
					break;
					default:
					?>
						<label><?php echo $this->lista_variables[$i] ?>
						<input type="text" name="<?php echo $this->lista_variables[$i] ?>" id="<?php echo $this->lista_variables[$i] ?>" required="true" size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
						/>
						</label>
				<?php }//Fin switch
					
           }else{
               ?>
               <label><?php echo $this->lista_variables[$i] ?>
                   <input type="password" name="<?php echo $this->lista_variables[$i] ?>"
                          id="<?php echo $this->lista_variables[$i] ?>" required="true"
                          size="<?php echo $this->tamanho_variables[$i] ?>" maxlength="<?php echo $this->tamanho_variables[$i] ?>"
                   />
               </label>

               <?php

           }//fin else

        }//fin bucle for
        ?>
		<div class="botones-formulario">
                <button id="enviar" name = "action" value = "ADD" type="submit"><img class="button-td" src="../Iconos/send.png" title="enviar"></img></button>
                <button class="borrar" type="reset" name="limpiar"> <img class="button-td" src="../Iconos/borrar_campo.png" title="borrar el contenido introducido"></img></button>
            </div>
        </form>
		
		<form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button> <!--Imagen para la accion back,que permite volver al menu principal-->
		</center></form>
	
        <?php
    }//fin pinta

}//fin clase
?>