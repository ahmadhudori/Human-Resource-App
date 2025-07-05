<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
	{
		$tasks = Task::all();
		return view('task.index', compact('tasks'));	
	}

	public function create()
	{
		$employees = Employee::all();
		return view('task.create', compact('employees'));
	}
	
	public function store(Request $request)
	{
		// validation
		$request->validate([
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
			'assigned_to' => 'required',
			'due_date' => 'required|date',
			'status' => 'required|string'
		]);
		
		// $task = new Task();
		// $task->title = $request->title;
		// $task->assigned_to = $request->assigned_to;
		// $task->due_date = $request->due_date;
		// $task->save();
		// return redirect()->route('task.index');

		Task::create($request->all());
		return redirect()->route('task.index')->with('success', 'Task created successfully');
	}

	public function edit(Task $task)
	{
		$employees = Employee::all();
		return view('task.edit', compact('task', 'employees'));
	}

	public function update(Request $request, Task $task)
	{
		// validation
		$request->validate([
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
			'assigned_to' => 'required',
			'due_date' => 'required|date',
			'status' => 'required|string'
		]);
		
		$task->update($request->all());
		return redirect()->route('task.index')->with('success', 'Task updated successfully');
	}
}
