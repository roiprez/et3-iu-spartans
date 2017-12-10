<?php
/**
 * Created by PhpStorm.
 * User: Drubito
 * Date: 30/11/2017
 * Time: 13:35
 */

class Grupo_SEARCH
{


//Constructor
function __construct()
{
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

<form id="formulario-add" name="formulario_add" method="post" onSubmit="return validarBusqueda()">

    <label>Id del grupo
        <input type="text" name="IdGrupo"
               id="IdGrupo"
               size="6 maxlength="6"
        />
    </label>

    <label>Nombre
        <input type="text" name="NombreGrupo"
               id="NombreGrupo"
               size="60" maxlength="60"
        />
    </label>
    <label>Descripcion
        <textarea form="formulario-edit" maxlength="100" name="DescripGrupo">

        </textarea>
    </label>
    <div class="botones-formulario">
        <button id="buscar" name = "action" value = "SEARCH" type="submit" title="buscar"><img class="button-td" src="../Iconos/search.png" ></button>
        <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
    </div>
</form>
    <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="Volver atrás"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
    <?php
}//Fin else
}//fin de pinta

}//fin de la clase
?>
