<?php 
require "../../config/conexion.php";

 $db = conectarDataBase();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

   $sql="Select * from tarea order by id desc";
   $smt=$db->prepare($sql);
  
   if (!$smt) {
     mostrarJson("error","error al prepara la consulta");
   }
  
   if($smt->execute()){

      $result=$smt->get_result();
      $list_tareas=[];
     
      if ($result->num_rows >0) {

         while($row = $result->fetch_assoc()){

             $list_tareas[]=$row;

         }
        echo json_encode($list_tareas);
     
      }else{
         mostrarJson("warning","No se registró ningún dato (posible duplicado o sin cambios)");
      }
   }else{
      mostrarJson("error", "Error al ejecutar la consulta");
   }

 $smt->close();
 $db->close();
 
}else{
   mostrarJson("error","Método no permitido");
}

//el merge para unir dos array
function mostrarJson($status,$message,$extra=[]){
   header('Content-Type: application/json');

   echo json_encode(array_merge([
       "status" => $status,
       "message" => $message
   ],$extra));
   
}

