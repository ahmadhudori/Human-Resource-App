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




// from laravel breeze
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
	Route::get('/', [DashboardController::class, 'index'])->middleware('role:Human Resource,Developer,Sales');
	Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:Human Resource,Developer,Sales')->name('dashboard');
	Route::get('/dashboard/presence', [DashboardController::class, 'presence']);
	
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
	
	// Handel Payroll memakai middleware di controller
	Route::get('payroll', [PayrollController::class, 'index'])->middleware('role:Human Resource,Developer,Sales')->name('payroll.index');
	Route::get('/payroll/create', [PayrollController::class, 'create'])->middleware('role:Human Resource')->name('payroll.create');
	Route::post('/payroll/store', [PayrollController::class, 'store'])->middleware('role:Human Resource')->name('payroll.store');
	Route::get('/payroll/{payroll}/edit', [PayrollController::class, 'edit'])->middleware('role:Human Resource')->name('payroll.edit');
	Route::put('/payroll/{payroll}/update', [PayrollController::class, 'update'])->middleware('role:Human Resource')->name('payroll.update');
	Route::delete('/payroll/{payroll}/destroy', [PayrollController::class, 'destroy'])->middleware('role:Human Resource')->name('payroll.destroy');
	Route::get('/payroll/{payroll}/show', [PayrollController::class, 'show'])->middleware('role:Human Resource,Developer,Sales')->name('payroll.show');
	Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->middleware('role:Human Resource,Developer,Sales')->name('payroll.print');

	// Handel Leave Request
	Route::get('/leave-request', [LeaveRequestController::class, 'index'])->middleware('role:Human Resource,Developer,Sales')->name('leave-request.index');
	Route::get('/leave-request/create', [LeaveRequestController::class, 'create'])->middleware('role:Human Resource,Developer,Sales')->name('leave-request.create');
	Route::post('/leave-request', [LeaveRequestController::class, 'store'])->middleware('role:Human Resource,Developer,Sales')->name('leave-request.store');
	Route::get('/leave-request/{leaveRequest}/edit', [LeaveRequestController::class, 'edit'])->middleware('role:Human Resource')->name('leave-request.edit');
	Route::put('/leave-request/{leaveRequest}', [LeaveRequestController::class, 'update'])->middleware('role:Human Resource')->name('leave-request.update');
	Route::delete('/leave-request/{leaveRequest}/destroy', [LeaveRequestController::class, 'destroy'])->middleware('role:Human Resource')->name('leave-request.destroy');
	Route::get('/leave-request/{leaveRequest}/approved', [LeaveRequestController::class, 'approved'])->middleware('role:Human Resource')->name('leaveRequest.approved');
	Route::get('/leave-request/{leaveRequest}/rejected', [LeaveRequestController::class, 'rejected'])->middleware('role:Human Resource')->name('leaveRequest.rejected');
	
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Print Slip Payroll pdf
Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->name('payroll.print');