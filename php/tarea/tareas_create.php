<?php 

require "../../config/conexion.php";

$db=conectarDataBase();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    mostrarJson("error", "Método no permitido.");
   exit; 
}

if (!empty($_POST["titulo"]) && !empty($_POST["descripcion"] )) {

    //Convierte caracteres especiales en entidades HTML,
    $titulo=htmlspecialchars(trim($_POST["titulo"]), ENT_QUOTES, 'UTF-8');
    $descripcion=htmlspecialchars(trim($_POST["descripcion"]), ENT_QUOTES, 'UTF-8');
    $estado=intval(0);
    $fecha= date('Y-m-d\TH:i:sP');

    if (strlen($titulo)<3 || strlen($descripcion)<5){
        mostrarJson("error","El título o la descripción son demasiado cortos.");
        exit;
    }

    $sql="INSERT INTO tarea (titulo,descripcion,estado,fecha_inicio) values(?,?,?,?)";

    $smt=$db->prepare($sql);
    if (!$smt) {
        mostrarJson("error","Error al preparar la consulta");
        exit;
    }

    $smt->bind_param("ssss",$titulo,$descripcion,$estado,$fecha);

    if ($smt->execute()) {

        if ($result=$smt->affected_rows>0) {
            mostrarJson("success","registrada correctamente");
         } else {
             mostrarJson("warning","No se registró ningún dato (posible duplicado o sin cambios)");
         }
     
    }else {
        mostrarJson("error", "Error al ejecutar la consulta");
    }

    
    $smt->close();
    $db->close();

} else{

    mostrarJson("error","Falta completar los campos");

}

//el merge para unir dos array
function mostrarJson($status,$message,$extra=[]){
    header('Content-Type: application/json');

    echo json_encode(array_merge([
        "status" => $status,
        "message" => $message
    ],$extra));
    
}