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
							<button onclick="dropdownMenu('submenu_usuarios')" class="dropbtn"><?php echo $strings['Usuarios']; ?></button>
							<ul id="submenu_usuarios" class="dropdown-content">
								<li><a href="#"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="#"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="#"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<button onclick="location.href='../Controllers/GRUPOS_Controller.php'" class="dropbtn"><?php echo $strings['Grupos']; ?></button>
							<ul id="submenu_grupos" class="dropdown-content">
								<li><a href="#"><?php echo $strings['Mostrar todo']; ?></a></li>
								<li><a href="#"><?php echo $strings['Añadir']; ?></a></li>
								<li><a href="#"><?php echo $strings['Buscar']; ?></a></li>
							</ul>
						</li>
					</ul>
				</aside>
        <?php
        }
      }
?>