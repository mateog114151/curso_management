<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Dashboard del estudiante
    public function dashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->courses()->with('enrollments')->get();
        $availableCourses = Course::whereNotIn('id', $user->courses->pluck('id'))->get();
        
        return view('student.dashboard', compact('enrolledCourses', 'availableCourses'));
    }

    // Ver cursos disponibles
    public function courses()
    {
        $user = Auth::user();
        $courses = Course::with('enrollments')->get();
        
        return view('student.courses', compact('courses', 'user'));
    }

    // Inscribirse a un curso
    public function enroll(Course $course)
    {
        $user = Auth::user();
        
        // Verificar si ya está inscrito
        if ($user->isEnrolledIn($course->id)) {
            return back()->with('error', 'Ya estás inscrito en este curso.');
        }

        // Crear inscripción
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return back()->with('success', '¡Te has inscrito exitosamente al curso: ' . $course->name);
    }
}