<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['sucursal_id '])){
        $query="SELECT * FROM sucursales WHERE `sucursal_id `=".$_GET['sucursal_id '];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM sucursales";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $sucursal_nombre=$_POST['sucursal_nombre'];
    $sucursal_direccion=$_POST['sucursal_direccion'];
    $query="INSERT INTO sucursales(sucursal_nombre,sucursal_direccion) VALUES ('$sucursal_nombre','$sucursal_direccion')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $sucursal_id =$_GET['sucursal_id '];
    $sucursal_nombre=$_POST['sucursal_nombre'];
    $sucursal_direccion=$_POST['sucursal_direccion'];
    $query="UPDATE sucursales SET sucursal_nombre='$sucursal_nombre',sucursal_direccion='$sucursal_direccion' WHERE sucursal_id ='$sucursal_id '";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $sucursal_id =$_GET['sucursal_id '];
    $query="DELETE FROM sucursales WHERE sucursal_id ='$sucursal_id '";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");