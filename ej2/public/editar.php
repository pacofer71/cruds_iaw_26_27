<?php
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location:inicio.php");
    exit;
}

require __DIR__ . "/../bd/conexion.php";
require __DIR__ . "/../utils/validaciones.php";
// Vamos a traernos los datos del registro a editar para rellenar los campos
$q = "select * from videojuegos where id=?"; //id, nombre, descripcion,  disponible, precio
$stmt = mysqli_prepare($llave, $q);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cod, $nom, $des, $dis, $pvp);
    mysqli_stmt_fetch($stmt); //leo la fila que me ha devuelto O no si no devuelve nada
    mysqli_stmt_close($stmt);
    if (!$cod) {
        // no ha encontrado ningun juego con ese id
        header("Location:inicio.php");
        exit;
    }
}
$nombre=$nom;
$descripcion=$des;
$disponible=$dis;
$precio=$pvp;

$ckSi=($disponible=='SI') ? "checked" : "";
$ckNo=($disponible=='NO') ? "checked" : "";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //1.- Recogemos y limpiamos
    $nombre = sanearCadena($_POST['nombre']);
    $descripcion = sanearCadena($_POST['descripcion']);
    $precio = (float) $_POST['precio'];
    //$disponible=isset($_POST['disponible']) ? $_POST['disponible'] : "Error";
    $disponible = $_POST['disponible'] ?? "Error";
    $disponible = sanearCadena($disponible);
    //2.- VAlidamos los datos
    $errores = false;
    if (!longituCadenaValida('nombre', $nombre, 3, 150)) {
        $errores = true;
    } else {
        if (existeJuegoGlobal($llave, $nombre, $id)) {
           $errores = true;
        }
    }

    if (!longituCadenaValida('descripcion', $descripcion, 10, 250)) {
        $errores = true;
    }
    if (!precioValido($precio)) {
        $errores = true;
    }
    if (!disponibleValido($disponible)) {
        $errores = true;
    }
    // SI no errores guarfamos el juego
    if (!$errores) {
        $q = "update videojuegos set nombre=?, descripcion=?, disponible=?, precio=? where id=?";
        $stmt = mysqli_prepare($llave, $q);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sssdi', $nombre, $descripcion, $disponible, $precio, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($llave);
            $_SESSION['mensaje'] = "Registro Editado";
            header("Location:inicio.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN Fontawesome iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- CDN Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Editar Videojuego</title>
</head>

<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-3xl mx-auto">

        <!-- Cabecera -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-gamepad text-indigo-600 mr-2"></i>
                Editar videojuego
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                Introduce los datos del videojuego
            </p>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">

            <form action="editar.php?id=<?= $id ?>" method="POST">

                <!-- Nombre -->
                <div class="mb-5">
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-indigo-500 mr-1"></i>
                        Nombre del videojuego
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="<?= $nombre ?>"
                        placeholder="Introduce el nombre del videojuego"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>
                <?php pintarError('err_nombre') ?>

                <!-- Descripción -->
                <div class="mb-5">
                    <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-indigo-500 mr-1"></i>
                        Descripción
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="4"
                        placeholder="Describe el videojuego..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition resize-y"><?= $descripcion ?></textarea>
                </div>
                <?php pintarError('err_descripcion') ?>

                <!-- Disponible -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-toggle-on text-indigo-500 mr-1"></i>
                        Disponible
                    </label>

                    <div class="flex items-center gap-8">

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="radio"
                                name="disponible"
                                value="SI"
                                <?= $ckSi ?>
                                class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm text-gray-700 font-medium">
                                Sí
                            </span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="radio"
                                name="disponible"
                                value="NO"
                                <?= $ckNo ?>
                                class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm text-gray-700 font-medium">
                                No
                            </span>
                        </label>

                    </div>
                </div>
                <?php pintarError('err_disponible') ?>

                <!-- Precio -->
                <div class="mb-8">
                    <label for="precio" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-euro-sign text-indigo-500 mr-1"></i>
                        Precio (€)
                    </label>

                    <input
                        type="text"
                        id="precio"
                        name="precio"
                        value="<?= $precio ?>"
                        placeholder="Ejemplo: 59.99"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>
                <?php pintarError('err_precio') ?>

                <!-- Botones -->
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 border-t border-gray-100 pt-6">

                    <a href="inicio.php"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100 transition">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 shadow-md transition">
                        <i class="fas fa-save"></i>
                        Editar videojuego
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>


</html>