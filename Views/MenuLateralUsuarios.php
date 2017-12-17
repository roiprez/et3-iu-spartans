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
								<input type="submit" name="Controlador" value="<?php echo $strings['ENTREGAS']; ?>" onclick="" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="<?php echo $strings['EVALUACIONES'];?> " onclick="" class="dropbtn"></input>
							</form>
						</li>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_resultados')" type="button" name="Controlador" value="<?php echo $strings['RESULTADOS'];?>" class="dropbtn"></input>
							<ul id="submenu_resultados" class="dropdown-content">
								<li><a href="../Controllers/Index_Controller.php?Controlador=Resultados&IdTrabajo=ET1"><?php echo $strings['ET1'];?></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<form action="../Controllers/Index_Controller.php">
								<input type="submit" name="Controlador" value="NOTAS" onclick="" class="dropbtn"></input>
							</form>
						</li>
					</ul>
				</aside>
        <?php				
        }
      }
?>