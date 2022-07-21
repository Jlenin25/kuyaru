<?php

include_once '../../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['user_id'])){
        $query="SELECT * FROM usuarios WHERE `user_id`=".$_GET['user_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM usuarios u INNER JOIN roles r ON u.rol_id=r.rol_id ORDER BY 'user_nombre' ASC ";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $user_nombre=$_POST['user_nombre'];
    $ape_paterno=$_POST['ape_paterno'];
    $ape_materno=$_POST['ape_materno'];
    $nickname=$_POST['nickname'];
    $user_email=$_POST['user_email'];
    $clave=$_POST['password'];
    $passwords1=password_hash($clave, PASSWORD_DEFAULT);
    $user_celular=$_POST['user_celular'];
    $user_direccion=$_POST['user_direccion'];
    $user_dni=$_POST['user_dni'];
    $user_imagen=$_POST['user_imagen'];
    $rol_id=$_POST['rol_id'];
    $user_estado=intval($_POST['user_estado']);
    $query="INSERT INTO usuarios(user_nombre,ape_paterno,ape_materno,nickname,user_email,password,user_celular,user_direccion,user_dni,user_imagen,rol_id,user_estado) VALUES ('$user_nombre','$ape_paterno','$ape_materno','$nickname','$user_email','$passwords1','$user_celular','$user_direccion','$user_dni','$user_imagen','$rol_id',$user_estado)";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $user_id=$_GET['user_id'];
    $user_nombre=$_POST['user_nombre'];
    $ape_paterno=$_POST['ape_paterno'];
    $ape_materno=$_POST['ape_materno'];
    $nickname=$_POST['nickname'];
    $user_email=$_POST['user_email'];
    $clave=$_POST['password'];
    $passwords=password_hash($clave, PASSWORD_DEFAULT);
    $user_celular=$_POST['user_celular'];
    $user_direccion=$_POST['user_direccion'];
    $user_dni=$_POST['user_dni'];
    $user_imagen=$_POST['user_imagen'];
    $rol_id=$_POST['rol_id'];
    $user_estado=intval($_POST['user_estado']);
    $query="UPDATE usuarios SET user_nombre='$user_nombre',ape_paterno='$ape_paterno',ape_materno='$ape_materno',nickname='$nickname',user_email='$user_email',user_celular='$user_celular',user_direccion='$user_direccion',user_dni='$user_dni',user_imagen='$user_imagen',rol_id='$rol_id',user_estado=$user_estado WHERE user_id='$user_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $user_id=$_GET['user_id'];
    $query="DELETE FROM usuarios WHERE user_id='$user_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");