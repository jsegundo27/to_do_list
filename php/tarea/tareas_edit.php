<?php

require ("../../config/conexion.php");

$cnn=conectarDataBase();

if(  $_SERVER['REQUEST_METHOD'] !== "POST"){
    mostrarJson("error","No es el metodo correcto");
};

if (!empty($_POST["codigo"])) {
  
  $codigo =intval($_POST["codigo"]);

  $sql="SELECT * FROM tarea WHERE id = ? ";

  $smt=$cnn->prepare($sql);

  if (!$smt) {
    mostrarJson("error","No se a preparado la consulta");
  }

  $smt->bind_param("i",$codigo);

  if ( $smt->execute()) {

      $result=$smt->get_result();

      if($smt->affected_rows>0){

        $lista=[];
        while($row=$result->fetch_assoc()){

          $lista[]=$row;

        }
        echo json_encode($lista) ;

      }else{
        mostrarJson("warning","No se a realizado ningun cambio");
      }
   
  }else{
     mostrarJson("error","Error al ejecutar la consulta");
  }

    
}else{
  mostrarJson("error","Faltan completar los campos");
}

function mostrarJson ($status,$message,$extra=[]){
    header('Content-Type: application/json');
    echo  json_encode(array_merge([
         "status" => $status,
         "message" => $message

    ],$extra));
}
