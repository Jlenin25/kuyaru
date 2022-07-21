<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['impresion_id'])){
        $query="SELECT * FROM impresiones WHERE `impresion_id`=".$_GET['impresion_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM impresiones";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $impresion_id=$_GET['impresion_id'];
    $impresion_formato=$_POST['impresion_formato'];
    $impresion_decimal=$_POST['impresion_decimal'];
    $impresion_cabecera=$_POST['impresion_cabecera'];
    $impresion_cuentbancarias=$_POST['impresion_cuentbancarias'];
    $impresion_piepagina=$_POST['impresion_piepagina'];
    $query="UPDATE impresiones SET impresion_formato='$impresion_formato',impresion_decimal='$impresion_decimal',impresion_cabecera='$impresion_cabecera',impresion_cuentbancarias='$impresion_cuentbancarias',impresion_piepagina='$impresion_piepagina' WHERE impresion_id='$impresion_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");