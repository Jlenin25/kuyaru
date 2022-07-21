<?php

include_once '../../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['cate_id'])){
        $query="SELECT * FROM categorias WHERE `cate_id`=".$_GET['cate_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM categorias";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $cate_nombre=$_POST['cate_nombre'];
    $query="INSERT INTO categorias(cate_nombre) VALUES ('$cate_nombre')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $cate_id=$_GET['cate_id'];
    $cate_nombre=$_POST['cate_nombre'];
    $query="UPDATE categorias SET cate_nombre='$cate_nombre' WHERE cate_id='$cate_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $cate_id=$_GET['cate_id'];
    $query="DELETE FROM categorias WHERE cate_id='$cate_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");