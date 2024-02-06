<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseCreateRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::all();
        return view('pages.admin.course.index', ['courses' => $courses]);
    }

    public function store(CourseCreateRequest $request)
    {
        Course::create([
            'name' => $request->name
        ]);

        return Redirect::route('school.course.dashboard');
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return Redirect::route('school.course.dashboard');
    }
}
