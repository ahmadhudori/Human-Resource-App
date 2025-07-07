<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// from laravel breeze
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Handel task
Route::resource('task', TaskController::class);
Route::get('/task/{task:id}/pending', [TaskController::class, 'pending'])->name('task.pending');
Route::get('/task/{task:id}/done', [TaskController::class, 'done'])->name('task.done');
Route::get('/task/{task:id}/onProgress', [TaskController::class, 'onProgress'])->name('task.onProgress');

// Handel employee
Route::resource('employee', EmployeeController::class);
Route::get('/employee/{employee}/active', [EmployeeController::class, 'active'])->name('employee.active');
Route::get('/employee/{employee}/inactive', [EmployeeController::class, 'inactive'])->name('employee.inactive');

// Handel department
Route::resource('department', DepartmentController::class);
Route::get('/department/{department}/active', [DepartmentController::class, 'active'])->name('department.active');
Route::get('/department/{department}/inactive', [DepartmentController::class, 'inactive'])->name('department.inactive');

// Handel Role
Route::resource('role', RoleController::class);

// Handel Presence
Route::resource('presence', PresenceController::class);
Route::get('/presence/{presence}/present', [PresenceController::class, 'present'])->name('presence.present');
Route::get('/presence/{presence}/leave', [PresenceController::class, 'leave'])->name('presence.leave');
Route::get('/presence/{presence}/absent', [PresenceController::class, 'absent'])->name('presence.absent');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
