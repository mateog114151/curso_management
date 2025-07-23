@extends('layouts.app')

@section('title', 'Crear Estudiante')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
  <h2 class="text-2xl font-bold text-center mb-6">Nuevo Estudiante</h2>

  <form action="{{ route('admin.students.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
      <input type="text" name="name" value="{{ old('name') }}" required
             class="w-full px-3 py-2 border rounded-md">
      @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required
             class="w-full px-3 py-2 border rounded-md">
      @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
      <input type="password" name="password" required
             class="w-full px-3 py-2 border rounded-md">
      @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
      <input type="password" name="password_confirmation" required
             class="w-full px-3 py-2 border rounded-md">
    </div>

    <div class="flex justify-between">
      <a href="{{ route('admin.students.index') }}"
         class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
      <button type="submit"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
        <i class="fas fa-save"></i> Crear
      </button>
    </div>
  </form>
</div>
@endsection
