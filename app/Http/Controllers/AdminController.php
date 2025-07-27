<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalStudents = DB::table('users')
                           ->where('role', 'student')
                           ->count();
        $coursesWithEnrollments = Course::withCount('enrollments')->get();

        // Preparamos los datos para Chart.js
        $chartLabels = $coursesWithEnrollments->pluck('name');
        $chartData   = $coursesWithEnrollments->pluck('enrollments_count');

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalStudents',
            'coursesWithEnrollments',
            'chartLabels',
            'chartData'
        ));
    }
}
