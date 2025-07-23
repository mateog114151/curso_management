@extends('layouts.app')

@section('title', 'Panel Administrativo')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-chart-bar text-blue-600"></i>
        Panel Administrativo
    </h1>
    <p class="text-gray-600">Resumen y estadísticas del sistema</p>
</div>

{{-- Estadísticas principales --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    {{-- Total de Cursos --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total de Cursos</p>
                <p class="text-3xl font-bold text-blue-600">{{ $totalCourses }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-book text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    {{-- Total de Estudiantes --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total de Estudiantes</p>
                <p class="text-3xl font-bold text-green-600">{{ $totalStudents }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-user-graduate text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    {{-- Total de Inscripciones --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total de Inscripciones</p>
                <p class="text-3xl font-bold text-purple-600">{{ $coursesWithEnrollments->sum('enrollments_count') }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-graduation-cap text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

{{-- Acciones rápidas --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Cursos --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">
            <i class="fas fa-plus-circle text-green-600"></i> Acciones Rápidas
        </h2>
        <div class="space-y-3">
            <a href="{{ route('courses.create') }}"
               class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded transition">
                <i class="fas fa-plus"></i> Crear Nuevo Curso
            </a>
            <a href="{{ route('courses.index') }}"
               class="block w-full bg-gray-500 hover:bg-gray-600 text-white text-center py-2 px-4 rounded transition">
                <i class="fas fa-list"></i> Gestionar Cursos
            </a>
        </div>
    </div>

    {{-- Estudiantes --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">
            <i class="fas fa-user-graduate text-blue-600"></i> Estudiantes
        </h2>
        <div class="space-y-3">
            <a href="{{ route('admin.students.index') }}"
               class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 px-4 rounded transition">
                <i class="fas fa-list"></i> Ver Estudiantes
            </a>
            <a href="{{ route('admin.students.create') }}"
               class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded transition">
                <i class="fas fa-plus-circle"></i> Añadir Estudiante
            </a>
        </div>
    </div>

    {{-- Info Sistema --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">
            <i class="fas fa-info-circle text-blue-600"></i> Información del Sistema
        </h2>
        <div class="text-sm space-y-2">
            <p><strong>Versión de Laravel:</strong> {{ app()->version() }}</p>
            <p><strong>Última actualización:</strong> Hoy</p>
            <p><strong>Estado:</strong> <span class="text-green-600 font-semibold">Activo</span></p>
        </div>
    </div>
</div>

{{-- Inscripciones por curso --}}
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-chart-pie text-purple-600"></i> Inscripciones por Curso
    </h2>
    @if($coursesWithEnrollments->count() > 0)
        {{-- tabla... --}}
    @else
        <div class="text-center py-8">
            <i class="fas fa-chart-bar text-gray-400 text-4xl mb-4"></i>
            <p class="text-gray-500">No hay datos de inscripciones disponibles.</p>
        </div>
    @endif
</div>
@endsection
