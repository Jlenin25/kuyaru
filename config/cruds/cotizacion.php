<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['coti_id'])){
        $query="SELECT * FROM cotizacion WHERE `coti_id`=".$_GET['coti_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM cotizacion";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $coti_codigo='00003063';
    $coti_f_emision = $_POST['coti_f_vencimiento'];
    $coti_f_vencimiento = $_POST['coti_f_vencimiento'];
    $coti_desc_global = $_POST['coti_desc_global'];
    $coti_refer_pago = $_POST['coti_refer_pago'];
    $coti_observaciones = $_POST['coti_observaciones'];
    $clientprov_id = $_POST['clientprov_id'];
    $coti_condi_pago = 1;
    $meto_pago_id = 1;
    $user_id = 1;
    $coti_estado = 1;
    $query="INSERT INTO cotizacion(coti_codigo,coti_f_emision,coti_f_vencimiento,coti_desc_global,coti_refer_pago,coti_observaciones,serie_id,impresion_id,empresa_id,comprobante_venta_id,clientprov_id,coti_condi_pago,meto_pago_id,user_id,coti_estado) VALUES('$coti_codigo','$coti_f_emision','$coti_f_vencimiento','$coti_desc_global','$coti_refer_pago','$coti_observaciones',1,1,1,1,$clientprov_id,$coti_condi_pago,$meto_pago_id,$user_id,$coti_estado)";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $coti_codigo=$_POST['coti_codigo'];
    $coti_f_emision=$_POST['coti_f_emision'];
    $coti_f_vencimiento=$_POST['coti_f_vencimiento'];
    $coti_desc_global=$_POST['coti_desc_global'];
    $coti_refer_pago=$_POST['coti_refer_pago'];
    $coti_observaciones=$_POST['coti_observaciones'];
    $clientprov_id=$_POST['clientprov_id'];
    $coti_condi_pago=$_POST['coti_condi_pago'];
    $meto_pago_id=$_POST['meto_pago_id'];
    $user_id=$_POST['user_id'];
    $coti_estado=$_POST['coti_estado'];
    $query="UPDATE cotizacion SET coti_codigo='$coti_codigo',coti_f_emision='$coti_f_emision',coti_f_vencimiento='$coti_f_vencimiento',coti_desc_global='$coti_desc_global',coti_refer_pago='$coti_refer_pago',coti_observaciones='$coti_observaciones',serie_id=1,impresion_id=1,empresa_id=1,comprobante_venta_id=1,clientprov_id=$clientprov_id,coti_condi_pago='$coti_condi_pago',meto_pago_id=$meto_pago_id,user_id=$user_id,coti_estado=$coti_estado WHERE coti_id=$coti_id";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $coti_id=$_GET['coti_id'];
    $query="DELETE FROM cotizacion WHERE coti_id='$coti_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");