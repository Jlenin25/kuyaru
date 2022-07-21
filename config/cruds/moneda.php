<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['moneda_id'])){
        $query="SELECT * FROM monedas WHERE `moneda_id`=".$_GET['moneda_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM monedas";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $moneda_nombre=$_POST['moneda_nombre'];
    $query="INSERT INTO monedas(moneda_nombre) VALUES ('$moneda_nombre')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $moneda_id=$_GET['moneda_id'];
    $moneda_nombre=$_POST['moneda_nombre'];
    $query="UPDATE monedas SET moneda_nombre='$moneda_nombre' WHERE moneda_id='$moneda_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $moneda_id=$_GET['moneda_id'];
    $query="DELETE FROM monedas WHERE moneda_id='$moneda_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");