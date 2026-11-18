<?php

function sanearCadena(string $cad): string
{
    return htmlspecialchars(trim($cad));
}
function longituCadenaValida(string $nombre, string $valor, int $min, int $max): bool
{
    if (strlen($valor) < $min || strlen($valor) > $max) {
        $_SESSION["err_$nombre"] = "*** Error, se esperaba una longitud entre $min y $max caracteres";
        return false;
    }
    return true;
}

function disponibleValido(string $disponible): bool
{
    if ($disponible == "SI" || $disponible == "NO") {
        return true;
    }
    $_SESSION['err_disponible'] = "*** Error campo disponible no seleccionado o invalido";
    return false;
}
function precioValido(float $precio){
    if($precio>9999.99 || $precio<1.0){
        $_SESSION['err_precio']="*** Error, se esperaba una cantidad entre 1 y 9999.99";
        return false;
    }
    return true;
}

function existeJuegoGlobal(mysqli $llave, string $nombre, $id=null): bool{
    $q=($id==null) ? "select id from videojuegos where nombre=?" :
     "select id from videojuegos where nombre=? AND id!=?";
    
     //$q="select id from videojuegos where nombre=?";
    $stmt=mysqli_prepare($llave, $q);
    if($stmt){
        ($id==null) ? mysqli_stmt_bind_param($stmt, 's', $nombre) :
         mysqli_stmt_bind_param($stmt, 'si', $nombre, $id);
         
        mysqli_stmt_execute($stmt);
        //para poder contar las filas guardo el resultado
        mysqli_stmt_store_result($stmt);
        $filas=mysqli_stmt_num_rows($stmt); // sera 1 o 0
        mysqli_stmt_close($stmt);
        if($filas==1){
            $_SESSION['err_nombre']="*** Error, $nombre ya está registrado";
            return true;
        }
    }
    return false;
}

function existeJuego(mysqli $llave, string $nombre): bool{
    $q="select id from videojuegos where nombre=?";
    $stmt=mysqli_prepare($llave, $q);
    if($stmt){
        mysqli_stmt_bind_param($stmt, 's', $nombre);
        mysqli_stmt_execute($stmt);
        //para poder contar las filas guardo el resultado
        mysqli_stmt_store_result($stmt);
        $filas=mysqli_stmt_num_rows($stmt); // sera 1 o 0
        mysqli_stmt_close($stmt);
        if($filas==1){
            $_SESSION['err_nombre']="*** Error, $nombre ya está registrado";
            return true;
        }
    }
    return false;
}
function existeJuego2(mysqli $llave, string $nombre, int $id): bool{
    $q="select id from videojuegos where nombre=? AND id != ?";
    $stmt=mysqli_prepare($llave, $q);
    if($stmt){
        mysqli_stmt_bind_param($stmt, 'si', $nombre, $id);
        mysqli_stmt_execute($stmt);
        //para poder contar las filas guardo el resultado
        mysqli_stmt_store_result($stmt);
        $filas=mysqli_stmt_num_rows($stmt); // sera 1 o 0
        mysqli_stmt_close($stmt);
        if($filas==1){
            $_SESSION['err_nombre']="*** Error, $nombre ya está registrado";
            return true;
        }
    }
    return false;
}

function pintarError(string $nombreError){
    if(isset($_SESSION[$nombreError])){
        echo "<p class='text-red-600 italic text-sm'>".$_SESSION[$nombreError]."</p>";
        unset($_SESSION[$nombreError]);
    }
}
