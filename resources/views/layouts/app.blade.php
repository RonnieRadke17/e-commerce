<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css') 
    @yield('head')
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos para asegurar que el footer se quede en la parte inferior */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el contenido ocupe al menos el alto de la pantalla */
        }

        .content-wrapper {
            flex: 1; /* Permite que este contenedor se expanda para ocupar el espacio disponible */
            display: flex;
            flex-direction: column;
        }

        /* Estilos personalizados para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #FFFFFF;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            animation: fadeIn 0.5s;
            border-left: 4px solid #FF4500; /* Borde rojo anaranjado */
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .close-button {
            color: #888;
            float: right;
            font-size: 24px;
            cursor: pointer;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #FF6347; /* Rojo anaranjado */
        }

        .modal-body {
            margin-top: 10px;
            font-size: 1rem;
            color: #333;
        }

        /* Estilos para la barra de navegación */
        .navbar {
            background-color: #FF4500; /* Rojo anaranjado */
        }

        .navbar a {
            color: #FFFFFF;
            padding: 10px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #FF6347; /* Rojo más claro */
        }

        /* Estilo para el pie de página */
        footer {
            background-color: #FF4500; /* Rojo anaranjado */
            color: #FFFFFF;
            padding: 15px 0;
        }

        footer a {
            color: #FFB586; /* Naranja claro */
            text-decoration: none;
        }

        footer a:hover {
            color: #FFFFFF;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Contenedor principal que asegura que el contenido se ajuste correctamente -->
    <div class="content-wrapper">
        <!-- Barra de Navegación -->
        <nav class="bg-red-600 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                <!-- Logo y Título con Hipervínculo -->
                <div class="flex items-center space-x-4">
                    <img src="https://www.zarla.com/images/zarla-la-nube-1x1-2400x2400-20210914-68gf7g9mttjxtc9yx7yc.png?crop=1:1,smart&width=250&dpr=2" alt="Logo" class="h-10 rounded-full">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-white hover:text-gray-200">E-COMMERCE</a>
                </div>
                <div class="relative">
                    @auth
                        <button type="button" class="bg-red-500 hover:bg-red-400 flex items-center justify-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white p-1" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="bg-white rounded-full p-1">
                                <img class="h-8 w-8 rounded-full" src="{{ asset('images/user.png') }}" alt="">
                            </div>
                        </button>
                    @endauth
                    @guest
                        <div class="flex space-x-4">
                            <a href="{{ route('login') }}" class="bg-white text-red-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="bg-white text-red-600 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Menú Lateral -->
        <div class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-40" id="lateral-menu-overlay"></div>
        <div class="hidden fixed inset-y-0 right-0 w-64 bg-white shadow-lg z-50" id="lateral-menu">
            <div class="py-4 px-6">
                <div class="w-full bg-red-100 p-4 rounded-lg flex flex-col items-center">
                    <img class="h-16 w-16 rounded-full" src="{{ asset('/images/user.png') }}" alt="User profile picture">
                    
                    <span class="mt-2 font-bold text-red-900">
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    </span>
                </div>

                <div class="mt-4 border-t border-gray-200 pt-4">
                    <a href="https://dashboard.stripe.com/test/payments" target="_blank" class="text-gray-600 hover:bg-red-100 hover:text-red-700 block px-3 py-2 rounded-md text-base font-medium">Transacciones</a>
                    <a href="#" class="text-gray-600 hover:bg-red-100 hover:text-red-700 block px-3 py-2 rounded-md text-base font-medium">Users</a>
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:bg-red-100 hover:text-red-700 block px-3 py-2 rounded-md text-base font-medium">Salir</a>
                </div>
            </div>
        </div>

        <!-- Modal de Éxito -->
        @if(session('success'))
            <div id="successModal" class="modal flex">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">¡Éxito!</span>
                        <span class="close-button" id="closeModal">&times;</span>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>       
        @endif

        <!-- Contenido de la página -->
        <div class="flex-grow">
            @yield('content')
        </div>
    </div>

    <!-- Footer  aqui le tiene que mover angel-->
    <footer class="bg-red-600 text-white text-center py-4">
        <p>&copy; © 2024 E-commerce. Todos los derechos reservados.</p>
        <div class="mt-2">
            <a href="#" class="text-gray-300 hover:text-red-400 mx-2">Política de Privacidad</a>
            <a href="#" class="text-gray-300 hover:text-red-400 mx-2">Términos y Condiciones</a>
        </div>
    </footer>

    <script>
    // Función para mostrar el modal de éxito
    function showModal() {
        var modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    // Función para cerrar el modal
    function closeModal() {
        var modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Evento para mostrar el modal cuando se cargue la página
    document.addEventListener('DOMContentLoaded', function() {
        showModal();

        // Agregar evento al botón de cerrar
        var closeButton = document.getElementById('closeModal');
        if (closeButton) {
            closeButton.addEventListener('click', closeModal);
        }

        // Cerrar el modal al hacer clic fuera del contenido
        window.addEventListener('click', function(e) {
            var modal = document.getElementById('successModal');
            if (e.target == modal) {
                closeModal();
            }
        });

        // Mostrar/Ocultar el menú lateral
        document.getElementById('user-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('lateral-menu');
            var overlay = document.getElementById('lateral-menu-overlay');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                overlay.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
                overlay.classList.add('hidden');
            }
        });

        // Cerrar el menú lateral al hacer clic en el overlay
        document.getElementById('lateral-menu-overlay').addEventListener('click', function() {
            var menu = document.getElementById('lateral-menu');
            var overlay = document.getElementById('lateral-menu-overlay');
            menu.classList.add('hidden');
            overlay.classList.add('hidden');
        });
    });
    </script>
</body>
</html>
