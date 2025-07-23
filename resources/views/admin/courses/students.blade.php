@extends('layouts.app')

@section('title', 'Estudiantes del Curso')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-users text-green-600"></i> Estudiantes Inscritos
            </h1>
            <p class="text-gray-600">Curso: <span class="font-semibold">{{ $course->name }}</span></p>
        </div>
        <a href="{{ route('courses.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-arrow-left"></i> Volver a Cursos
        </a>
    </div>
</div>

<!-- Información del curso -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <h3 class="text-sm font-medium text-gray-500">Total de Estudiantes</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $students->count() }}</p>
        </div>
        <div>
            <h3 class="text-sm font-medium text-gray-500">Fecha de Creación</h3>
            <p class="text-lg text-gray-900">{{ $course->created_at->format('d/m/Y') }}</p>
        </div>
        <div>
            <h3 class="text-sm font-medium text-gray-500">Estado</h3>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <i class="fas fa-check-circle mr-1"></i> Activo
            </span>
        </div>
    </div>
</div>

@if($students->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudiante</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Inscripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $student->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($student->pivot->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-graduation-cap mr-1"></i> Inscrito
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <i class="fas fa-users text-gray-400 text-6xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay estudiantes inscritos</h3>
        <p class="text-gray-500">Este curso aún no tiene estudiantes inscritos.</p>
    </div>
@endif
@endsection