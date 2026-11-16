<?php
session_start();
require __DIR__ . "/../bd/conexion.php";
$q = "select * from videojuegos order by id desc";
$videojuegos = mysqli_query($llave, $q);
mysqli_close($llave);
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
    <title>Videojuegos</title>
</head>

<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-7xl mx-auto">

        <!-- Cabecera -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-gamepad text-indigo-600 mr-2"></i>
                    Gestión de videojuegos
                </h1>
                <p class="text-gray-500 text-sm mt-1">
                    Administra tu catálogo de videojuegos
                </p>
            </div>

            <a href="crear.php"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-plus"></i>
                Añadir videojuego
            </a>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">

                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-bold">Título</th>
                            <th class="px-6 py-4 font-bold">Descripción</th>
                            <th class="px-6 py-4 font-bold text-center">Disponible</th>
                            <th class="px-6 py-4 font-bold">Precio</th>
                            <th class="px-6 py-4 font-bold text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        <!-- Fila de ejemplo -->
                        <?php foreach ($videojuegos as $item):
                            $estiloDisponible = ($item['disponible'] == 'SI') ? "bg-green-100 text-green-700" : "bg-red-100 text-red-700";
                        ?>
                            <tr class="hover:bg-indigo-50/40 transition duration-200">

                                <td class="px-6 py-5">
                                    <div class="font-semibold text-gray-800">
                                        <?= $item['nombre'] ?>
                                    </div>

                                </td>

                                <td class="px-6 py-5 max-w-xs">
                                    <p class="truncate">
                                        <?= $item['descripcion'] ?>
                                    </p>
                                </td>

                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold <?= $estiloDisponible ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <?= $item['disponible'] ?>
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <span class="font-bold text-gray-800 text-base">
                                        <?= $item['precio'] ?> €
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <form method="POST" action="borrar.php">
                                        <input type="hidden" name="codigo" value="<?= $item['id'] ?>" />
                                        <div class="flex justify-center items-center gap-2">

                                            <a href="editar.php?id=1"
                                                title="Editar"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="submit"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </div>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>

                </table>
            </div>


        </div>

    </div>

</body>

</html>