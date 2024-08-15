<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">
    {{-- barra de navegacion --}}
    <!-- Navbar -->
    <nav class="bg-red-600 text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="https://www.zarla.com/images/zarla-la-nube-1x1-2400x2400-20210914-68gf7g9mttjxtc9yx7yc.png?crop=1:1,smart&width=250&dpr=2" alt="Logo" class="h-10 rounded-full"> <!-- Imagen del logo redondeada -->
            <h1 class="text-xl font-bold hidden md:block">E-commerce</h1> <!-- Nombre oculto en móviles -->
            {{-- <a href="#" class="text-xl font-bold hidden md:block">E-commerce</a> --}}
        </div>
        <div class="flex space-x-4">
            <button class="bg-yellow-400 text-white-500 font-semibold py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-300">Iniciar Sesión</button>
            <button class="bg-yellow-400 text-white-500 font-semibold py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-300">Crear Cuenta</button>
        </div>
    </nav>
    {{-- footer --}}
    
    {{-- menu lateral --}}
    @yield('content')
    <!-- Footer -->
    <footer class="bg-red-600 text-white text-center py-4">
        <p>© 2024 E-commerce. Todos los derechos reservados.</p>
    </footer>
</body>
</html>