<?php

include_once '../../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['permiso_id'])){
        $query="SELECT * FROM permisos WHERE `permiso_id`=".$_GET['permiso_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM permisos";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $permiso_nombre=$_POST['permiso_nombre'];
    $query="INSERT INTO permisos(permiso_nombre) VALUES ('$permiso_nombre')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $permiso_id=$_GET['permiso_id'];
    $permiso_nombre=$_POST['permiso_nombre'];
    $query="UPDATE permisos SET permiso_nombre='$permiso_nombre' WHERE permiso_id='$permiso_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $permiso_id=$_GET['permiso_id'];
    $query="DELETE FROM permisos WHERE permiso_id='$permiso_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");