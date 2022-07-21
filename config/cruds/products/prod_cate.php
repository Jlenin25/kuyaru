<?php

include_once '../../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['produc_id'])){
        $query="SELECT * FROM prod_cat WHERE `produc_id`=".$_GET['produc_id']." AND `cate_id`=".$_GET['cate_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM prod_cat";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $produc_id=$_POST['produc_id'];
    $cate_id=$_POST['cate_id'];
    $query="INSERT INTO prod_cat(produc_id,cate_id) VALUES ($cate_id,$cate_id)";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $produc_id1=$_GET['produc_id'];
    $cate_id2=$_GET['cate_id'];
    $produc_id=$_POST['produc_id'];
    $cate_id=$_POST['cate_id'];
    $query="UPDATE prod_cat pc SET produc_id=$produc_id,cate_id=$cate_id WHERE pc.produc_id=$produc_id1 AND pc.cate_id=$cate_id1";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $produc_id=$_GET['produc_id'];
    $cate_id=$_POST['cate_id'];
    $query="DELETE FROM prod_cat pc WHERE pc.produc_id='$produc_id' AND pc.cate_id=$cate_id";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request"); 