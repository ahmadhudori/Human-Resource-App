<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PayrollController;
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

Route::middleware('auth')->group(function() {

	Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:Human Resource,Developer,Sales')->name('dashboard');

	// Handel task
	Route::resource('task', TaskController::class)->middleware('role:Human Resource,Developer,Sales');
	Route::get('/task/{task:id}/pending', [TaskController::class, 'pending'])->middleware('role:Human Resource,Developer,Sales')->name('task.pending');
	Route::get('/task/{task:id}/done', [TaskController::class, 'done'])->middleware('role:Human Resource,Developer,Sales')->name('task.done');
	Route::get('/task/{task:id}/onProgress', [TaskController::class, 'onProgress'])->middleware('role:Human Resource,Developer,Sales')->name('task.onProgress');

	// Handel employee
	Route::resource('employee', EmployeeController::class)->middleware('role:Human Resource');
	Route::get('/employee/{employee}/active', [EmployeeController::class, 'active'])->middleware('role:Human Resource')->name('employee.active');
	Route::get('/employee/{employee}/inactive', [EmployeeController::class, 'inactive'])->middleware('role:Human Resource')->name('employee.inactive');

	// Handel department
	Route::resource('department', DepartmentController::class)->middleware('role:Human Resource');
	Route::get('/department/{department}/active', [DepartmentController::class, 'active'])->middleware('role:Human Resource')->name('department.active');
	Route::get('/department/{department}/inactive', [DepartmentController::class, 'inactive'])->middleware('role:Human Resource')->name('department.inactive');

	// Handel Role
	Route::resource('role', RoleController::class)->middleware('role:Human Resource');

	// Handel Presence
	Route::resource('presence', PresenceController::class)->middleware('role:Human Resource,Developer,Sales');
	Route::get('/presence/{presence}/checkout', [PresenceController::class, 'checkout'])->middleware('role:Developer, Sales')->name('presence.checkout');
	Route::put('/presence/{presence}/chekout', [PresenceController::class, 'checkoutProcess'])->middleware('role:Developer, Sales')->name('presence.checkoutProcess');
	
	// Handel Payroll
	Route::resource('payroll', PayrollController::class)->middleware('role:Human Resource,Developer,Sales');

	// Handel Leave Request
	Route::resource('leave-request', LeaveRequestController::class)->middleware('role:Human Resource,Developer,Sales');
	Route::get('/leave-request/{leaveRequest}/approved', [LeaveRequestController::class, 'approved'])->middleware('role:Human Resource,Developer,Sales')->name('leaveRequest.approved');
	Route::get('/leave-request/{leaveRequest}/rejected', [LeaveRequestController::class, 'rejected'])->middleware('role:Human Resource,Developer,Sales')->name('leaveRequest.rejected');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Print Slip Payroll pdf
Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->name('payroll.print');