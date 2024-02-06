<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Finance\FinanceCreateRequest;
use App\Models\Finance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FinanceController extends Controller
{
    public function index(): View
    {
        $students = Student::withWhereHas('finances')->get();
        $allStudent = Student::all();
        return view('pages.admin.finance.index', ['students' => $students, 'allStudent' => $allStudent]);
    }

    public function store(FinanceCreateRequest $request)
    {
        $student_id = preg_replace( '/[^0-9]/', '', $request->student);
        
        Finance::create([   
            'student_id' => $student_id,
            'nominal' => $request->nominal
        ]);

        return Redirect::route('school.payment.dashboard');
    }

    public function destroy(Request $request, Finance $finance)
    {
        $finance->delete();

        return Redirect::route('school.payment.dashboard');
    }
}
