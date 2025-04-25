<?php

require ("../../config/conexion.php");

$db=conectarDataBase();

if($_SERVER['REQUEST_METHOD'] !=='POST'){
   mostrarJson("error", "Método no permitido.");
    exit; 
}

if (!empty($_POST["codigo"]) && !empty($_POST['titulo']) && !empty($_POST['descripcion'])) {
   
   $codigo = intval($_POST["codigo"]);
   $titulo =htmlspecialchars(trim($_POST["titulo"]),ENT_QUOTES,'UTF-8');
   $descripcion =htmlspecialchars(trim($_POST["descripcion"]),ENT_QUOTES,'UTF-8');

   if (strlen($titulo)<8 || strlen($descripcion)<6) {
      mostrarJson("error","El título o la descripción son demasiado cortos.");
      exit;
   }
  
   $sql="UPDATE tarea set titulo= ? , descripcion = ? WHERE id = ? ";

   $smt=$db->prepare($sql);

   if (!$smt) {
      mostrarJson("error","Error al preparar la consulta");
      exit;
   }
   $smt->bind_param("ssi",$titulo,$descripcion,$codigo);

   $smt->execute();

   if($smt->affected_rows>0){
      mostrarJson("success","registrada correctamente");

   }else{
     mostrarJson("warning","No se registró ningún dato (posible duplicado o sin cambios)");
   }

   $smt->close();
   $db->close();

}else{
   mostrarJson("error","Faltan completar los campos");
}


function mostrarJson($status,$message,$extra=[]){

   $resultado=[
      "status" => $status,
      "message" => $message
   ];
   echo json_encode(array_merge($resultado,$extra));

}
