<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\TeacherCreateRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index() : View 
    {
        $teachers = Teacher::all();
        return view('pages.admin.teacher.index', ['teachers' => $teachers]); 
    }

    public function store(TeacherCreateRequest $request)
    {
        Teacher::create([
            'name' => $request->name
        ]);

        return Redirect::route('school.teacher.dashboard');
    }

    public function destroy(Request $request, Teacher $teacher)
    {
        $teacher->delete();

        return Redirect::route('school.teacher.dashboard');
    }
}
