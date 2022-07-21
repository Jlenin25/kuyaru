<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['empresa_id'])){
        $query="SELECT * FROM empresa WHERE `empresa_id`=".$_GET['empresa_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM empresa";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $empresa_id=$_GET['empresa_id'];
    $empresa_ruc=$_POST['empresa_ruc'];
    $empresa_razon_social=$_POST['empresa_razon_social'];
    $empresa_nombre=$_POST['empresa_nombre'];
    $empresa_direccion=$_POST['empresa_direccion'];
    $empresa_imagen=$_POST['empresa_imagen'];
    $query="UPDATE empresa SET empresa_ruc='$empresa_ruc',empresa_razon_social='$empresa_razon_social',empresa_nombre='$empresa_nombre',empresa_direccion='$empresa_direccion',empresa_imagen='$empresa_imagen' WHERE empresa_id='$empresa_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");