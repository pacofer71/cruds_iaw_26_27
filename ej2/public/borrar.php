<?php
$id=filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
if(!$id){
    header("Location:inicio.php");
    exit;
}
session_start();
//1.- Nos traemos la llave
require __DIR__."/../bd/conexion.php";
$q="delete from videojuegos where id = ?";
$stmt=mysqli_prepare($llave, $q);
if($stmt){
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
}
$_SESSION['mensaje']="Registro Borrado";
header("Location:inicio.php");
