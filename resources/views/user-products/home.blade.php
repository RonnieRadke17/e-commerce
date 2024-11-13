@extends('layouts.app')
@section('title','Productos | E-commerce')
@section('content')
<main class="p-8 flex-grow relative">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-y-10">
        <!-- Card 1 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
            <img class="w-full h-48 object-contain" src="https://www.soriana.com/dw/image/v2/BGBD_PRD/on/demandware.static/-/Sites-soriana-grocery-master-catalog/default/dwaccc2595/images/product/7501011167681_A.jpg?sw=445&sh=445&sm=fit" alt="Producto 1">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Ruffles</h3>
                <p class="text-gray-600">Descripción del producto 1.</p>
                @if (Auth::check() && Auth::user()->role->name === 'admin')
                    <!-- Botón de editar -->
                    <button class="absolute top-2 right-2 bg-blue-200 text-white p-2 rounded-full shadow hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                @endif
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
            <img class="w-full h-48 object-contain" src="https://cdn2.excelsior.com.mx/800x600/filters:format(jpg):quality(75)/media/pictures/2022/05/20/2760623.jpg" alt="Producto 2">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Skittles</h3>
                <p class="text-gray-600">Descripción del producto 2.</p>
                <!-- Botón de editar -->
                <button class="absolute top-2 right-2 bg-blue-200 text-white p-2 rounded-full shadow hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
            <img class="w-full h-48 object-contain" src="https://i5.walmartimages.com.mx/gr/images/product-images/img_large/00750101111559L1.jpg?odnHeight=612&odnWidth=612&odnBg=FFFFFF" alt="Producto 3">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Producto 3</h3>
                <p class="text-gray-600">Descripción del producto 3.</p>
                <!-- Botón de editar -->
                <button class="absolute top-2 right-2 bg-blue-200 text-white p-2 rounded-full shadow hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>

        <!-- Card 1 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
            <img class="w-full h-48 object-contain" src="https://dulcealcance.com/cdn/shop/products/CopiadeLIVERPOOLFOTOS-2023-03-11T115655.612_460x@2x.png?v=1678561331" alt="Producto 1">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Monster Ultra Paradise</h3>
                <p class="text-gray-600">Bebida energética sin azúcar 473ml</p>
                <!-- Botón de editar -->
                <button class="absolute top-2 right-2 bg-blue-200 text-white p-2 rounded-full shadow hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
            <img class="w-full h-48 object-contain" src="https://cdn2.excelsior.com.mx/800x600/filters:format(jpg):quality(75)/media/pictures/2022/05/20/2760623.jpg" alt="Producto 2">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Skittles</h3>
                <p class="text-gray-600">Descripción del producto 2.</p>
                <!-- Botón de editar -->
                <button class="absolute top-2 right-2 bg-blue-200 text-white p-2 rounded-full shadow hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden relative">
            <img class="w-full h-48 object-contain" src="https://i5.walmartimages.com.mx/gr/images/product-images/img_large/00750101111559L1.jpg?odnHeight=612&odnWidth=612&odnBg=FFFFFF" alt="Producto 3">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Producto 3</h3>
                <p class="text-gray-600">Descripción del producto 3.</p>
                <!-- Botón de editar -->
                <button class="absolute top-2 right-2 bg-blue-200 text-white p-2 rounded-full shadow hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>


        @if (Auth::check() && Auth::user()->role->name === 'admin')
            <button class="fixed bottom-8 right-8 bg-yellow-400 text-white w-16 h-16 rounded-full shadow-lg hover:bg-yellow-500 transition duration-300 flex items-center justify-center">
                <a href="{{ route('products.create') }}" class="fas fa-plus text-white text-2xl"></a>
            </button>
        @endif


</main>
 
@endsection