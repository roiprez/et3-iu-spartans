<?php
/*
	Vista que muestra el contenido de un mensaje enviado al usuario y un botón de retorno al controlador indicado por $volver 

	*/
class Vista_MESSAGE{
	
    private $string;
    private $volver;

    function __construct($string, $volver){
        $this->string = $string;
        $this->volver = $volver;
        $this->render();
    }

    function render(){
        include_once '../Functions/Authentication.php';
		
        if (!IsAuthenticated()){
            include '../Views/Header.php';
            $Header = new Header();
        }

        include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
        ?>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>
        <H3>
            <?php
            echo $strings[$this->string];
            ?>
        </H3>
        </p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

		<form id="Formulario-mensaje" action="<?php echo $this->volver ?>" method="get">
		<button id="boton-mensaje" type='submit' name='action'><img class="button-td" src="../Iconos/back.png" title="Registrarse"></img></button> <!--Imagen para la accion back,que permite volver al menu principal-->
		</center></form>

        
        
		
		
		
        <?php
        if (!IsAuthenticated()){
            include '../Views/Footer.php';
            $Footer = new Footer();
        }//fin de if
    } //fin metodo render
}//fin de la clase

?>
