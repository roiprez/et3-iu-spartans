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
    include '../Views/Entrega_VIEWS/Entrega_CHECK_QA.php';
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
            if($_REQUEST['Ruta'] == ''){    
                $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $_REQUEST['RutaOriginal']);    
            } else {
                $ENTREGAS = new ENTREGAS_Model($_REQUEST['IdTrabajo'], $_REQUEST['login'], $_REQUEST['Alias'], $_REQUEST['Horas'], $_REQUEST['Ruta']);                
            }
            
			
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
<<<<<<< HEAD
        if (!$_POST){
            $ENTREGAAEVALUAR= new EVALUACIONES_Model($_REQUEST['IdTrabajo'],'',$_REQUEST['AliasEvaluado'],'','','', '','','');
=======
         //Si no hay post
         if (!$_POST){
            $ENTREGAAEVALUAR= new EVALUACIONES_Model($_REQUEST['IdTrabajo'],'',$_REQUEST['Alias'],'','','', '','','');
>>>>>>> 9560e2778b3c678a88d6c7b07198d244938417b5
            $datos= $ENTREGAAEVALUAR->SEARCH();
            $HISTORIAS= new HISTORIA_Model($_REQUEST['IdTrabajo'],'','');
            $datosHistorias= $HISTORIAS->SEARCH();
            $arrayDescripciones= array();
             while($rowHistoria = $datosHistorias->fetch_array()){
                 $arrayDescripciones[]=$rowHistoria[2];
             }
            new Correccion_Conjunta_QAS($_REQUEST['IdTrabajo'],$_REQUEST['Alias'],$datos,$arrayDescripciones,'../Controllers/Index_Controller.php');
        }
        else{
<<<<<<< HEAD

=======
            $ENTREGAAEVALUAR= new EVALUACIONES_Model($_REQUEST['IdTrabajo'],'',$_REQUEST['Alias'],'','','', '','','');
            $ENTREGAAEVALUAR= $ENTREGAAEVALUAR->SEARCH();
            foreach($ENTREGAAEVALUAR->fetch_array() as $rowEvaluacion){
                $ok= $_REQUEST($rowEvaluacion[3]."_".$rowEvaluacion[1]);
                $EVALUACION= new EVALUACIONES_Model($rowEvaluacion[0],$rowEvaluacion[1],$rowEvaluacion[2],$rowEvaluacion[3],$rowEvaluacion[4],$rowEvaluacion[5],$rowEvaluacion[6],$rowEvaluacion[7],$ok);
                $respuesta= $EVALUACION->EDIT();
            }
            new Vista_MESSAGE($respuesta, '../Controllers/Index_Controller.php');
>>>>>>> 9560e2778b3c678a88d6c7b07198d244938417b5
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
