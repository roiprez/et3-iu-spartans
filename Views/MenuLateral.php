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
							<form action="../Controllers/Index_Controller.php" onsubmit="dropdownMenu('submenu_usuarios')">
								<input type="submit" name="Controlador" value="USUARIOS" onclick="mostrarUsuarios()" class="dropbtn"></input>
							</form>
							<ul id="submenu_usuarios" class="dropdown-content">
								<li><a href="#">Mostrar todo</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="GRUPOS" onclick="mostrarGrupos()" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="FUNCIONALIDADES" onclick="mostrarGrupos()" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="ACCIONES" onclick="mostrarGrupos()" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="PERMISOS" onclick="mostrarGrupos()" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="TRABAJOS" onclick="mostrarGrupos()" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="HISTORIAS" onclick="mostrarGrupos()" class="dropbtn"></input>
							</form>
						</li>
					</ul>
				</aside>
        <?php				
        }
      }
?>