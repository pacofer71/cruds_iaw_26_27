<?php
function pintarBarra(){
    echo <<< TXT
    <nav class="bg-indigo-950 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">

        <!-- Título -->
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-newspaper text-2xl text-indigo-400"></i>
            <h1 class="text-xl font-bold tracking-wide">
                Gestión de posts
            </h1>
        </div>

        <!-- Usuario y salir -->
        <div class="flex items-center gap-5">

            <!-- Email usuario -->
            <div class="flex items-center gap-2 text-indigo-200">
                <i class="fa-solid fa-circle-user text-xl"></i>
                <span class="text-sm font-medium">
                    {$_SESSION['email']}
                </span>
            </div>

            <!-- Botón salir -->
            <a href="cerrar.php"
               class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-200 shadow-md">
                <i class="fa-solid fa-right-from-bracket"></i>
                Salir
            </a>

        </div>

        </div>
    </nav>

    TXT;
}