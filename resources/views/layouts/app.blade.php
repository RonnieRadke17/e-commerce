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
                    <a href="{{ route('home') }}" class="text-xl font-bold text-white hover:text-gray-200">DULCES POTROS</a>
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
                    <a href="#" class="text-gray-600 hover:bg-red-100 hover:text-red-700 block px-3 py-2 rounded-md text-base font-medium">Calendar</a>
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
        <div class="contact flex justify-center items-center space-x-4 text-gray-300">
    <a href="https://facebook.com" class="hover:text-red-400" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-6 h-6">
            <path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"></path>
        </svg>
    </a>

    <a href="https://instagram.com" class="hover:text-red-400" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="w-6 h-6">
            <path d="M 9.9980469 3 C 6.1390469 3 3 6.1419531 3 10.001953 L 3 20.001953 C 3 23.860953 6.1419531 27 10.001953 27 L 20.001953 27 C 23.860953 27 27 23.858047 27 19.998047 L 27 9.9980469 C 27 6.1390469 23.858047 3 19.998047 3 L 9.9980469 3 z M 22 7 C 22.552 7 23 7.448 23 8 C 23 8.552 22.552 9 22 9 C 21.448 9 21 8.552 21 8 C 21 7.448 21.448 7 22 7 z M 15 9 C 18.309 9 21 11.691 21 15 C 21 18.309 18.309 21 15 21 C 11.691 21 9 18.309 9 15 C 9 11.691 11.691 9 15 9 z M 15 11 A 4 4 0 0 0 11 15 A 4 4 0 0 0 15 19 A 4 4 0 0 0 19 15 A 4 4 0 0 0 15 11 z"></path>
        </svg>
    </a>

    <a href="https://twitter.com" class="hover:text-red-400" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="w-6 h-6">
            <path d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z"></path>
        </svg>
    </a>

    <a href="https://www.tiktok.com/es/" class="hover:text-red-400" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="w-6 h-6">
            <path d="M24,4H6C4.895,4,4,4.895,4,6v18c0,1.105,0.895,2,2,2h18c1.105,0,2-0.895,2-2V6C26,4.895,25.104,4,24,4z M22.689,13.474 c-0.13,0.012-0.261,0.02-0.393,0.02c-1.495,0-2.809-0.768-3.574-1.931c0,3.049,0,6.519,0,6.577c0,2.685-2.177,4.861-4.861,4.861 C11.177,23,9,20.823,9,18.139c0-2.685,2.177-4.861,4.861-4.861c0.102,0,0.201,0.009,0.3,0.015v2.396c-0.1-0.012-0.197-0.03-0.3-0.03 c-1.37,0-2.481,1.111-2.481,2.481s1.11,2.481,2.481,2.481c1.371,0,2.581-1.08,2.581-2.45c0-0.055,0.024-11.17,0.024-11.17h2.289 c0.215,2.047,1.868,3.663,3.934,3.811V13.474z"></path>
        </svg>
    </a>
</div>

<br>

<div class="map">
    <a href="https://maps.app.goo.gl/Kv4yeAkoP3qVTPNS8" class="inline-flex items-center text-gray-300 hover:text-red-400 space-x-1" target="_blank">
        <p>Visítanos aquí:</p>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
        </svg>
    </a>
</div>


<div class="supportme">
    <a href="https://wa.link/wr5tov" class="flex justify-center items-center text-gray-300 hover:text-red-400 mx-2" target="_blank">
        <p>Contactanos: +52 55 12345678</p>
    </a>

</div>

        </div>
        <p>&copy;  2024 E-commerce. Todos los derechos reservados.</p>
        <div class="mt-2">
            <a href="#" class="text-gray-300 hover:text-red-400 mx-2">Política de Privacidad</a>
            <a href="#" class="text-gray-300 hover:text-red-400 mx-2">Términos y Condiciones</a>
        </div>
    </footer>

    <script>
        // Funciones para mostrar y cerrar el modal
        // Mantiene la funcionalidad JS como estaba
    </script>
</body>
</html>
