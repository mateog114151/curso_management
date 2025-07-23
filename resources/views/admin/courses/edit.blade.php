@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-edit text-blue-600"></i> Editar Curso
        </h1>
        <p class="text-gray-600">Modifica la información del curso "{{ $course->name }}"</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del Curso <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $course->name) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                    Miniatura del Curso
                </label>
                
                @if($course->thumbnail)
                    <div class="mb-3">
                        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->name }}" 
                             class="w-32 h-24 object-cover rounded border">
                        <p class="text-sm text-gray-500 mt-1">Imagen actual</p>
                    </div>
                @endif
                
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Formatos permitidos: JPEG, PNG, JPG, GIF. Máximo 2MB. Dejar vacío para mantener la imagen actual.</p>
                @error('thumbnail')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('courses.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md transition">
                    <i class="fas fa-save"></i> Actualizar Curso
                </button>
            </div>
        </form>
    </div>
</div>
@endsection