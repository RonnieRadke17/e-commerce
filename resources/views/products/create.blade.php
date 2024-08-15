@extends('layouts.app')
@section('title','Productos')
@section('content')
<br>
<form class="max-w-3xl mx-auto p-8 bg-gray-100 shadow-md rounded-lg" action="{{route('products.store')}}">
    <!-- Nombre -->
    <div class="mb-6">
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre del Producto:</label>
        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <!-- Descripción -->
    <div class="mb-6">
        <label for="description" class="block text-gray-700 font-semibold mb-2">Descripción:</label>
        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
    </div>

    <!-- Stock y Precio (en la misma línea en pantallas grandes) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Stock -->
        <div>
            <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock:</label>
            <input type="number" id="stock" name="stock" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Precio -->
        <div>
            <label for="price" class="block text-gray-700 font-semibold mb-2">Precio:</label>
            <input type="number" step="0.01" id="price" name="price" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
    </div>

    <!-- Categoría -->
    <div class="mb-6">
        <label for="category_id" class="block text-gray-700 font-semibold mb-2">Categoría:</label>
        <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="">Selecciona una categoría</option>
            <option value="1">Bebidas</option>
            <option value="2">Dulces</option>
            <option value="3">Botanas</option>
            <option value="4">Galletas</option>
        </select>
    </div>

    <!-- Imágenes -->
    <div class="mb-6">
        <label for="images" class="block text-gray-700 font-semibold mb-2">Imágenes del Producto:</label>
        <div class="flex items-center justify-center w-full">
            <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 group">
                <div class="flex flex-col items-center justify-center pt-7">
                    <svg class="w-10 h-10 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0l-4 4m4-4l4 4M17 16V4m0 0l-4 4m4-4l4 4m-4-4v12a2 2 0 001 1.73V21m0-5.27A2 2 0 0117 19V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 001 1.73V21m-4-5.27A2 2 0 015 19V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 001 1.73V21"></path></svg>
                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Arrastra las imágenes o haz click aquí</p>
                </div>
                <input type="file" id="images" name="images[]" multiple class="opacity-0" accept="image/*">
            </label>
        </div>
    </div>

    <!-- Botón Enviar -->
    <div class="mb-6">
        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Agregar Producto</button>
    </div>
</form>

@endsection