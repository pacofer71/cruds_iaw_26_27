<?php
    require __DIR__."/../BD/conexion.php";
    $q="select * from articulos order by id desc";
    $resultados=mysqli_query($llave, $q);
    mysqli_close($llave);
    // resultado guarda un array con todos los elementos
    //cada elemento es un array con los campos id, nombre, descripcion
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Tailwind css -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Articulos</title>
</head>

<body class="bg-slate-50 p-6 md:p-10">

    <div class="mx-auto max-w-6xl">

        <!-- Cabecera y botón crear -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                    Artículos
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Gestiona los artículos de tu aplicación.
                </p>
            </div>

            <a href="crear.php"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3
                      text-sm font-semibold text-white shadow-md shadow-indigo-200
                      transition hover:bg-indigo-700 hover:shadow-lg
                      focus:outline-none focus:ring-2 focus:ring-indigo-500
                      focus:ring-offset-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4v16m8-8H4" />
                </svg>

                Nuevo Artículo
            </a>
        </div>

        <!-- Tabla -->
        <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">

                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 font-semibold uppercase
                                       tracking-wider text-slate-500">
                                ID
                            </th>
                            <th class="px-6 py-4 font-semibold uppercase
                                       tracking-wider text-slate-500">
                                Nombre
                            </th>
                            <th class="px-6 py-4 font-semibold uppercase
                                       tracking-wider text-slate-500">
                                Descripción
                            </th>
                            <th class="px-6 py-4 text-right font-semibold
                                       uppercase tracking-wider text-slate-500">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        <!-- Fila de ejemplo -->
                         <?php foreach($resultados as $articulo): ?>
                        <tr class="transition hover:bg-slate-50">

                            <td class="whitespace-nowrap px-6 py-5">
                                <span class="rounded-lg bg-slate-100 px-3 py-1
                                             font-mono text-xs font-semibold
                                             text-slate-600">
                                    <?= $articulo['id'] ?>
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-6 py-5">
                                <span class="font-semibold text-slate-800">
                                    <?= $articulo['nombre'] ?>
                                </span>
                            </td>

                            <td class="max-w-sm px-6 py-5 text-slate-500">
                                <?= $articulo['descripcion'] ?>
                            </td>

                            <td class="whitespace-nowrap px-6 py-5">
                                <div class="flex items-center justify-end gap-2">

                                    <!-- Editar -->
                                    <a href="editar.php?id=1"
                                        class="inline-flex items-center gap-1.5
                                              rounded-lg border border-indigo-200
                                              bg-indigo-50 px-3 py-2
                                              text-xs font-semibold text-indigo-700
                                              transition hover:bg-indigo-100">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m16.862 4.487 2.651 2.651
                                                     M7 17l4-1 9-9a2.121
                                                     2.121 0 0 0-3-3l-9
                                                     9-1 4z" />
                                        </svg>
                                        Editar
                                    </a>

                                    <!-- Eliminar -->
                                    <a href="eliminar.php?id=1"
                                        class="inline-flex items-center gap-1.5
                                              rounded-lg border border-rose-200
                                              bg-rose-50 px-3 py-2
                                              text-xs font-semibold text-rose-600
                                              transition hover:bg-rose-100">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19 7l-.867 12.142
                                                     A2 2 0 0 1 16.138 21H7.862
                                                     a2 2 0 0 1-1.995-1.858L5
                                                     7m5 4v6m4-6v6M9 7V4
                                                     a1 1 0 0 1 1-1h4a1 1
                                                     0 0 1 1 1v3M4 7h16" />
                                        </svg>
                                        Eliminar
                                    </a>

                                </div>
                            </td>

                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <!-- Pie de tabla -->
            <div class="border-t border-slate-100 bg-white px-6 py-4">
                <p class="text-xs text-slate-500">
                    Mostrando <span class="font-semibold text-slate-700">1</span>
                    artículo de ejemplo
                </p>
            </div>

        </div>

    </div>

</body>

</html>