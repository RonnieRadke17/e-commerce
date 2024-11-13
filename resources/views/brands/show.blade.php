<!-- resources/views/brands/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detalles de la Marca</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <p><strong>Nombre:</strong> {{ $brand->name }}</p>
        <p><strong>Categoría:</strong> {{ $brand->category->name }}</p>
        <a href="{{ route('brands.index') }}" class="text-blue-500">Volver a la lista de marcas</a>
    </div>
</div>
@endsection
