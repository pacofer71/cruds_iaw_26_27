<?php
$id=filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
if(!$id){
    header("Location:inicio.php");
    exit;
}
