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
					<?php if isAllow('Usu','All'){?>	
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_usuarios')" type="button" name="Controlador" value="<?php echo $strings['USUARIOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_usuarios" class="dropdown-content">
								<?php if isAllow('Usu','ShowAll'){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Usu','Add'){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Usu','Search'){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>	
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Group','All'){?>	
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_grupos')" type="button" name="Controlador" value="<?php echo $strings['GRUPOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_grupos" class="dropdown-content">
								<?php if isAllow('Group','ShowAll'){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Group','Add'){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Group','Search'){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>	
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Func','All'){?>	
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_funcionalidades')" type="button" name="Controlador" value="<?php echo $strings['FUNCIONALIDADES']; ?>" class="dropbtn"></input>
							<ul id="submenu_funcionalidades" class="dropdown-content">
								<?php if isAllow('Func','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES"><?php echo $strings['Mostrar todo']; ?></a></li>
									<?php }if isAllow('Func','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
									<?php }if isAllow('Func','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
									<?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Action','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_acciones')" type="button" name="Controlador" value="<?php echo $strings['ACCIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_acciones" class="dropdown-content">
								<?php if isAllow('Action','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Action','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Action','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
							<?php if isAllow('Perm','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_permisos')" type="button" name="Controlador" value="<?php echo $strings['PERMISOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_permisos" class="dropdown-content">
									<?php if isAllow('Perm','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS"><?php echo $strings['Mostrar todo']; ?></a></li>
									<?php }if isAllow('Perm','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
									<?php }if isAllow('Perm','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
									<?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Work','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_trabajos')" type="button" name="Controlador" value="<?php echo $strings['TRABAJOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_trabajos" class="dropdown-content">
									<?php if isAllow('Work','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS"><?php echo $strings['Mostrar todo']; ?></a></li>
									<?php }if isAllow('Work','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
									<?php }if isAllow('Work','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
									<?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Hist','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_historias')" type="button" name="Controlador" value="<?php echo $strings['HISTORIAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_historias" class="dropdown-content">
								<?php if isAllow('Hist','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Hist','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Hist','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Entre','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_entregas')" type="button" name="Controlador" value="<?php echo $strings['ENTREGAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_entregas" class="dropdown-content">
								<?php if isAllow('Entre','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Entre','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Entre','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Nota','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_notas')" type="button" name="Controlador" value="<?php echo $strings['NOTAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_notas" class="dropdown-content">
								<?php if isAllow('Nota','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Nota','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Nota','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if isAllow('Eval','All'){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_evaluaciones')" type="button" name="Controlador" value="<?php echo $strings['EVALUACIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_evaluaciones" class="dropdown-content">
								<?php if isAllow('Eval','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Eval','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Evall','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						<li class="dropdown">
							<?php if isAllow('Asig','All'){?>
							<input onclick="dropdownMenu('submenu_asignaciones')" type="button" name="Controlador" value="<?php echo $strings['ASIGNACIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_asignaciones" class="dropdown-content">
								<?php if isAllow('Asig','ShowAll'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNAC_QA"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if isAllow('Asig','Add'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNAC_QA&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if isAllow('Asig','Search'){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNAC_QA&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
					</ul>
				</aside>
        <?php				
        }
      }
?>