@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Detalles del Usuario</h2>

    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Nombre:</label>
            <p class="text-gray-700">{{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Apellidos:</label>
            <p class="text-gray-700">{{ $user->paternal }} {{ $user->maternal }}</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Fecha de Nacimiento:</label>
            <p class="text-gray-700">{{ $user->birthdate }}</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Género:</label>
            <p class="text-gray-700">{{ ucfirst($user->gender) }}</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Correo Electrónico:</label>
            <p class="text-gray-700">{{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Contraseña:</label>
            <p class="text-gray-700">********</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Estado:</label>
            <p class="text-gray-700">{{ $user->is_suspended ? 'Suspendido' : 'Activo' }}</p>
        </div>

        <div class="mb-4">
            <label class="text-gray-600 font-semibold">Rol:</label>
            <p class="text-gray-700">{{ $user->role->name }}</p>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('users.edit', Crypt::encryptString($user->id)) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-edit mr-2"></i> Editar
            </a>
        </div>
    </div>
</div>
@endsection
