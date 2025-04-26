<?php

require ("../../config/conexion.php");

$cnn=conectarDataBase();

if ($_SERVER["REQUEST_METHOD"]!=="POST") {
  mostrarJson("error","Metodo no encontrado");
}

if (!empty($_POST["codigo"])) {

    $codigo=intval($_POST["codigo"]);

    $sql="DELETE FROM tarea where id = ?";

    $smt = $cnn->prepare($sql);

    if (!$smt) {
        mostrarJson("error","No se a preparado la consulta");
    }

    $smt->bind_param("i",$codigo);

    if ($smt->execute()) {
        if($smt->affected_rows>0){

        mostrarJson("success","Se a eliminado correctamente");
    
        }else{
            mostrarJson("warning","No se a realizado ningun cambios");
        }
    }else{
        mostrarJson("error","No se a Ejecutado la consulta");
    }

}else{
    mostrarJson("error","Faltan completar Campos");
}

function mostrarJson ($status,$message,$extra=[]){
    header('Content-Type: application/json');
    echo  json_encode(array_merge([
         "status" => $status,
         "message" => $message

    ],$extra));
}