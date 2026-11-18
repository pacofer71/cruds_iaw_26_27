<?php
try{
    $llave=mysqli_connect('mariadb_db', 'usuario3', 'secret0', 'crud3', 3306);
}catch(Exception $ex){
    die("Error en la conexion, el mensaje de error es: ".$ex->getMessage());
}