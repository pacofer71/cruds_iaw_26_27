<?php
try{
    $llave=mysqli_connect("mariadb_db", "usuario2", "secret0", "crud2", 3306);
}catch(Exception $ex){
    die("Error en la conexion: ".$ex->getMessage());
}