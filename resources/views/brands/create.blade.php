<!-- resources/views/brands/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Nueva Marca</h1>
    
    <form action="{{ route('brands.store') }}" method="POST" class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        @csrf
        @include('brands.form')
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Marca</button>
    </form>
</div>
@endsection
