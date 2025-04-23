<?php

require ("../../config/conexion.php");

$codigo =$_POST["codigo"];


$cnn=conectarDataBase();

$sql="SELECT * FROM tarea WHERE id = ? ";

$smt=$cnn->prepare($sql);
if (!$smt) {
    die("error:".$cnn->error);
}
$smt->bind_param("i",$codigo);

$smt->execute();

$result=$smt->get_result();

if($smt->affected_rows>0){
  $lista=[];
   while($row=$result->fetch_assoc()){

     $lista[]=$row;

   }
 echo json_encode($lista) ;

}else{
   echo "Problemas con el registro";
}

