<?php 

require "../../config/conexion.php";

$db=conectarDataBase();

if (!empty($_POST["titulo"]) && !empty($_POST["descripcion"] )) {
    $titulo=$_POST["titulo"];
    $descripcion=$_POST["descripcion"];
    $estado=0;
    $fecha= date('Y-m-d\TH:i:sP');
    $sql="INSERT INTO tarea (titulo,descripcion,estado,fecha_inicio) values(?,?,?,?)";

    $smt=$db->prepare($sql);
    if (!$smt) {
        die("Algo salio mal ");
    }
    $smt->bind_param("ssss",$titulo,$descripcion,$estado,$fecha);

    if ($smt->execute()) {
        echo json_encode("se registro correctamente");
    }else{
        echo json_encode("Algo salio mal");
    }
}else{
        echo  json("Falta completar los campos");
}
