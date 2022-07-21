<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['clientprov_id'])){
        $query="SELECT * FROM clientprov WHERE `clientprov_id`=".$_GET['clientprov_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM clientprov";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $docs_id=$_POST['docs_id'];
    $clientprov_numdocumento=$_POST['clientprov_numdocumento'];
		$clientprov_nombre=$_POST['clientprov_nombre'];
    $clientprov_email=$_POST['clientprov_email'];
		$clientprov_celular=$_POST['clientprov_celular'];
    $clientprov_direccion=$_POST['clientprov_direccion'];
		$clientprov_observaciones=$_POST['clientprov_observaciones'];
    $clientprov_estado=$_POST['clientprov_estado'];
    $query="INSERT INTO clientprov(docs_id,clientprov_numdocumento,clientprov_nombre,clientprov_email,clientprov_celular,clientprov_direccion,clientprov_observaciones,clientprov_estado) VALUES
		($docs_id,$clientprov_numdocumento,$clientprov_nombre,$clientprov_email,$clientprov_celular,$clientprov_direccion,$clientprov_observaciones,$clientprov_estado)";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $clientprov_id=$_GET['clientprov_id'];
    $docs_id=$_POST['docs_id'];
    $clientprov_numdocumento=$_POST['clientprov_numdocumento'];
		$clientprov_nombre=$_POST['clientprov_nombre'];
    $clientprov_email=$_POST['clientprov_email'];
		$clientprov_celular=$_POST['clientprov_celular'];
    $clientprov_direccion=$_POST['clientprov_direccion'];
		$clientprov_observaciones=$_POST['clientprov_observaciones'];
    $clientprov_estado=$_POST['clientprov_estado'];
    $query="UPDATE clientprov SET docs_id=$docs_id,clientprov_numdocumento='$clientprov_numdocumento',clientprov_nombre='$clientprov_nombre',clientprov_email='$clientprov_email',clientprov_celular='$clientprov_celular',clientprov_direccion='$clientprov_direccion',clientprov_observaciones='$clientprov_observaciones',clientprov_estado='$clientprov_estado' WHERE clientprov_id='$clientprov_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $clientprov_id=$_GET['clientprov_id'];
    $query="DELETE FROM clientprov WHERE clientprov_id='$clientprov_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");