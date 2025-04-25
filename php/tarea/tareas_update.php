<?php

require ("../../config/conexion.php");

if($_SERVER('REQUEST_METHOD') !=='POST'){
    echo 'Metodo no permitido';
}

if (!empty($_POST["codigo"]) && !empty($_POST['titulo']) && !empty($_POST['descripicion'])) {
   $codigo =$_POST["codigo"];
   $titulo =$_POST["titulo"];
   $descripcion =$_POST["descripcion"];

   $cnn=conectarDataBase();

   $sql="UPDATE tarea set titulo= ? , descripcion = ? WHERE id = ? ";

   $smt=$cnn->prepare($sql);
   if (!$smt) {
      die("error:".$cnn->error);
   }
   $smt->bind_param("ssi",$titulo,$descripcion,$codigo);

   $smt->execute();

   if($smt->affected_rows>0){

      echo json_encode("se registro correctamente");

   }else{
      echo json_encode("Problemas con el registro");
   }

}

