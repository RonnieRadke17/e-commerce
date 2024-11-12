<!-- resources/views/brands/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Marca</h1>

    <form action="{{ route('brands.update', Crypt::encryptString($brand->id)) }}" method="POST" class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        @include('brands.form')
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar Marca</button>
    </form>
</div>
@endsection
