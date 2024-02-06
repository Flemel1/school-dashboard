<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Finance\FinanceController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;

// Main Page Route
Route::middleware(['auth'])->group(function() {
    // GET
    Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard.analytics');
    Route::get('/siswa/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/guru', [TeacherController::class, 'index'])->name('school.teacher.dashboard');
    Route::get('/mapel', [CourseController::class, 'index'])->name('school.course.dashboard');
    Route::get('/spp', [FinanceController::class, 'index'])->name('school.payment.dashboard');

    //POST
    Route::post('/siswa/create', [StudentController::class, 'store'])->name('student.create');
    Route::post('/guru/create', [TeacherController::class, 'store'])->name('school.teacher.create');
    Route::post('/mapel/create', [CourseController::class, 'store'])->name('school.course.create');
    Route::post('/spp/create', [FinanceController::class, 'store'])->name('school.payment.create');

    // DELETE
    Route::delete('/siswa/delete/{student}', [StudentController::class, 'destroy'])->name('student.delete');
    Route::delete('/guru/delete/{teacher}', [TeacherController::class, 'destroy'])->name('school.teacher.delete');
    Route::delete('/mapel/delete/{course}', [CourseController::class, 'destroy'])->name('school.course.delete');
    Route::delete('/spp/delete/{finance}', [FinanceController::class, 'destroy'])->name('school.payment.delete');
});