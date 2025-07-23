@extends('layouts.app')

@section('title', 'Gestión de Cursos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-list text-blue-600"></i> Gestión de Cursos
    </h1>
    <a href="{{ route('courses.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
        <i class="fas fa-plus"></i> Nuevo Curso
    </a>
</div>

@if($courses->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscripciones</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($course->thumbnail)
                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                 src="{{ $course->thumbnail_url }}" alt="{{ $course->name }}">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $course->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit($course->description, 80) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $course->enrollments_count }} estudiantes
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $course->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('courses.students', $course) }}" 
                                       class="text-green-600 hover:text-green-900" title="Ver estudiantes">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <a href="{{ route('courses.edit', $course) }}" 
                                       class="text-indigo-600 hover:text-indigo-900" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" 
                                          class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este curso?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
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
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $courses->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <i class="fas fa-book-open text-gray-400 text-6xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay cursos registrados</h3>
        <p class="text-gray-500 mb-6">Comienza creando tu primer curso.</p>
        <a href="{{ route('courses.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition">
            <i class="fas fa-plus"></i> Crear Primer Curso
        </a>
    </div>
@endif
@endsection