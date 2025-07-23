<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Estadísticas exactas según el documento
        $totalCourses = Course::count();
        $totalStudents = User::where('role', 'student')->count();
        
        // Total de inscripciones por curso
        $coursesWithEnrollments = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalCourses', 
            'totalStudents', 
            'coursesWithEnrollments'
        ));
    }
}