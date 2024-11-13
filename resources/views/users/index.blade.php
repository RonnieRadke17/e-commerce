@extends('layouts.app')
@section('title','Productos | E-commerce')
@section('content')

<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Lista de Usuarios</h2>

<a href="{{ route('users.create')}}">crear</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Email</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Rol</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Suspendido</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b text-gray-800">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b text-gray-800">{{ $user->role->name ?? 'Sin rol' }}</td>
                        <td class="py-2 px-4 border-b text-gray-800">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-sm font-medium {{ $user->is_suspended ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                                {{ $user->is_suspended ? 'Sí' : 'No' }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b text-gray-800">
                            <div class="flex space-x-2">
                                <a href="{{ route('users.show', Crypt::encryptString($user->id))}}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', Crypt::encryptString($user->id)) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('users.destroy', Crypt::encryptString($user->id)) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Enlaces de paginación -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

@endsection
