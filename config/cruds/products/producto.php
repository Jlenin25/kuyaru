<?php

include_once '../../classes/db.php';
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['produc_id'])){
        $query="SELECT * FROM productos WHERE `produc_id`=".$_GET['produc_id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM productos";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    // $query="SELECT * FROM productos p INNER JOIN impuesto i WHERE p.impuesto_id=i.impuesto_id ORDER BY produc_nombre ASC";
    // $resultado=metodoGet($query);
    unset($_POST['METHOD']);
    $produc_codigo=$_POST['produc_codigo'];
    $produc_nombre=$_POST['produc_nombre'];
    $produc_descripcion=$_POST['produc_descripcion'];
    $produc_marca=$_POST['produc_marca'];
    $produc_precio=$_POST['produc_precio'];
    $produc_stock=$_POST['produc_stock'];
    $produc_unidmedida=$_POST['produc_unidmedida'];
    $produc_imagen=$_POST['produc_imagen'];
    $produc_estado=$_POST['produc_estado'];
    $produc_igv=$_POST['produc_igv'];
    $impuesto_id=$_POST['impuesto_id'];
    $moneda_id=$_POST['moneda_id'];
    $query="INSERT INTO productos(produc_codigo,produc_nombre,produc_descripcion,produc_marca,produc_precio,produc_stock,produc_unidmedida,produc_imagen,produc_estado,produc_igv,impuesto_id,moneda_id) VALUES ('$produc_codigo','$produc_nombre','$produc_descripcion','$produc_marca','$produc_precio','$produc_stock','$produc_unidmedida','$produc_imagen',$produc_estado,$produc_igv,'$impuesto_id','$moneda_id')";
    $resultado=metodoPost($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $produc_id=$_GET['produc_id'];
    $produc_codigo=$_POST['produc_codigo'];
    $produc_nombre=$_POST['produc_nombre'];
    $produc_descripcion=$_POST['produc_descripcion'];
    $produc_marca=$_POST['produc_marca'];
    $produc_precio=$_POST['produc_precio'];
    $produc_stock=$_POST['produc_stock'];
    $produc_unidmedida=$_POST['produc_unidmedida'];
    $produc_imagen=$_POST['produc_imagen'];
    $produc_estado=$_POST['produc_estado'];
    $produc_igv=$_POST['produc_igv'];
    $impuesto_id=$_POST['impuesto_id'];
    $moneda_id=$_POST['moneda_id'];
    $query="UPDATE productos SET produc_codigo='$produc_codigo',produc_nombre='$produc_nombre',produc_descripcion='$produc_descripcion',produc_marca='$produc_marca',produc_precio='$produc_precio',produc_stock='$produc_stock',produc_unidmedida='$produc_unidmedida',produc_imagen='$produc_imagen',produc_estado=$produc_estado,produc_igv=$produc_igv,impuesto_id='$impuesto_id',moneda_id='$moneda_id' WHERE produc_id='$produc_id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $produc_id=$_GET['produc_id'];
    $query="DELETE FROM productos WHERE produc_id='$produc_id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
header("HTTP/1.1 400 Bad Request");