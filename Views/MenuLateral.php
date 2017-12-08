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
							<input onclick="dropdownMenu('submenu_usuarios')" type="button" name="Controlador" value="USUARIOS" class="dropbtn"></input>
							<ul id="submenu_usuarios" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_grupos')" type="button" name="Controlador" value="GRUPOS" class="dropbtn"></input>
							<ul id="submenu_grupos" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_funcionalidades')" type="button" name="Controlador" value="FUNCIONALIDADES" class="dropbtn"></input>
							<ul id="submenu_funcionalidades" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_acciones')" type="button" name="Controlador" value="ACCIONES" class="dropbtn"></input>
							<ul id="submenu_acciones" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_permisos')" type="button" name="Controlador" value="PERMISOS" class="dropbtn"></input>
							<ul id="submenu_permisos" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_trabajos')" type="button" name="Controlador" value="TRABAJOS" class="dropbtn"></input>
							<ul id="submenu_trabajos" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_historias')" type="button" name="Controlador" value="HISTORIAS" class="dropbtn"></input>
							<ul id="submenu_historias" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_entregas')" type="button" name="Controlador" value="ENTREGAS" class="dropbtn"></input>
							<ul id="submenu_entregas" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_notas')" type="button" name="Controlador" value="NOTAS" class="dropbtn"></input>
							<ul id="submenu_notas" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_evaluaciones')" type="button" name="Controlador" value="EVALUACIONES" class="dropbtn"></input>
							<ul id="submenu_evaluaciones" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES">Mostrar todo</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=ADD">Añadir</a></li>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=SEARCH">Buscar</a></li>
							</ul>
						</li>
					</ul>
				</aside>
        <?php				
        }
      }
?>