@extends('layouts.app')

@section('title', 'Panel Administrativo')

@section('content')
  <div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
      <i class="fas fa-chart-bar text-blue-600"></i> Panel Administrativo
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
          <p class="text-3xl font-bold text-purple-600">
            {{ $coursesWithEnrollments->sum('enrollments_count') }}
          </p>
        </div>
        <div class="bg-purple-100 p-3 rounded-full">
          <i class="fas fa-graduation-cap text-purple-600 text-2xl"></i>
        </div>
      </div>
    </div>
  </div>

  {{-- Acciones rápidas --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-plus-circle text-green-600"></i> Acciones Rápidas
      </h2>
      <div class="space-y-3">
        <a href="{{ route('courses.create') }}"
           class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded">
          <i class="fas fa-plus"></i> Crear Nuevo Curso
        </a>
        <a href="{{ route('courses.index') }}"
           class="block w-full bg-gray-500 hover:bg-gray-600 text-white text-center py-2 px-4 rounded">
          <i class="fas fa-list"></i> Gestionar Cursos
        </a>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-user-graduate text-blue-600"></i> Estudiantes
      </h2>
      <div class="space-y-3">
        <a href="{{ route('admin.students.index') }}"
           class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 px-4 rounded">
          <i class="fas fa-list"></i> Ver Estudiantes
        </a>
        <a href="{{ route('admin.students.create') }}"
           class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded">
          <i class="fas fa-plus-circle"></i> Añadir Estudiante
        </a>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-info-circle text-blue-600"></i> Información del Sistema
      </h2>
      <div class="text-sm space-y-2">
        <p><strong>Versión de Laravel:</strong> {{ app()->version() }}</p>
        <p><strong>Última actualización:</strong> Hoy</p>
        <p><strong>Estado:</strong>
          <span class="text-green-600 font-semibold">Activo</span>
        </p>
      </div>
    </div>
  </div>

  {{-- Gráfica de inscripciones --}}
  <div class="bg-white rounded-lg shadow-md p-6 mt-8 h-80">
    <h2 class="text-xl font-semibold mb-4">
      <i class="fas fa-chart-bar text-blue-600"></i> Inscripciones por Curso
    </h2>
    <canvas id="enrollmentChart" class="w-full h-full"></canvas>
  </div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  if (Chart.register) {
    Chart.register(ChartDataLabels);
  }

  const canvas = document.getElementById('enrollmentChart');
  const ctx = canvas.getContext('2d');

  // Gradiente azul para las barras
  const grad = ctx.createLinearGradient(0, 0, 0, canvas.height);
  grad.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
  grad.addColorStop(1, 'rgba(59, 130, 246, 0.2)');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($chartLabels),
      datasets: [{
        label: 'Inscripciones',
        data: @json($chartData),
        backgroundColor: grad,
        borderColor: 'rgba(59, 130, 246, 1)',
        borderWidth: 1,
        borderRadius: 8,
        barPercentage: 0.6,
        categoryPercentage: 0.5,
        hoverBackgroundColor: 'rgba(59, 130, 246, 1)'
      }]
    },
    options: {
      maintainAspectRatio: false,
      animation: {
        duration: 1200,
        easing: 'easeOutBounce'
      },
      layout: {
        padding: { top: 20, bottom: 8, left: 0, right: 0 }
      },
      scales: {
        x: {
          grid: { display: false },
          title: {
            display: true,
            text: 'Cursos',
            color: '#374151',
            font: { size: 14, weight: '600' }
          },
          ticks: { color: '#4B5563' }
        },
        y: {
          grid: {
            color: 'rgba(203, 213, 225, 0.5)',
            borderDash: [4, 4]
          },
          title: {
            display: true,
            text: 'Cantidad de estudiantes',
            color: '#374151',
            font: { size: 14, weight: '600' }
          },
          ticks: {
            color: '#4B5563',
            beginAtZero: true,
            stepSize: 1
          },
          suggestedMax: 3 // 👈 Aquí se da más espacio visual para que se vea el número 2
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(31, 41, 55, 0.9)',
          titleColor: '#FFFFFF',
          bodyColor: '#F3F4F6',
          padding: 12,
          cornerRadius: 4,
          callbacks: {
            label: (ctx) => `${ctx.parsed.y} inscritos`
          }
        },
        datalabels: {
          color: '#1F2937',
          anchor: 'end',
          align: 'end',
          font: { weight: 'bold' },
          formatter: v => v
        },
        title: {
          display: true,
          text: 'Inscripciones por curso',
          color: '#1F2937',
          font: { size: 18, weight: '700' }
        }
      }
    }
  });
});
</script>
@endpush