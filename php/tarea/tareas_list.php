<?php 
require "../../config/conexion.php";

 $db = conectarDataBase();

 $sql="Select * from tarea";
 $smt=$db->prepare($sql);

 if (!$smt) {
    die("Algo salio mal ".$db->connect_error);
 }

 $smt->execute();
 $result=$smt->get_result();
 $list_tareas=[];

 if ($result->num_rows >0) {
    while($row = $result->fetch_assoc()){
        $list_tareas[]=$row;
    }
   echo json_encode($list_tareas);

 }else{
    echo "error de consulta";
 }

