<?php

require ("../../config/conexion.php");

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

   echo "se registro correctamente";

}else{
   echo "Problemas con el registro";
}

