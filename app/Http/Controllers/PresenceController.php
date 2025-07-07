<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
	{
		$presences = Presence::all();
		return view('presence.index', compact('presences'));
	}

	public function  create() 
	{
		$employees = Employee::all();
		return view('presence.create', compact('employees'));	
	}

	public function store(Request $request, Presence $presence)
	{
		// validation
		$request->validate([
			"employee_id" => "required",
			"check_in" => "required|date",
			"check_out" => "required|date|after:check_in",
			"date" => "required|date",
			"status" => "required"
		]);

		$presence->create($request->all());
		return redirect()->route('presence.index')->with('success', 'Presence created successfully');
	}

	public function edit(Presence $presence)
	{
		$employees = Employee::all();
		return view('presence.edit', compact('presence', 'employees'));
	}

	public function update(Request $request, Presence $presence)
	{
		// validation
		$request->validate([
			"employee_id" => "required",
			"check_in" => "required|date",
			"check_out" => "required|date|after:check_in",
			"date" => "required|date",
			"status" => "required"
		]);

		$presence->update($request->all());
		return redirect()->route('presence.index')->with('success', 'Presence updated successfully');
	}

	public function present(Presence $presence)
	{
		$presence->status = 'present';
		$presence->save();
		return redirect()->route('presence.index')->with('success', 'Presence updated successfully');
	}
	public function leave(Presence $presence)
	{
		$presence->status = 'leave';
		$presence->save();
		return redirect()->route('presence.index')->with('success', 'Presence updated successfully');
	}
	public function absent(Presence $presence)
	{
		$presence->status = 'absent';
		$presence->save();
		return redirect()->route('presence.index')->with('success', 'Presence updated successfully');
	}
}
