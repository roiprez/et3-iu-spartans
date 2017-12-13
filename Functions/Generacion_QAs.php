<?php

include_once '../Models/ENTREGAS_Model.php';
include_once '../Models/ASIGNAC_QA_Model.php';
//Genera las qa que debe corregir cada login
function qa_gen($IdTrabajo){
    $ENTREGAS =  new ENTREGAS_Model($IdTrabajo,'','','','');
    $entregas = $ENTREGAS->SEARCH();

    $lista_login = [];
    $lista_alias = [];

    //Rellena las listas de login y alias
    while($row = $entregas->fetch_array()) {
      array_push($lista_login, $row[1]);
      array_push($lista_alias, $row[2]);
    }
    
    //Recorre en bucle todos los login
    for($i = 0;$i<$lista_login.length();$i++){
      //Asigna como primer alias el quinto que sigue al login
      $j = $i+5;
      $contador = 0;
      //Mientras no haya cinco asignaciones sigue asignando
      while($contador < 5){
        //Comprueba que no haya sobrepasado la variable de control de acceso al tamaño del array
        if($j >= $lista_alias.length()){
          $j = $j - $lista_alias.length();
        }
        //Comprueba que el login y el alias no correspondan a la misma persona.
        if($i == $j){
          $j++;
        }
        $ASIGNAC_QA = new ASIGNAC_QA_Model($IdTrabajo, $lista_login[$i], $lista_alias[$j]);
        $asignacion = $ASIGNAC_QA->ADD();
        $contador++;
        $j+=5; 
      }    
    }
}
?>
