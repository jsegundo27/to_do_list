<?php

require ("../../config/conexion.php");

$codigo =$_POST["codigo"];


$cnn=conectarDataBase();


$resultado = $cnn->query("SELECT a.estado FROM tarea as a WHERE id = " . intval($codigo));

if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc(); // Obtener la fila como array asociativo
    $estado = $fila['estado']; // Extraer el valor del campo estado
} 

if ($estado==1) {
    $sql="UPDATE tarea set estado = 0 WHERE id = ? && estado = 1 ";
}else{
    $sql="UPDATE tarea set estado = 1 WHERE id = ? && estado = 0 ";
}



$smt=$cnn->prepare($sql);
if (!$smt) {
    die("error:".$cnn->error);
}
$smt->bind_param("i",$codigo);

$smt->execute();

if($smt->affected_rows>0){

   echo json_encode("se cambio correctamente");

}else{
   echo json_encode("Problemas con el cambio de estado");
}
