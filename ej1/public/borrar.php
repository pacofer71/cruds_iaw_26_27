<?php
session_start();
$id=filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
if(!$id){
    header("Location:articulos.php");
    die();
}
require __DIR__."/../BD/conexion.php";
$q="delete from articulos where id=?";
$stmt=mysqli_prepare($llave, $q);
if($stmt){
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
    $_SESSION['mensaje']="Registro Eliminado de la base de datos";
    header("Location:articulos.php");
}
