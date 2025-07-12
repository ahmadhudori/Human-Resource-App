<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
	{
		if(session('role') == 'Human Resource') {
			$leaveRequests = LeaveRequest::with('employee')->get();
		} else {
			$leaveRequests = LeaveRequest::where('employee_id', session('employee_id'))->with('employee')->get();
		}
		return view('leave-request.index', compact('leaveRequests'));
	}

	public function create()
	{
		if (session('role') == 'Human Resource') {
			$employees = Employee::all();
			return view('leave-request.create', compact('employees'));
		} else {
			$employee = Employee::find(session('employee_id'));
			return view('leave-request.create', compact('employee'));
		}
	}

	public function store(Request $request)
	{
		// validation
		if(session('role') == 'Human Resource') {
			$request->validate([
			'employee_id' => 'required',
			'leave_type' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|after:start_date',
			]);
			$request->merge([
				'status' => 'pending',
			]);
		} else {
			$request->validate([
			'leave_type' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|after:start_date',
			]);
			$request->merge([
				'employee_id' => session('employee_id'),
				'status' => 'pending',
			]);
		}

		LeaveRequest::create($request->all());
		return redirect()->route('leave-request.index')->with('success', 'Leave request created successfully');
	}

	public function edit(LeaveRequest $leaveRequest)
	{
		$employees = Employee::all();
		return view('leave-request.edit', compact('leaveRequest', 'employees'));
	}

	public function update(Request $request, LeaveRequest $leaveRequest)
	{
		// validation
		$request->validate([
			'employee_id' => 'required',
			'leave_type' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|after:start_date',
		]);

		$leaveRequest->update($request->all());
		return redirect()->route('leave-request.index')->with('success', 'Leave request updated successfully');
	}

	public function destroy(LeaveRequest $leaveRequest)
	{
		$leaveRequest->delete();
		return redirect()->route('leave-request.index')->with('success', 'Leave request deleted successfully');
	}

	public function approved(LeaveRequest $leaveRequest)
	{
		$leaveRequest->status = 'approved';
		$leaveRequest->save();
		return redirect()->route('leave-request.index')->with('success', 'Leave request approved successfully');
	}

	public function rejected(LeaveRequest $leaveRequest)
	{
		$leaveRequest->status = 'rejected';
		$leaveRequest->save();
		return redirect()->route('leave-request.index')->with('success', 'Leave request approved successfully');
	}
}
