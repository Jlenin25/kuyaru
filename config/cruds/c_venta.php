<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['comprobante_venta_id'])){
        $query="SELECT * FROM comprobante_venta WHERE `comprobante_venta_id`=".$_GET['comprobante_venta_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM comprobante_venta";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $comprobante_venta_nombre=$_POST['comprobante_venta_nombre'];
    $query="INSERT INTO comprobante_venta(comprobante_venta_nombre) VALUES ('$comprobante_venta_nombre')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $comprobante_venta_id=$_GET['comprobante_venta_id'];
    $comprobante_venta_nombre=$_POST['comprobante_venta_nombre'];
    $query="UPDATE comprobante_venta SET comprobante_venta_nombre='$comprobante_venta_nombre' WHERE comprobante_venta_id='$comprobante_venta_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $comprobante_venta_id=$_GET['comprobante_venta_id'];
    $query="DELETE FROM comprobante_venta WHERE comprobante_venta_id='$comprobante_venta_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");