@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
            <input type="password" id="password" name="password" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm text-gray-600">Recordarme</span>
            </label>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
            Iniciar Sesión
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="text-sm text-gray-600">
            ¿No tienes cuenta? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Regístrate aquí</a>
        </p>
    </div>

    <div class="mt-6 p-4 bg-gray-50 rounded">
        <h3 class="font-semibold text-sm mb-2">Credenciales de prueba:</h3>
        <p class="text-sm text-gray-600">
            <strong>Admin:</strong> admin@cursos.com / admin123
        </p>
    </div>
</div>
@endsection