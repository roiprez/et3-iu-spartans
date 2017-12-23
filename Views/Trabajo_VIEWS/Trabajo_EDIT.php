<?php
/**
* Author: IU Spartans
* Vista de Edit de Trabajos
* Date: 02/12/2017
*/

class Trabajo_EDIT
{
    //Declaracion de los atributos
    var $lista_valores;//valores de las variables

    //Constructor
    function __construct($lista_valores)
    {
//asignación de valores de parámetro a los atributos de la clase
        $this->lista_valores=$lista_valores;

        $this->pinta();
    }

    //Envía contenido al navegador
    function pinta()
    {
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Jobs','Edit')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
            
            //Si esta autenticado y es administrador
            }else{

        ?>
        <form id="formulario-edit" name="formulario_edit" method="post" onSubmit="return validarEntidad('trabajo','edit')">
            <label><?php echo $strings['Id Trabajo']; ?>
                <input type="text" name="IdTrabajo"
                       id="IdTrabajo" required="true" readonly
                       size="6" maxlength="6" value="<?php echo $this->lista_valores['IdTrabajo'] ?>" onBlur ="return comprobarTexto(this,this.size);"
                />
            </label>
            <label><?php echo $strings['Nombre Trabajo']; ?>
                <input type="text" name="NombreTrabajo"
                       id="NombreTrabajo" required="true"
                       size="60" maxlength="60" value="<?php echo $this->lista_valores['NombreTrabajo'] ?>" onBlur ="return comprobarAlfabetico(this,this.size,'edit');"
                />
            </label>
            <label><?php echo $strings['Porcentaje Nota']; ?>
                <input type="text" name="PorcentajeNota"
                       id="PorcentajeTrabajo" required="true"
                       size="2" maxlength="2" value="<?php echo $this->lista_valores['PorcentajeNota'] ?>"
                />
            </label>
            <label><?php echo $strings['Fecha inicio']; ?>
                <input type="text" name="FechaIniTrabajo" class="tcal" required="true" readonly="readonly" value="<?php echo $this->lista_valores['FechaIniTrabajo'] ?>"/>
            </label>

            <label><?php echo $strings['Fecha fin']; ?>
                <input type="text" name="FechaFinTrabajo" class="tcal" required="true" readonly="readonly" value="<?php echo $this->lista_valores['FechaFinTrabajo'] ?>"/>
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