<?php

require ("../../config/conexion.php");
$codigo=$_POST["codigo"];

$cnn=conectarDataBase();

$sql="DELETE FROM tarea where id = ?";

$smt = $cnn->prepare($sql);

$smt->bind_param("i",$codigo);

$smt->execute();

if($smt->affected_rows>0){

echo "se elimino correctamente";

}else{
echo "Problemas con el registro";
}
