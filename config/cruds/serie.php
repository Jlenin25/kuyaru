<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['serie_id'])){
        $query="SELECT * FROM series WHERE `serie_id`=".$_GET['serie_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM series";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $serie_nombre=$_POST['serie_nombre'];
    $comprobante_venta_id=$_POST['comprobante_venta_id'];
    $query="INSERT INTO series(serie_nombre,comprobante_venta_id) VALUES ('$serie_nombre',$comprobante_venta_id)";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $serie_id=$_GET['serie_id'];
    $serie_nombre=$_POST['serie_nombre'];
    $comprobante_venta_id=$_POST['comprobante_venta_id'];
    $query="UPDATE series SET serie_nombre='$serie_nombre',comprobante_venta_id='$comprobante_venta_id' WHERE serie_id='$serie_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $serie_id=$_GET['serie_id'];
    $query="DELETE FROM series WHERE serie_id='$serie_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");