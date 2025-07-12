<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
	{
		if(session('role') == 'Human Resource') {
			$presences = Presence::all();
		} else {
			$presences = Presence::where('employee_id', session('employee_id'))->get();
		}
		return view('presence.index', compact('presences'));
	}

	public function  create() 
	{
		$employees = Employee::all();
		return view('presence.create', compact('employees'));	
	}

	public function store(Request $request, Presence $presence)
	{
		if(session('role') == 'Human Resource') {
			// validation
			$request->validate([
				"employee_id" => "required",
				"check_in" => "required|date",
				"check_out" => "required|date|after:check_in",
				"date" => "required|date",
				"status" => "required"
			]);

			$presence->create($request->all());
		} else {
			$presence->create([
				'employee_id' => session('employee_id'),
				'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
				'latitude' => $request->latitude,
				'longitude' => $request->longitude,
				'date' => Carbon::now()->format('Y-m-d'),
				'status' => 'present'
			]);
		}
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

	public function destroy(Presence $presence)
	{
		$presence->delete();
		return redirect()->route('presence.index')->with('success', 'Presence deleted successfully');
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

	public function checkout(Presence $presence)
	{
		return view('presence.checkout', compact('presence'));
	}

	public function checkoutProcess(Request $request, Presence $presence)
	{
		$presence->check_out = Carbon::now()->format('Y-m-d H:i:s');
		$presence->latitude = $request->latitude;
		$presence->longitude = $request->longitude;
		$presence->date = Carbon::now()->format('Y-m-d');
		$presence->save();
		return redirect()->route('presence.index')->with('success', 'Presence checked out successfully');
	}
}
