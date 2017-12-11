<?php
/*
Vista que contiene el Header y el menú lateral de la aplicación, en el se contiene además la funcionalidad del cambio de idioma, y de desconexión de la base de datos
23/11/2017
*/

	class Header{
		function __construct(){	
			$this->render();
		}

		function render(){
			include_once '../Functions/Authentication.php';
			include_once '../Functions/comprobarAdmin.php';
			if (!isset($_SESSION['idioma']) || !$_SESSION['idioma']) {
				$_SESSION['idioma'] = 'SPANISH';
				include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
			}
			else{
				include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
      }
		
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title><?php echo $strings['Portal de Gestión']?></title>
			<link href="../css/index.css" type="text/css" rel="stylesheet">
			<link href="../css/tcal.css" type="text/css" rel="stylesheet">
			<script type="text/javascript" src="../js/validaciones.js"></script>
            <script type="text/javascript" src="../js/tcal.js"></script>
			<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Open+Sans" rel="stylesheet">
		</head>
		<body>
			<header>
				<h1 class="header__h1"><?php echo $strings['Portal de Gestión']?></h1>
				<div class="header__contenedor-usuario">	
					<p class="header__contenedor-usuario__usuario">
						<?php	
							if (IsAuthenticated()){
								echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>'; 
							}
						?>
					</p>
					<a href='../Functions/Desconectar.php'>
						<img class="header__icon" src="../Iconos/logout.png" title="desconectar">
					</a>
				</div>
			</header>
			<div id="cuerpo">
        <?php
        	//Si el usuarios está autenticado y es administrador 
			if (IsAuthenticated() && isAdmin()){
			include '../Views/MenuLateral.php'; 
			$MenuLateral = new MenuLateral();
			
			//Si esta autenticado pero no es administrador
			}else if(IsAuthenticated()){
				
			include '../Views/MenuLateralUsuarios.php'; 
			$MenuLateral = new MenuLateralUsuarios();
			}                 
        ?>
				<div id="root">
<?php
		} //fin metodo render

	} //fin Header

?>

