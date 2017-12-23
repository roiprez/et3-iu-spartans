<?php
/**
* Author: IU Spartans
 * Vista de Search de Permiso
 * Date: 02/12/2017
 */

class Permiso_SEARCH
{

    //declaracion de atributos
    var $lista_Grupos;
    var $lista_Funcion;
    var $lista_Accion;



    //Constructor
    function __construct($lista_Grupos,$lista_Funcion,$lista_Accion)
    {
//asignación de valores de parámetro a los atributos de la clase
        $this->lista_Grupos=$lista_Grupos;
        $this->lista_Funcion=$lista_Funcion;
        $this->lista_Accion=$lista_Accion;
        $this->pinta();
    }

    //Envía contenido al navegador
    function pinta()
    {
        //Si el usuarios está autenticado pero no es administrador 
            if (IsAuthenticated() && !isAllow('Perm','Search')){
            $respuesta= "No tienes permiso para acceder a esta vista";
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php'); //Mostramos el resultado de la ultima inserción
            
        
            //Si esta autenticado y es administrador
            }else{
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

        ?>

        <form id="formulario-search" name="formulario_search" method="post" onSubmit="return validarBusqueda()">

            <label><?php echo $strings['Id grupo']; ?>

                <select name="IdGrupo" id="IdGrupo">
                    <?php
                    foreach($this->lista_Grupos as $grupo) {//recorre lista de grupos

                        ?>
                        <option value="<?php echo $grupo['IdGrupo']?>"><?php echo $grupo['NombreGrupo']?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <label><?php echo $strings['Id funcionalidad']; ?>
                <select name="IdFuncionalidad" id="IdFuncionalidad">
                    <?php
                    foreach ($this->lista_Funcion as $funcion) {//recorre lista de funciones

                        ?>
                        <option value="<?php echo $funcion['idFuncionalidad']?>"><?php echo $funcion['NombreFuncionalidad']?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <label><?php echo $strings['Id accion']; ?>
                <select name="IdAccion" id="IdAccion" >
                    <?php
                    foreach ($this->lista_Accion as $accion) {//recorre lista de acciones

                        ?>
                        <option value="<?php echo $accion['IdAccion']?>"><?php echo $accion['NombreAccion']?></option>
                        <?php

                    }//fin del bucle

                    ?>
                </select>
            </label>
            <div class="botones-formulario">
                <button id="buscar" name = "action" value = "SEARCH" type="submit" title="<?php echo $strings['buscar']; ?>"><img class="button-td" src="../Iconos/search.png" ></button>
                <button class="borrar" type="reset" name="limpiar" title="<?php echo $strings['borrar el contenido introducido']; ?>"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
            </div>
        </form>
       <form id="Formulario-mensaje" action="../Controllers/Index_Controller.php" method="get">
		<button id="boton-mensaje" type='submit' name='action' title="<?php echo $strings['Volver atrás']; ?>"><img class="button-td" src="../Iconos/back.png" ></img></button></form> <!--Imagen para la accion back,que permite volver al menu principal-->
        <?php
    }//Fin else
    }//fin de pinta

}//fin de la clase
?>


