<?php
try{
    $llave=mysqli_connect("mariadb_db", "usuario1", "secret0", "crud1");
}catch(Exception $ex){
    die("Error en la conexion mensaje de error: ".$ex->getMessage());
}