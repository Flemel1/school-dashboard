<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\StudentCreateRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::all();
        return view('pages.admin.student.index', ['students' => $students]);
    }

    public function store(StudentCreateRequest $request)
    {
        Student::create([
            'name' => $request->name,
            'grade' => $request->grade,
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // event(new Registered($user));

        return Redirect::route('student.dashboard');
    }

    public function destroy(Request $request, Student $student)
    {
        $student->delete();

        return Redirect::route('student.dashboard');
    }
}
