<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET') {
    if(isset($_GET['gr_id'])) {
        $query="SELECT * FROM guia_remision WHERE `gr_id`=".$_GET['gr_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM guia_remision";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST') {
    unset($_POST['METHOD']);
    $gr_codigo=$_POST['gr_codigo'];
    $gr_f_emision=$_POST['gr_f_emision'];
    $gr_observacion=$_POST['gr_observacion'];
    $empresa_id=$_POST['empresa_id'];
    $gr_origen=$_POST['gr_origen'];
    $gr_destino=$_POST['gr_destino'];
    $gr_dir_origen=$_POST['gr_dir_origen'];
    $gr_dir_destino=$_POST['gr_dir_destino'];
    $tipo_envio_id=$_POST['tipo_envio_id'];
    $gr_f_envio=$_POST['gr_f_envio'];
    $gr_cant_bultos=$_POST['gr_cant_bultos'];
    $gr_peso_kilo=$_POST['gr_peso_kilo'];
    $transporte_id=$_POST['transporte_id'];
    $query="INSERT INTO guia_remision(gr_codigo,gr_f_emision,gr_observacion,empresa_id,gr_origen,password,gr_dir_origen,gr_dir_destino,tipo_envio_id,gr_f_envio,gr_cant_bultos,gr_peso_kilo,transporte_id) VALUES('$gr_codigo','$gr_f_emision','$gr_observacion','$empresa_id','$gr_origen','$gr_destino','$gr_dir_origen','$gr_dir_destino','$tipo_envio_id','$gr_f_envio','$gr_cant_bultos','$gr_peso_kilo','$transporte_id')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT') {
    unset($_POST['METHOD']);
    $gr_id=$_GET['gr_id'];
    $gr_codigo=$_POST['gr_codigo'];
    $gr_f_emision=$_POST['gr_f_emision'];
    $gr_observacion=$_POST['gr_observacion'];
    $empresa_id=$_POST['empresa_id'];
    $gr_origen=$_POST['gr_origen'];
    $gr_destino=$_POST['gr_destino'];
    $gr_dir_origen=$_POST['gr_dir_origen'];
    $gr_dir_destino=$_POST['gr_dir_destino'];
    $tipo_envio_id=$_POST['tipo_envio_id'];
    $gr_f_envio=$_POST['gr_f_envio'];
    $gr_cant_bultos=$_POST['gr_cant_bultos'];
    $gr_peso_kilo=$_POST['gr_peso_kilo'];
    $transporte_id=$_POST['transporte_id'];
    $query="UPDATE guia_remision SET gr_codigo='$gr_codigo',gr_f_emision='$gr_f_emision',gr_observacion='$gr_observacion',empresa_id='$empresa_id',gr_origen='$gr_origen',gr_destino='$gr_destino',gr_dir_origen='$gr_dir_origen',gr_dir_destino='$gr_dir_destino',tipo_envio_id='$tipo_envio_id',gr_f_envio='$gr_f_envio',gr_cant_bultos='$gr_cant_bultos',gr_peso_kilo=$gr_peso_kilo,transporte_id=$transporte_id WHERE gr_id='$gr_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE') {
    unset($_POST['METHOD']);
    $gr_id=$_GET['gr_id'];
    $query="DELETE FROM guia_remision WHERE gr_id='$gr_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");