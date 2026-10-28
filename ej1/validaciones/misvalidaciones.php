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