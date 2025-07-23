@extends('layouts.app')

@section('title', 'Mi Dashboard')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Mis Cursos -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            <i class="fas fa-graduation-cap text-blue-600"></i> Mis Cursos
        </h2>
        
        @if($enrolledCourses->count() > 0)
            <div class="space-y-4">
                @foreach($enrolledCourses as $course)
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <h3 class="font-semibold text-lg">{{ $course->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($course->description, 100) }}</p>
                        <span class="text-xs text-green-600 font-medium">
                            <i class="fas fa-check-circle"></i> Inscrito
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-book-open text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Aún no estás inscrito en ningún curso.</p>
                <a href="{{ route('student.courses') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Explorar cursos disponibles
                </a>
            </div>
        @endif
    </div>

    <!-- Cursos Disponibles -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            <i class="fas fa-search text-green-600"></i> Cursos Disponibles
        </h2>
        
        @if($availableCourses->count() > 0)
            <div class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($availableCourses as $course)
                    <div class="border rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg">{{ $course->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($course->description, 80) }}</p>
                                <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded">
                                    {{ $course->enrollment_count }} inscritos
                                </span>
                            </div>
                            <form action="{{ route('student.enroll', $course) }}" method="POST" class="ml-4">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    <i class="fas fa-plus"></i> Inscribirse
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('student.courses') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Ver todos los cursos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-graduation-cap text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">No hay cursos disponibles por el momento.</p>
            </div>
        @endif
    </div>
</div>
@endsection