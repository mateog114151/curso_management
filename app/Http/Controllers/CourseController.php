<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Listar cursos (página de administración).
     */
    public function index()
    {
        $courses = Course::withCount('enrollments')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Mostrar formulario de creación de curso.
     */
    public function create()
    {
        // Sólo devolvemos la vista del formulario
        return view('admin.courses.create');
    }

    /**
     * Guardar un curso nuevo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                                      ->store('thumbnails', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')
                         ->with('success', 'Curso creado exitosamente.');
    }

    /**
     * Mostrar formulario de edición de un curso.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Actualizar un curso existente.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('thumbnail')) {
            // Eliminar miniatura anterior si existe
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')
                                      ->store('thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')
                         ->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Eliminar un curso.
     */
    public function destroy(Course $course)
    {
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();

        return redirect()->route('courses.index')
                         ->with('success', 'Curso eliminado exitosamente.');
    }

    /**
     * Ver estudiantes inscritos en un curso.
     */
    public function students(Course $course)
    {
        $students = $course->students()->withPivot('created_at')->get();
        return view('admin.courses.students', compact('course', 'students'));
    }
}
