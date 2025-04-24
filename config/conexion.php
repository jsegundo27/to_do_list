<?php
 function conectarDataBase(){
    $host_name="localhost";
    $user_name="root";
    $password_name="";
    $db_name="db_to_do_list";
    $cnn= new mysqli($host_name,$user_name,$password_name,$db_name);

    if ($cnn->connect_error) {
        die("Conexion fallida ".$cnn->connect_error );
    }
    
    return $cnn;
 }