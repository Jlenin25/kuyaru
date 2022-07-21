<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['comprobante_compra_id'])){
        $query="SELECT * FROM comprobante_compra WHERE `comprobante_compra_id`=".$_GET['comprobante_compra_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM comprobante_compra";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $comprobante_compra_nombre=$_POST['comprobante_compra_nombre'];
    $query="INSERT INTO comprobante_compra(comprobante_compra_nombre) VALUES ('$comprobante_compra_nombre')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $comprobante_compra_id=$_GET['comprobante_compra_id'];
    $comprobante_compra_nombre=$_POST['comprobante_compra_nombre'];
    $query="UPDATE comprobante_compra SET comprobante_compra_nombre='$comprobante_compra_nombre' WHERE comprobante_compra_id='$comprobante_compra_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $comprobante_compra_id=$_GET['comprobante_compra_id'];
    $query="DELETE FROM comprobante_compra WHERE comprobante_compra_id='$comprobante_compra_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");