<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    public function index()
	{
		if(session('role') == 'Human Resource') {
			$tasks = Task::all();
		} else {
			$tasks = Task::where('assigned_to', session('employee_id'))->get();
		}
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
			'due_date' => 'required|date|after:now',
		]);
		
		// $task = new Task();
		// $task->title = $request->title;
		// $task->assigned_to = $request->assigned_to;
		// $task->due_date = $request->due_date;
		// $task->save();
		// return redirect()->route('task.index');
		$request->merge([
			'status' => 'pending',
		]);

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
			'due_date' => 'required|date|after:now',
		]);
		
		$task->update($request->all());
		return redirect()->route('task.index')->with('success', 'Task updated successfully');
	}
	
	public function show(Task $task)
	{
		$dueDate = Carbon::parse($task->due_date)->format('d F Y');
		return view('task.show', compact('task', 'dueDate'));
	}

	public function destroy(Task $task)
	{
		$task->delete();
		return redirect()->route('task.index')->with('success', 'Task deleted successfully');
	}

	public function done(Task $task)
	{
		$task->status = 'done';
		$task->save();
		return redirect()->route('task.index')->with('success', 'Task marked as done');
	}

	public function onProgress(Task $task)
	{
		$task->status = 'onProgress';
		$task->save();
		return redirect()->route('task.index')->with('success', 'Task marked as done');
	}

}
