<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    // Listar todos los estudiantes
    public function index()
    {
        $students = User::where('role','student')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    // Mostrar formulario para crear estudiante
    public function create()
    {
        return view('admin.students.create');
    }

    // Guardar nuevo estudiante
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
        ]);

        return redirect()->route('admin.students.index')
                         ->with('success','Estudiante creado exitosamente.');
    }

    // Mostrar formulario para editar estudiante
    public function edit(User $user)
    {
        return view('admin.students.edit', compact('user'));
    }

    // Actualizar datos de estudiante
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.students.index')
                         ->with('success','Estudiante actualizado correctamente.');
    }

    // Eliminar estudiante
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.students.index')
                         ->with('success','Estudiante eliminado.');
    }
}
