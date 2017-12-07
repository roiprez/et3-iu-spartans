<?php

/*
Función que se encarga de subir al directorio files la entrega.
11/11/2017 
*/

function upload_entrega($alias){
	$target_dir = "../Files/";
    $_FILES["Ruta"]["name"] = $alias . '-' . $_FILES["Ruta"]["name"];
    $target_file = $target_dir . basename($_FILES["Ruta"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["Ruta"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            return '';
            $uploadOk = 0;
        }
    }
    
    // Check file size
    if ($_FILES["Ruta"]["size"] > 2000000) {
      echo "Sorry, your file is too large.";
      return '';
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      return '';
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["Ruta"]["tmp_name"], $target_file)) {
          return $_FILES["Ruta"]["name"];
      } else {
          return '';
          echo "Sorry, there was an error uploading your file.";
      }
    }
}

?>