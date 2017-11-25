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
      // include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
      include '../Locales/Strings_SPANISH.php'; //quitar cuando se implemente correctamente los idiomas
      ?>
        <aside>
					<ul class="menu">
						<li class="dropdown">
							<button onclick="dropdownMenu('submenu1')" class="dropbtn"><?php echo $strings['Primero']; ?></button>
							<ul id="submenu1" class="dropdown-content">
								<li><a href="#"><?php echo $strings['Primero']; ?>_1</a></li>
								<li><a href="#"><?php echo $strings['Primero']; ?>_2</a></li>
								<li><a href="#"><?php echo $strings['Primero']; ?>_3</a></li>
								<li><a href="#"><?php echo $strings['Primero']; ?>_4</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<button onclick="dropdownMenu('submenu2')" class="dropbtn"><?php echo $strings['Segundo']; ?></button>
							<ul id="submenu2" class="dropdown-content">
								<li><a href="#"><?php echo $strings['Segundo']; ?>_1</a></li>
								<li><a href="#"><?php echo $strings['Segundo']; ?>_2</a></li>
								<li><a href="#"><?php echo $strings['Segundo']; ?>_3</a></li>
								<li><a href="#"><?php echo $strings['Segundo']; ?>_4</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<button onclick="dropdownMenu('submenu3')" class="dropbtn"><?php echo $strings['Tercero']; ?></button>
							<ul id="submenu3" class="dropdown-content">
							<li><a href="#"><?php echo $strings['Tercero']; ?>_1</a></li>
							<li><a href="#"><?php echo $strings['Tercero']; ?>_2</a></li>
							<li><a href="#"><?php echo $strings['Tercero']; ?>_3</a></li>
							<li><a href="#"><?php echo $strings['Tercero']; ?>_4</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<button onclick="dropdownMenu('submenu4')" class="dropbtn"><?php echo $strings['Cuarto']; ?></button>
						<ul id="submenu4" class="dropdown-content">
								<li><a href="#"><?php echo $strings['Cuarto']; ?>_1</a></li>
								<li><a href="#"><?php echo $strings['Cuarto']; ?>_2</a></li>
								<li><a href="#"><?php echo $strings['Cuarto']; ?>_3</a></li>
								<li><a href="#"><?php echo $strings['Cuarto']; ?>_4</a></li>
							</ul>
						</li>
					</ul>
				</aside>

        <?php
        }
      }
        ?>