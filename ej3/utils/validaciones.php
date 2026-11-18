<?php
function sanearCampos(string $cad): string
{
    return htmlspecialchars(trim($cad));
}

function loginValido(mysqli $llave, string $email, string $password): bool
{
    $q = "select password from usuarios where email=?";
    $stmt = mysqli_prepare($llave, $q);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $passwordHaseada);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if (!$passwordHaseada) {
            //la consulta NO devolvio ninguna fila no existe el email
            $_SESSION['err_login'] = "*** Error, email o password incorrectos";
            return false;
        }
        if (password_verify($password, $passwordHaseada)) {
            return true;
        }
        $_session['err_login'] = "*** Error, email o password incorrectos";
        return false;
    }
}

function pintarError(string $nomError)
{
    if (isset($_SESSION[$nomError])) {
        echo "<p class='italic text-sm text-red-600'>{$_SESSION[$nomError]}</p>";
        unset($_SESSION[$nomError]);
    }
}
