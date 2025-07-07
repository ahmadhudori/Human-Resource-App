<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
	{
		$departments = Department::all();
		return view('department.index', compact('departments'));
	}

	public function create()
	{
		return view('department.create');
	}

	public function store(Request $request)
	{
		// valdation
		$request->validate([
			'name' => 'required|string|max:255',
			'description' => 'nullable|string',
			'status' => 'required|string'
		]);

		Department::create($request->all());
		return redirect()->route('department.index')->with('success', 'Department created successfully');
	}

	public function edit(Department $department)
	{
		return view('department.edit', compact('department'));
	}

	public function update(Request $request, Department $department)
	{
		// validation
		$request->validate([
			'name' => 'required|string|max:255',
			'description' => 'nullable|string',
			'status' => 'required|string'
		]);

		$department->update($request->all());
		return redirect()->route('department.index')->with('success', 'Department updated successfully');
	}

	public function destroy(Department $department)
	{
		$department->delete();
		return redirect()->route('department.index')->with('success', 'Department deleted successfully');
	}

	public function inactive(Department $department)
	{
		$department->status = 'inactive';
		$department->save();
		return redirect()->route('department.index')->with('success', 'Department inactive successfully');
	}

	public function active(Department $department)
	{
		$department->status = 'active';
		$department->save();
		return redirect()->route('department.index')->with('success', 'Department active successfully');
	}
}
