<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminStudentController; // <-- NUEVO

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas
Route::get('/', fn() => redirect()->route('login'));

// Autenticación
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// Estudiante
Route::middleware(['auth','student'])->group(function(){
    Route::get('/student/dashboard', [StudentController::class,'dashboard'])->name('student.dashboard');
    Route::get('/student/courses',   [StudentController::class,'courses'])->name('student.courses');
    Route::post('/student/enroll/{course}', [StudentController::class,'enroll'])->name('student.enroll');
});

// Administrador
Route::middleware(['auth','admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::resource('courses', CourseController::class)->except(['show']);
    Route::get('courses/{course}/students', [CourseController::class,'students'])->name('courses.students');

    // Rutas para estudiantes (CRUD)
    Route::get('students',           [AdminStudentController::class,'index'])->name('admin.students.index');
    Route::get('students/create',    [AdminStudentController::class,'create'])->name('admin.students.create');
    Route::post('students',          [AdminStudentController::class,'store'])->name('admin.students.store');
    Route::get('students/{user}/edit',[AdminStudentController::class,'edit'])->name('admin.students.edit');
    Route::put('students/{user}',    [AdminStudentController::class,'update'])->name('admin.students.update');
    Route::delete('students/{user}', [AdminStudentController::class,'destroy'])->name('admin.students.destroy');
});
