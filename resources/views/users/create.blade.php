<!-- resources/views/users/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Crear Usuario</h2>

    <form action="{{ route('users.store') }}" method="POST" class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        @csrf
        @include('users.form', ['user' => null, 'roles' => $roles])
        
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Guardar Usuario
            </button>
        </div>
    </form>
</div>
@endsection
