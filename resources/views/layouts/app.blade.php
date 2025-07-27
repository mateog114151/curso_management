<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Sistema de Cursos</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Opcional: Plugin DataLabels para Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-6">
        <h1 class="text-xl font-bold">
          <a href="{{
            Auth::check()
              ? (Auth::user()->isAdmin()
                  ? route('admin.dashboard')
                  : route('student.dashboard'))
              : route('login')
          }}">
            Sistema de Cursos
          </a>
        </h1>
        @auth
          <a href="{{
            Auth::user()->isAdmin()
              ? route('admin.dashboard')
              : route('student.dashboard')
          }}"
             class="hover:text-gray-200">
            <i class="fas fa-home"></i> Inicio
          </a>
        @endauth
      </div>

      @auth
        <div class="flex items-center space-x-4">
          <span>Hola, {{ Auth::user()->name }}</span>
          <span class="text-sm bg-blue-700 px-2 py-1 rounded">
            {{ Auth::user()->isAdmin() ? 'Administrador' : 'Estudiante' }}
          </span>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">
              <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
          </form>
        </div>
      @endauth
    </div>
  </nav>

  <main class="container mx-auto mt-8 px-4">
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    @yield('content')
  </main>

  <!-- Aquí inyectamos los scripts de cada vista -->
  @stack('scripts')
</body>
</html>
