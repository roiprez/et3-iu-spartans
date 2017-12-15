<?php
/*
Vista que contiene el Menú lateral
23/11/2017
*/

  class MenuLateralUsuarios{
		function __construct(){	
			$this->render();
		}

		function render(){
      include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
      ?>
        <aside>
					<ul class="menu">
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="ENTREGAS" onclick="" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="EVALUACIONES" onclick="" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_resultados')" type="button" name="Controlador" value="Resultados" class="dropbtn"></input>
							<ul id="submenu_resultados" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=Resultados&IdTrabajo=ET1">ET1</a></li>
							</ul>
						</li>
					</ul>
				</aside>
        <?php				
        }
      }
?>