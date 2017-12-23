<?php
/*
Vista que contiene el Menú lateral
23/11/2017 por IU SPARTANS
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
					<?php if (isAllow('Usu','Show') || isAllow('Usu','Add') || isAllow('Usu','Search')){?>	
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_usuarios')" type="button" name="Controlador" value="<?php echo $strings['USUARIOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_usuarios" class="dropdown-content">
								<?php if (isAllow('Usu','Show')){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Usu','Add')){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Usu','Search')){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=USUARIOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>	
							</ul>
						</li>
						<?php }?>
						
						
						<?php if (isAllow('Group','Show') || isAllow('Group','Add') || isAllow('Group','Search')){?>	
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_grupos')" type="button" name="Controlador" value="<?php echo $strings['GRUPOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_grupos" class="dropdown-content">
								<?php if (isAllow('Group','Show')){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Group','Add')){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Group','Search')){?>	
								<li><a href="../Controllers/Index_Controller.php?Controlador=GRUPOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>	
							</ul>
						</li>
						<?php }?>
						
						
						<?php if (isAllow('Func','Show') || isAllow('Func','Add') || isAllow('Func','Search')){?>	
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_funcionalidades')" type="button" name="Controlador" value="<?php echo $strings['FUNCIONALIDADES']; ?>" class="dropbtn"></input>
							<ul id="submenu_funcionalidades" class="dropdown-content">
								<?php if (isAllow('Func','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES"><?php echo $strings['Mostrar todo']; ?></a></li>
									<?php }if (isAllow('Func','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
									<?php }if (isAllow('Func','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=FUNCIONALIDADES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
									<?php }?>
							</ul>
						</li>
						<?php }?>
						
						
						<?php if (isAllow('Action','Show') || isAllow('Action','Add') || isAllow('Action','Search')){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_acciones')" type="button" name="Controlador" value="<?php echo $strings['ACCIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_acciones" class="dropdown-content">
								<?php if (isAllow('Action','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Action','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Action','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ACCIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						
						
							<?php if (isAllow('Perm','Show') || isAllow('Perm','Add') || isAllow('Perm','Search')){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_permisos')" type="button" name="Controlador" value="<?php echo $strings['PERMISOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_permisos" class="dropdown-content">
									<?php if (isAllow('Perm','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Perm','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=PERMISOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
									<?php }?>
							</ul>
						</li>
						<?php }?>
						
						
						<?php if (isAllow('Work','Show') || isAllow('Work','Add') || isAllow('Work','Search')){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_trabajos')" type="button" name="Controlador" value="<?php echo $strings['TRABAJOS']; ?>" class="dropbtn"></input>
							<ul id="submenu_trabajos" class="dropdown-content">
									<?php if (isAllow('Work','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS"><?php echo $strings['Mostrar todo']; ?></a></li>
									<?php }if (isAllow('Work','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
									<?php }if (isAllow('Work','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=TRABAJOS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
									<?php }?>
							</ul>
						</li>
						<?php }?>
						
						
						<?php if (isAllow('Hist','Add') || isAllow('Hist','Show') || isAllow('Hist','Search')){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_historias')" type="button" name="Controlador" value="<?php echo $strings['HISTORIAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_historias" class="dropdown-content">
								<?php if (isAllow('Hist','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Hist','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Hist','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=HISTORIAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						
						
						<?php if (isAllow('Entre','Show') || isAllow('Entre','Add') || isAllow('Entre','Search')){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_entregas')" type="button" name="Controlador" value="<?php echo $strings['ENTREGAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_entregas" class="dropdown-content">
								<?php if (isAllow('Entre','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Entre','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Entre','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ENTREGAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						
						<!--Si es administrador o tiene permisos-->
						<?php if ((isAllow('Nota','Show') || isAllow('Nota','Add') || isAllow('Nota','Search'))){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_notas')" type="button" name="Controlador" value="<?php echo $strings['NOTAS']; ?>" class="dropbtn"></input>
							<ul id="submenu_notas" class="dropdown-content">
								<?php if (isAllow('Nota','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Nota','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Nota','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=NOTAS&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>

						
						
						<?php if (isAllow('Eval','Show') || isAllow('Eval','Add') || isAllow('Eval','Search')){?>
						<li class="dropdown">
							<input onclick="dropdownMenu('submenu_evaluaciones')" type="button" name="Controlador" value="<?php echo $strings['EVALUACIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_evaluaciones" class="dropdown-content">
								<?php if (isAllow('Eval','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Eval','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Evall','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=EVALUACIONES&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						
						
						<li class="dropdown">
							<?php if (isAllow('Asig_Qua','Show') || isAllow('Asig_Qua','Add') || isAllow('Asig_Qua','Search')){?>
							<input onclick="dropdownMenu('submenu_asignaciones')" type="button" name="Controlador" value="<?php echo $strings['ASIGNACIONES']; ?>" class="dropbtn"></input>
							<ul id="submenu_asignaciones" class="dropdown-content">
								<?php if (isAllow('Asig_Qua','Show')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNAC_QA"><?php echo $strings['Mostrar todo']; ?></a></li>
								<?php }if (isAllow('Asig_Qua','Add')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNAC_QA&action=ADD"><?php echo $strings['Añadir']; ?></a></li>
								<?php }if (isAllow('Asig_Qua','Search')){?>
								<li><a href="../Controllers/Index_Controller.php?Controlador=ASIGNAC_QA&action=SEARCH"><?php echo $strings['Buscar']; ?></a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						
						<li class="dropdown">
							<?php if (!isAdmin() && (isAllow('ResEt','Show') && isAllow('ResQa','Show'))){?>
							<input onclick="dropdownMenu('submenu_resultados')" type="button" name="Controlador" value="<?php echo $strings['RESULTADOS'];?>" class="dropbtn"></input>
							<ul id="submenu_resultados" class="dropdown-content">
							<?php $trabajos = getTrabajos();
								for($i=0;$i<count($trabajos);$i++){ ?>
									<li><a href="../Controllers/Index_Controller.php?Controlador=Resultados&IdTrabajo=<?php echo $trabajos[$i]?>&Generar=<?php echo $trabajos[$i]?>"><?php echo $trabajos[$i];?></a></li>
									<li><a href="../Controllers/Index_Controller.php?Controlador=Resultados&IdTrabajo=<?php echo $trabajos[$i]?>&Generar=<?php echo 'QA' . $trabajos[$i][2]?>"><?php echo 'QA' . $trabajos[$i][2];?></a></li>
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