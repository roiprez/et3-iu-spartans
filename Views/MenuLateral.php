<?php
/*
Vista que contiene el Menú lateral
23/11/2017
*/

  class MenuLateral{
		function __construct(){	
			$this->render();
		}

		function render(){
      include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
      ?>
        <aside>
					<ul class="menu">
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_usuarios')" type="button" name="Controlador" value="<?php echo $strings['USUARIOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_usuarios" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_grupos')" type="button" name="Controlador" value="<?php echo $strings['GRUPOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_grupos" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_funcionalidades')" type="button" name="Controlador" value="<?php echo $strings['FUNCIONALIDADES']; ?>" class="dropbtn"></input>
							<ul id="submenu_funcionalidades" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_acciones')" type="button" name="Controlador" value="<?php echo $strings['ACCIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_acciones" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_permisos')" type="button" name="Controlador" value="<?php echo $strings['PERMISOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_permisos" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_trabajos')" type="button" name="Controlador" value="<?php echo $strings['TRABAJOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_trabajos" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_historias')" type="button" name="Controlador" value="<?php echo $strings['HISTORIAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_historias" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_entregas')" type="button" name="Controlador" value="<?php echo $strings['ENTREGAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_entregas" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_notas')" type="button" name="Controlador" value="<?php echo $strings['NOTAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_notas" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_evaluaciones')" type="button" name="Controlador" value="<?php echo $strings['EVALUACIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_evaluaciones" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_asignaciones')" type="button" name="Controlador" value="<?php echo $strings['ASIGNACIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_asignaciones" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNACIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNACIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNACIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li>					
							<form>
								<input type="hidden" name="qa_gen" value="<?php echo $strings['ET1']; ?>"/>
								<input type="submit" value="<?php echo $strings['GENERAR ET1']; ?>"/>
							</form>
						</li>
					</ul>
				</aside>
        <?php				
        }
      }
?>