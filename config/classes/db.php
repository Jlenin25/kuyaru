<?php

$pdo = null;
$host = 'localhost';
$db = 'vicat_db2';
$password = '';
$user = 'root';

function conectar() {
    try {
        $GLOBALS['pdo'] = new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['db'].'',$GLOBALS['user'],$GLOBALS['password']);
        $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print 'Error! No se pudo conectar a la Base de Datos'.$GLOBALS['db'].'<br />';
        print '\nError!: '.$e.'<br />';
        die();
    }
}
function desconectar() {
    $GLOBALS['pdo'] = null;
}
function metodoGet($query) {
    try {
        conectar();
        $sentencia = $GLOBALS['pdo']->prepare($query);
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        desconectar();
        return $sentencia;
    } catch(PDOException $e) {
        die('Error: '.$e);
    }
}
function metodoPost($query) {
    try {
        conectar();
        $sentencia = $GLOBALS['pdo']->prepare($query);
        $sentencia->execute();
        $sentencia->clouseCursor();
        desconectar();
        return $sentencia;
    } catch(PDOException $e) {
        die('Error: '.$e);
    }
}
function metodoPut($query) {
    try {
        conectar();
        $sentencia = $GLOBALS['pdo']->prepare($query);
        $sentencia->execute();
        $resultado = array_merge($_GET, $_POST);
        $sentencia->clouseCursor();
        desconectar();
        return $resultado;
    } catch(PDOException $e) {
        die('Error: '.$e);
    }
}
function metodoDelete($query) {
    try {
        conectar();
        $sentencia = $GLOBALS['pdo']->prepare($query);
        $sentencia->execute();
        $sentencia->clouseCursor();
        desconectar();
        return $_GET['id'];
    } catch(PDOException $e) {
        die('Error: '.$e);
    }
}