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
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="Resultados " onclick="" class="dropbtn"></input>
							</form>
						</li>
					</ul>
				</aside>
        <?php				
        }
      }
?>