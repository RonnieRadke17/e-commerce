<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Editar Usuario</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        
        @include('users.form', ['user' => $user, 'roles' => $roles]) <!-- Incluye el formulario -->
        
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                Actualizar Usuario
            </button>
        </div>
    </form>
</div>
@endsection
