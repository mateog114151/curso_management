@extends('layouts.app')

@section('title', 'Cursos Disponibles')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-book text-blue-600"></i> Catálogo de Cursos
    </h1>
    <p class="text-gray-600">Explora y inscríbete en los cursos que más te interesen</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <!-- Imagen del curso -->
            <div class="h-48 bg-gray-200 relative">
                @if($course->thumbnail)
                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-book-open text-gray-400 text-4xl"></i>
                    </div>
                @endif
                
                <!-- Badge de inscripción -->
                @if($user->isEnrolledIn($course->id))
                    <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-xs font-medium">
                        <i class="fas fa-check"></i> Inscrito
                    </div>
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $course->name }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 120) }}</p>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-blue-600 bg-blue-100 px-2 py-1 rounded">
                        <i class="fas fa-users"></i> {{ $course->enrollment_count }} estudiantes
                    </span>
                    
                    @if($user->isEnrolledIn($course->id))
                        <span class="text-green-600 font-medium text-sm">
                            <i class="fas fa-graduation-cap"></i> Ya inscrito
                        </span>
                    @else
                        <form action="{{ route('student.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition">
                                <i class="fas fa-plus"></i> Inscribirse
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-book-open text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay cursos disponibles</h3>
            <p class="text-gray-500">Los cursos aparecerán aquí cuando estén disponibles.</p>
        </div>
    @endforelse
</div>
@endsection