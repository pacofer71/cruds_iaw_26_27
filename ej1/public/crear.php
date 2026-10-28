<?php
    session_start();
    require __DIR__."/../BD/conexion.php";
    require __DIR__."/../validaciones/misvalidaciones.php";
    $nombre="";
    $descripcion="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //1.- Recojo y limpio los campos del form
        $nombre=sanearCadena($_POST['nombre']);
        $descripcion=sanearCadena($_POST['descripcion']);
        //2.- Vamos a validar
        $errores=false;
        if(!esLongitudCadenaValida($nombre, 3, 50, 'nombre')){
            $errores=true;
        }
        if(!esLongitudCadenaValida($descripcion, 10, 500, 'descripcion')){
            $errores=true;
        }
        if($errores==false){ //if(!$errores)
            //si entramos aqui NO tengo errores de validacion vamos a guaradr el articulo
        $q="insert into articulos(nombre, descripcion) values(?,?)";
        $stmt=mysqli_prepare($llave, $q);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'ss', $nombre, $descripcion);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($llave);
            $_SESSION['mensaje']="Artículo Guardado";
            header("Location: articulos.php");
            die();
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Nuevo</title>
</head>

<body class="min-h-screen bg-slate-50 p-6 md:p-10">

    <div class="mx-auto max-w-3xl">

        <!-- Cabecera -->
        <div class="mb-8">
            <a href="articulos.php"
               class="mb-4 inline-flex items-center gap-2 text-sm font-medium
                      text-slate-500 transition hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a artículos
            </a>

            <h1 class="text-3xl font-bold tracking-tight text-slate-800">
                Nuevo artículo
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Completa los siguientes campos para registrar un nuevo artículo.
            </p>
        </div>

        <!-- Formulario -->
        <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            <form action="crear.php" method="POST" class="p-6 md:p-8">

                <!-- Nombre -->
                <div class="mb-6">
                    <label for="nombre"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Nombre del artículo
                        <span class="text-rose-500">*</span>
                    </label>

                    <input type="text"
                           id="nombre"
                           name="nombre"
                           value="<?= $nombre ?>"
                           placeholder="Ej. Teclado mecánico RGB"
                           required
                           maxlength="150"
                           class="w-full rounded-xl border border-slate-300
                                  bg-white px-4 py-3 text-sm text-slate-800
                                  placeholder:text-slate-400
                                  transition focus:border-indigo-500
                                  focus:outline-none focus:ring-4
                                  focus:ring-indigo-500/10">
                </div>

                <!-- Descripción -->
                <div class="mb-8">
                    <label for="descripcion"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Descripción
                        <span class="text-rose-500">*</span>
                    </label>

                    <textarea id="descripcion"
                              name="descripcion"
                              rows="5"
                              placeholder="Escribe una descripción detallada del artículo..."
                              required
                              class="w-full resize-y rounded-xl border
                                     border-slate-300 bg-white px-4 py-3
                                     text-sm text-slate-800
                                     placeholder:text-slate-400
                                     transition focus:border-indigo-500
                                     focus:outline-none focus:ring-4
                                     focus:ring-indigo-500/10"><?= $descripcion ?></textarea>

                    <p class="mt-2 text-xs text-slate-400">
                        Introduce la información más relevante del artículo.
                    </p>
                </div>

                <!-- Separador -->
                <div class="mb-6 border-t border-slate-100"></div>

                <!-- Botones -->
                <div class="flex flex-col-reverse gap-3 sm:flex-row
                            sm:items-center sm:justify-end">

                    <!-- Cancelar -->
                    <a href="articulos.php"
                       class="inline-flex items-center justify-center gap-2
                              rounded-xl border border-slate-300 bg-white
                              px-5 py-3 text-sm font-semibold text-slate-600
                              transition hover:bg-slate-50 hover:text-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancelar
                    </a>

                    <!-- Limpiar -->
                    <button type="reset"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl border border-amber-200
                                   bg-amber-50 px-5 py-3 text-sm font-semibold
                                   text-amber-700 transition hover:bg-amber-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 7h16M10 11v6m4-6v6M5 7l1 13h12l1-13
                                     M9 7V4h6v3"/>
                        </svg>
                        Limpiar
                    </button>

                    <!-- Enviar -->
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-indigo-600 px-6 py-3
                                   text-sm font-semibold text-white
                                   shadow-md shadow-indigo-200
                                   transition hover:bg-indigo-700
                                   hover:shadow-lg focus:outline-none
                                   focus:ring-2 focus:ring-indigo-500
                                   focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        Enviar artículo
                    </button>

                </div>

            </form>
        </div>

       

    </div>

</body>

</html>