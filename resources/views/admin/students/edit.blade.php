@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
  <h2 class="text-2xl font-bold text-center mb-6">Editar Estudiante</h2>

  <form action="{{ route('admin.students.update',$user) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
      <input type="text" name="name" value="{{ old('name',$user->name) }}" required
             class="w-full px-3 py-2 border rounded-md">
      @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email',$user->email) }}" required
             class="w-full px-3 py-2 border rounded-md">
      @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña (opcional)</label>
      <input type="password" name="password"
             class="w-full px-3 py-2 border rounded-md">
      @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
      <input type="password" name="password_confirmation"
             class="w-full px-3 py-2 border rounded-md">
    </div>

    <div class="flex justify-between">
      <a href="{{ route('admin.students.index') }}"
         class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
      <button type="submit"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        <i class="fas fa-save"></i> Guardar
      </button>
    </div>
  </form>
</div>
@endsection
