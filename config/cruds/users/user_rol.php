<?php

include_once '../../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET['id'])) {
        $query="SELECT * FROM usuarios_roles";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $usuarios_id=$_POST['usuarios_id'];
    $roles_id=$_POST['roles_id'];
    $query="INSERT INTO usuarios_roles(usuarios_id,roles_id) VALUES ('$usuarios_id','$roles_id')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $usuarios_id=$_POST['usuarios_id'];
    $roles_id=$_POST['roles_id'];
    $query="UPDATE usuarios_roles SET roles_id='$roles_id' WHERE usuarios_roles.usuarios_id=$usuarios_id AND usuarios_roles.roles_id=$roles_id ";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $usuarios_id=$_POST['usuarios_id'];
    $roles_id=$_POST['roles_id'];
    $query="DELETE FROM usuarios_roles WHERE usuarios_roles.usuarios_id=$usuarios_id AND usuarios_roles.roles_id=$roles_id";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");