<?php
    include_once '../Models/ENTREGAS_Model.php';
    include_once '../Models/USUARIOS_Model.php';
    include_once '../Models/TRABAJOS_Model.php';
    include_once '../Models/EVALUACIONES_Model.php';
    include_once '../Models/HISTORIA_Model.php';
    include '../Views/Entrega_VIEWS/Entrega_ADD.php';
    include '../Views/Entrega_VIEWS/Entrega_DELETE.php';
    include '../Views/Entrega_VIEWS/Entrega_EDIT.php';
    include '../Views/Entrega_VIEWS/Entrega_SEARCH.php';
    include '../Views/Entrega_VIEWS/Entrega_SHOWALL.php';
    include '../Views/Entrega_VIEWS/Entrega_SHOWCURRENT.php';
    include '../Views/MESSAGE_View.php';
    include '../Functions/upload.php';

function get_data_form(){
    $IdTrabajo = $_REQUEST['IdTrabajo'];
    $login = $_REQUEST['login'];
    $Alias = $_REQUEST['Alias'];
    $Horas = $_REQUEST['Horas'];
    $Ruta = $_REQUEST['Ruta'];
    $action = $_REQUEST['action'];

    $ENTREGAS = new ENTREGAS_Model(
        $IdTrabajo,
        $login,
        $Alias,
        $Horas, 
        $Ruta
    );

    return $ENTREGAS;
}

function alias_gen(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randstring = '';
    for ($i = 0; $i < 6; $i++) {
        $randstring = $randstring . $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

if (!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}

Switch ($_REQUEST['action']){
    case 'ADD':
        if (!$_POST){
            $TRABAJOS = new TRABAJOS_Model('', '', '', '','');    
            $trabajos = $TRABAJOS->SEARCH();
            
            $USUARIOS = new USUARIOS_Model('', '', '', '', '', '', '', '');    
            $usuarios = $USUARIOS->SEARCH();
            
            $lista_trabajos = [];
            $lista_usuarios = [];
            
            while($row = $trabajos->fetch_array()) {
                array_push($lista_trabajos, $row[0]);
            }
            while($row = $usuarios->fetch_array()) {
                array_push($lista_usuarios, $row[0]);
            }
            
            new Entrega_ADD($lista_usuarios, $lista_trabajos, alias_gen());
        }
        else{
            $Ruta = upload_entrega($_REQUEST['Alias']);
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $Ruta);
            $respuesta = $ENTREGAS->ADD();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'DELETE':
        if (!$_POST){
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
            $valores = $ENTREGAS->RellenaDatos();
            new Entrega_DELETE($lista, $valores);
        }
        else{
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $respuesta = $ENTREGAS->DELETE();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }
        break;
    case 'EDIT':
        if (!$_POST){
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
            $valores = $ENTREGAS->RellenaDatos();
            new Entrega_EDIT($valores);
        }
        else{
            $ENTREGAS = get_data_form();
			$Ruta = upload_entrega($_REQUEST['Alias']);
            $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $Ruta);
            $respuesta = $ENTREGAS->EDIT();
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
        }

        break;
    case 'SEARCH':
        if (!$_POST){
            new Entrega_SEARCH();
        }
        else{
            $ENTREGAS = get_data_form();
            $datos = $ENTREGAS->SEARCH();
            $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
            new Entrega_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');
        }
        break;
    case 'QACHECK':
        if (!$_POST){
            $ENTREGAAEVALUAR= new EVALUACIONES_Model($_REQUEST['IdTrabajo'],'',$_REQUEST['AliasEvaluado'],'','','', '','','');
            $datos= $ENTREGAAEVALUAR->SEARCH();
            $HISTORIAS= new HISTORIA_Model($_REQUEST['IdTrabajo'],'','');
            $datosHistorias= $HISTORIAS->SEARCH();
            new Entrega_CHECK_QA($_REQUEST['IdTrabajo'],$_REQUEST['AliasEvaluado'],$datos,$datosHistorias);
        }
        else{

        }
        break;
    case 'SHOWCURRENT':
        $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], '', '', '');
        $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
        $valores = $ENTREGAS->RellenaDatos();
        new Entrega_SHOWCURRENT($lista, $valores);
        break;
    default:
        if (!$_POST){
            $ENTREGAS = new ENTREGAS_Model('','','','','');
        }
        else{
            $ENTREGAS = get_data_form();
        }
        $datos = $ENTREGAS->SEARCH();
        $lista = array('IdTrabajo', 'login', 'Alias', 'Horas', 'Ruta');
        new Entrega_SHOWALL($lista, $datos, '../Controllers/Index_Controller.php');

}
?>
