<?php
    session_start();
    $email="";
    require __DIR__."/../utils/validaciones.php";
    require __DIR__."/../bd/conexion.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email=sanearCampos($_POST['email']);
        $password=sanearCampos($_POST['password']);
        if(loginValido($llave, $email, $password)){
            session_regenerate_id(true);
            $_SESSION['email']=$email;
            header("Location:admin.php");
            exit;
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
    <!-- CDN Iconos de FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Acceso</title>
</head>


<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">

        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-user-lock text-3xl"></i>
            </div>

            <h1 class="text-3xl font-bold text-gray-800">
                Bienvenido
            </h1>

            <p class="text-gray-500 mt-2">
                Inicia sesión en tu cuenta
            </p>
        </div>

        <!-- Login Form -->
        <form action="login.php" method="POST" class="space-y-6">

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Correo electrónico
                </label>

                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= $email ?>"
                        placeholder="nombre@ejemplo.com"
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Contraseña
                </label>

                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Introduce tu contraseña"
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>
            </div>

           

            <!-- Buttons -->
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Iniciar sesión
                </button>

                <button
                    type="reset"
                    class="px-5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold rounded-xl transition duration-200"
                    title="Limpiar formulario">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>

            </div>
            <?php pintarError('err_login'); ?>

        </form>

       

    </div>

</body>

</html>