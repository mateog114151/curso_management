@extends('layouts.app')

@section('title', 'Gestión de Estudiantes')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-3xl font-bold text-gray-800">
    <i class="fas fa-user-graduate text-blue-600"></i>
    Estudiantes
  </h1>
  <a href="{{ route('admin.students.create') }}"
     class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
    <i class="fas fa-plus"></i> Nuevo Estudiante
  </a>
</div>

@if($students->count())
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach($students as $student)
          <tr>
            <td class="px-6 py-4">{{ $student->name }}</td>
            <td class="px-6 py-4">{{ $student->email }}</td>
            <td class="px-6 py-4 flex space-x-2">
              <a href="{{ route('admin.students.edit',$student) }}"
                 class="text-indigo-600 hover:text-indigo-900">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('admin.students.destroy',$student) }}"
                    method="POST"
                    onsubmit="return confirm('¿Eliminar estudiante?');">
                @csrf @method('DELETE')
                <button class="text-red-600 hover:text-red-900">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-4">{{ $students->links() }}</div>
@else
  <div class="text-center py-12">
    <i class="fas fa-user-graduate text-gray-400 text-6xl mb-4"></i>
    <p class="text-gray-600">No hay estudiantes registrados.</p>
  </div>
@endif
@endsection

