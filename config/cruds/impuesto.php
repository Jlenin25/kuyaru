<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['impuesto_id'])){
        $query="SELECT * FROM impuesto WHERE `impuesto_id`=".$_GET['impuesto_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM impuesto";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $impuesto_nombre=$_POST['impuesto_nombre'];
    $impuesto_cantidad=$_POST['impuesto_cantidad'];
    $query="INSERT INTO impuesto(impuesto_nombre,impuesto_cantidad) VALUES ('$impuesto_nombre','$impuesto_cantidad')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $impuesto_id=$_GET['impuesto_id'];
    $impuesto_nombre=$_POST['impuesto_nombre'];
    $impuesto_cantidad=$_POST['impuesto_cantidad'];
    $query="UPDATE impuesto SET impuesto_nombre='$impuesto_nombre',impuesto_cantidad='$impuesto_cantidad' WHERE impuesto_id='$impuesto_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $impuesto_id=$_GET['impuesto_id'];
    $query="DELETE FROM impuesto WHERE impuesto_id='$impuesto_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");