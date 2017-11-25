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
			// include_once '../Functions/Authentication.php';
			// if (!isset($_SESSION['idioma']) || !$_SESSION['idioma']) {
			// 	$_SESSION['idioma'] = 'SPANISH';
			// 	include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
			// }
			// else{
			// 	include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
      // }
      include '../Locales/Strings_SPANISH.php'; //quitar cuando se implementen correctamente los idiomas
		
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title><?php echo $strings['Portal de Gestión']?></title>
			<link href="../css/index.css" type="text/css" rel="stylesheet">
			<!-- <link href="../css/formularios.css" type="text/css" rel="stylesheet">
			<link href="../css/tablas.css" type="text/css" rel="stylesheet"> -->
			<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Open+Sans" rel="stylesheet">
		</head>
		<body>
			<header>
				<h1><?php echo $strings['Portal de Gestión']?></h1>
				<div id="contenedor-usuario">	
					<p id="usuario">
						<?php	
							// if (IsAuthenticated()){
							// 	echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>'; 
							// }
						?>
					</p>
					<a href='../Functions/Desconectar.php'>
						<img id="icono-logout" src="../iconos/logout.png" title="desconectar">
					</a>
				</div>
			</header>
			<div id="cuerpo">
        <?php 
          include '../Views/MenuLateral.php'; 
          $MenuLateral = new MenuLateral();        
        ?>
				<div id="root">
<?php
		} //fin metodo render

	} //fin Header

?>

