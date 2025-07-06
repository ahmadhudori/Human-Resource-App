<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
	public function index()
	{
		$employees = Employee::all();
		return view('employee.index', compact('employees'));
	}

	public function create()
	{
		$departments = Department::all();
		$roles = Role::all();
		return view('employee.create', compact('departments', 'roles'));
	}

	public function store(Request $request)
	{
		// validation
		$request->validate([
			'fullname' => 'required|string|max:255',
			'email' => 'required|email',
			'phone_number' => 'required|regex:/^08[0-9]{8,11}$/',
			'birth_date' => 'required|date',
			'hire_date' => 'required|date',
			'department_id' => 'required',
			'role_id' => 'required',
			'status' => 'required|string',
			'salary' => 'required|numeric'
		]);

		Employee::create($request->all());

		return redirect()->route('employee.index')->with('success', 'Employee created successfully');
	}

	public function show(Employee $employee)
	{
		return view('employee.show', compact('employee'));
	}

	public function edit(Employee $employee)
	{
		$departments = Department::all();
		$roles = Role::all();
		return view('employee.edit', compact('employee', 'departments', 'roles'));
	}

	public function update(Request $request, Employee $employee)
	{
		// validation
		$request->validate([
			'fullname' => 'required|string|max:255',
			'email' => 'required|email',
			'phone_number' => 'required|regex:/^08[0-9]{8,11}$/',
			'birth_date' => 'required|date',
			'hire_date' => 'required|date',
			'department_id' => 'required',
			'role_id' => 'required',
			'status' => 'required|string',
			'salary' => 'required|numeric'
		]);

		$employee->update($request->all());

		return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
	}

	public function active(Employee $employee)
	{
		$employee->status = 'active';
		$employee->save();
		return redirect()->route('employee.index');
	}

	public function inactive(Employee $employee)
	{
		$employee->status = 'inactive';
		$employee->save();
		return redirect()->route('employee.index');
	}
}
