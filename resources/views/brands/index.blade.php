<!-- resources/views/brands/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Marcas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('brands.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Marca</a>
    </div>

    <table class="min-w-full bg-white border rounded-lg shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Categoría</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td class="px-4 py-2 border">{{ $brand->id }}</td>
                <td class="px-4 py-2 border">{{ $brand->name }}</td>
                <td class="px-4 py-2 border">{{ $brand->category->name }}</td>
                <td class="px-4 py-2 border flex space-x-2">
                    <a href="{{ route('brands.show', Crypt::encryptString($brand->id)) }}" class="text-blue-500">Ver</a>
                    <a href="{{ route('brands.edit', Crypt::encryptString($brand->id)) }}" class="text-yellow-500">Editar</a>
                    <form action="{{ route('brands.destroy', Crypt::encryptString($brand->id)) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta marca?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
