<?php
/*
Vista que contiene el footer de la aplicación junto con los scripts de javascript necesarios para su funcionamiento
23/11/2017 por IU SPARTANS
*/

	class Footer{
		function __construct(){	
			$this->render();
			
		}

		function render(){
			if (IsAuthenticated()){
				include '../Controllers/' . $_SESSION['controlador'] . '.php';	
			}
		?>
		</div>
		</div>
		<footer><?php echo date("d-M-Y", mktime()); ?> - IU SPARTANS</footer>
		<script type="text/javascript" src="../js/tcal.js"></script> 
			<script type="text/javascript" src="../js/md5.js"></script> 
			<script src="../js/menu.js" type="text/javascript"></script>
			<script src="../js/validaciones.js" type="text/javascript"></script>
		</body>
  </html>
<?php
		} //fin metodo render

	} //fin Footer

?>