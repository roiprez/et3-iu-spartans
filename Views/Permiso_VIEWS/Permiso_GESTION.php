<?php

class Permiso_GESTION// declaración de clase
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
                            $j=0;
                            while(true){//recorre la lista de fun accion posibles
                                $permiso = $this->lista_fun_accion[$j][0] . ',' . $this->lista_fun_accion[$j][1];
                                if($this->lista_fun_accion[$j]==null){
                                    break;
                                }
                                $i=0;
                                while (true) {//recorre la lista de permisos ya creados
                                    $permisoyaasignado = $this->lista_valores[$i][0] . ',' . $this->lista_valores[$i][1];
                                    if($this->lista_valores[$i]==null){
                                        break;
                                    }
                                    if($permiso==$permisoyaasignado){//si coinciden el  permiso ya está creado
                                        $sel=true;
                                    }
                                    $i++;
                                }
                                if ($sel==true) {//si esta seleccionado opcion seleccionada para ese permiso
                                    ?>
                                    <option selected="true"  value="<?php echo $permiso ;?>">
                                        <?php echo $this->lista_fun_accion[$j][2].','.$this->lista_fun_accion[$j][3];?>
                                    </option>
                                    <?php
                                }else{//si no esta seleccionado opcion normal para ese permiso
                                    ?>
                                    <option value="<?php echo $permiso ;?>">
                                        <?php echo $this->lista_fun_accion[$j][2].','.$this->lista_fun_accion[$j][3];?>
                                    </option>
                                    <?php
                                }//fin del else
                                $sel=false;//volvemos a poner seleccionado a false
                                $j++;
                            }
                            ?>
                        </select>
                    </td>
                    <td><div class="botones-formulario">
                            <button id="enviar" name = "action" value = "ADDPERMISO" type="submit" title="enviar"><img class="button-td" src="../Iconos/send.png" ></button>
                            <button class="borrar" type="reset" name="limpiar" title="borrar el contenido introducido"> <img class="button-td" src="../Iconos/borrar_campo.png" ></button>
                        </div>
                    </td>
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