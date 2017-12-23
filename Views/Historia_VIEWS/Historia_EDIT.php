<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 02/12/2017
 * Time: 12:24
 */

class Historia_EDIT
{

    //Declaracion de los atributos
    var $lista_valores;//valores de las variables
    var $lista_Trabajos;

    //Constructor
    function __construct($lista_valores,$lista_Trabajos)
    {

        $this->lista_valores=$lista_valores;
        $this->lista_Trabajos=$lista_Trabajos;

        $this->pinta();
    }
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Hist','Edit')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            //Si esta autenticado y es administrador
            }else{

        ?>
        <form id="formulario-edit" name="formulario_edit" method="post"  onSubmit="return validarEntidad('historia','edit')">
            <label><?php echo $strings['Id trabajo']; ?>

                <select name="IdTrabajo" id="IdTrabajo" required="true">
                    <option selected value="<?php echo $this->lista_valores['IdTrabajo']?>"><?php echo $this->lista_valores['IdTrabajo']?></option>
                </select>
            </label>

            <label><?php echo $strings['Id historia']; ?>

                <input type="number" name="IdHistoria"
                       id="IdHistoria" required="true" readonly
                       size="2" maxlength="2" min="0" value="<?php echo $this->lista_valores['IdHistoria']?>" onChange="comprobarEntero(this, 0, 99)"
                />
            </label>

            <label><?php echo $strings['Texto']; ?>
                <textarea form="formulario-edit" maxlength="300" name="TextoHistoria" required="true" onChange ="return comprobarTexto(this,this.size);"><?php echo $this->lista_valores['TextoHistoria']?></textarea>
            </label>

            <div class="botones-formulario">
                <button id="enviar" name = "action" value = "EDIT" type="submit" title="<?php echo $strings['enviar']; ?>"><img class="button-td" src="../Iconos/send.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
        <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin pinta

}//fin clase
?>



