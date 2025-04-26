<?php

require ("../../config/conexion.php");

$db=conectarDataBase();

if ($_SERVER["REQUEST_METHOD"]!=="POST") {
    mostrarJson("error", "Metodo no encontrado.");
    exit; 
}

if (!empty($_POST["codigo"])) {

    $codigo =intval($_POST["codigo"]);

    $sql= "UPDATE tarea SET estado = CASE WHEN estado = 1 THEN 0 ELSE 1 END WHERE id = ?";

    $smt=$db->prepare($sql);
    if (!$smt) {
        mostrarJson("error","Error al preparar la consulta");
        exit;
    }
    $smt->bind_param("i",$codigo);

    
    if ($smt->execute()) {
        if($smt->affected_rows>0){

            mostrarJson("status", "Se realizo correctamente el cambio de estado");
    
        }else{
            mostrarJson("warning","No se registró ningún dato (posible duplicado o sin cambios)");
        }    
    }else{
            mostrarJson("error", "Error al ejecutar la consulta");
    }

    $smt->close();
    $db->close();  

}else{
    mostrarJson("error","Falta completar los campos");
}

function mostrarJson($status,$message,$extra=[]){
    header('Content-Type: application/json');
    echo json_encode(array_merge([
        "status" => $status,
        "message" => $message
    ],$extra));
}