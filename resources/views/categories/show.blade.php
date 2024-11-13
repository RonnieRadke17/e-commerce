<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detalles de la Categoría</h1>

    <div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Nombre:</strong> {{ $category->name }}</p>
        <p><strong>Descripción:</strong> {{ $category->description }}</p>

        <div class="mt-4 flex space-x-4">
            <a href="{{ route('categories.edit', $category) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
