<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['docs_id'])){
        $query="SELECT * FROM documentos WHERE `docs_id`=".$_GET['docs_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM documentos";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $docs_nombre=$_POST['docs_nombre'];
    $query="INSERT INTO documentos(docs_nombre) VALUES ('$docs_nombre')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $docs_id=$_GET['docs_id'];
    $docs_nombre=$_POST['docs_nombre'];
    $query="UPDATE documentos SET docs_nombre='$docs_nombre' WHERE docs_id='$docs_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $docs_id=$_GET['docs_id'];
    $query="DELETE FROM documentos WHERE docs_id='$docs_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");