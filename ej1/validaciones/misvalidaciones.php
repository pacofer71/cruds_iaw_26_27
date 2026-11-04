<?php

function sanearCadena(string $cadena): string{
    return htmlspecialchars(trim($cadena));
}

function esLongitudCadenaValida(string $valorCampo, int $min, int $max, string $nombreCampo): bool{
    if(strlen($valorCampo)<$min || strlen($valorCampo)>$max){
        $_SESSION["err_$nombreCampo"]="*** Error se esperaban entre $min y $max caracteres";
        // Si nombre de campo es nombre creo la variable de sesion $_SESSION['err_nombre']
        // si es descripcion creo la variable de sesion $_SESSION['err_descripcion']
        return false;
    }
    return true;
}
function existeNombre(string $nombre, mysqli $llave){
    $q="select id from articulos where nombre=?";
    //$q="select id from articulos where nombre=? AND id != ?"
    $stmt=mysqli_prepare($llave, $q);
    if($stmt){
        mysqli_stmt_bind_param($stmt, 's', $nombre);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $filas=mysqli_stmt_num_rows($stmt); //numero de filas que devuelve la consulta, necesito guardarla antes
        mysqli_stmt_close($stmt);
        if($filas==1){
            $_SESSION['err_nombre']="Error '$nombre' YA existe en nuestro registros";
            return true;
        }
        return false;

    }
}
function existeNombre2(string $nombre, int $id, mysqli $llave){
   // $q="select id from articulos where nombre=?";
    $q="select id from articulos where nombre=? AND id != ?";
    $stmt=mysqli_prepare($llave, $q);
    if($stmt){
        mysqli_stmt_bind_param($stmt, 'si', $nombre, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $filas=mysqli_stmt_num_rows($stmt); //numero de filas que devuelve la consulta, necesito guardarla antes
        mysqli_stmt_close($stmt);
        if($filas==1){
            $_SESSION['err_nombre']="Error '$nombre' YA existe en nuestro registros";
            return true;
        } 
        return false;

    }
}



function pintarError(string $nombreError){
    if(isset($_SESSION[$nombreError])){
        echo "<p class='text-red-600 italic text-sm'>".$_SESSION[$nombreError]."</p>";
        unset($_SESSION[$nombreError]);
    }
}