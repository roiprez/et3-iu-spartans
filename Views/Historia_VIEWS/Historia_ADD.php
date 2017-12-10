<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 12:11
 */

class Historia_ADD
{
    var $lista_Trabajos;




    //Constructor
    function __construct($lista_Trabajos)
    {

        $this->lista_Trabajos=$lista_Trabajos;

        $this->pinta();
    }
    function pinta()
    {
        //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAdmin()){
            $respuesta= "Usted no tiene permitido acceder a esta vista, contiene información supersecreta de Mor Ardain";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>

        <form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarFormulario('add')">

            <label>Id trabajo

                <select name="IdTrabajo" id="IdTrabajo" required="true">
                    <?php
                    for ($i=0;$i<count($this->lista_Trabajos);$i++) {

                        ?>
                        <option value="<?php echo $this->lista_Trabajos[$i]?>"><?php echo $this->lista_Trabajos[$i]?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>

            <label>Id historia
                <input type="number" name="IdHistoria"
                       id="IdHistoria" required="true"
                       size="2" maxlength="2"
                />
            </label>

            <label>Texto
                <textarea form="formulario-add" maxlength="300" name="TextoHistoria" required="true">
                </textarea>
            </label>



                <div class="botones-formulario">
                    <button id="enviar" name = "action" value = "ADD" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                    <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
                </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}
?>