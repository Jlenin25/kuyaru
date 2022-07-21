<?php

include_once '../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['fac_id'])){
        $query="SELECT * FROM factura WHERE `fac_id`=".$_GET['fac_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM factura";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $fac_codigo=$_POST['fac_codigo'];
    $fac_f_emision=$_POST['fac_f_emision'];
    $fac_f_vencimiento=$_POST['fac_f_vencimiento'];
    $fac_desc_global=$_POST['fac_desc_global'];
    $fac_refer_pago=$_POST['fac_refer_pago'];
    $fac_observaciones=$_POST['fac_observaciones'];
    $impresion_id=$_POST['impresion_id'];
    $empresa_id=$_POST['empresa_id'];
    $fac_condi_pago=$_POST['fac_condi_pago'];
    $meto_pago_id=$_POST['meto_pago_id'];
    $user_id=$_POST['user_id'];
    $fac_estado=$_POST['fac_estado'];
    $sucursal_id=$_POST['sucursal_id'];
    $query="INSERT INTO factura(fac_codigo,fac_f_emision,fac_f_vencimiento,fac_desc_global,fac_refer_pago,password,impresion_id,empresa_id,fac_condi_pago,meto_pago_id,user_id,fac_estado,sucursal_id) VALUES
		('$fac_codigo','$fac_f_emision','$fac_f_vencimiento','$fac_desc_global','$fac_refer_pago','$fac_observaciones','$impresion_id','$empresa_id','$fac_condi_pago','$meto_pago_id','$user_id','$fac_estado','$sucursal_id')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $fac_id=$_GET['fac_id'];
    $fac_codigo=$_POST['fac_codigo'];
    $fac_f_emision=$_POST['fac_f_emision'];
    $fac_f_vencimiento=$_POST['fac_f_vencimiento'];
    $fac_desc_global=$_POST['fac_desc_global'];
    $fac_refer_pago=$_POST['fac_refer_pago'];
    $fac_observaciones=$_POST['fac_observaciones'];
    $impresion_id=$_POST['impresion_id'];
    $empresa_id=$_POST['empresa_id'];
    $fac_condi_pago=$_POST['fac_condi_pago'];
    $meto_pago_id=$_POST['meto_pago_id'];
    $user_id=$_POST['user_id'];
    $fac_estado=$_POST['fac_estado'];
    $sucursal_id=$_POST['sucursal_id'];
    $query="UPDATE factura SET fac_codigo='$fac_codigo',fac_f_emision='$fac_f_emision',fac_f_vencimiento='$fac_f_vencimiento',fac_desc_global='$fac_desc_global',fac_refer_pago='$fac_refer_pago',fac_observaciones='$fac_observaciones',impresion_id='$impresion_id',empresa_id='$empresa_id',fac_condi_pago='$fac_condi_pago',meto_pago_id='$meto_pago_id',user_id='$user_id',fac_estado=$fac_estado,sucursal_id=$sucursal_id WHERE fac_id='$fac_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $fac_id=$_GET['fac_id'];
    $query="DELETE FROM factura WHERE fac_id='$fac_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");