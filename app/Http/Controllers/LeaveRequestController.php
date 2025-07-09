<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
	{
		$leaveRequests = LeaveRequest::with('employee')->get();
		return view('leave-request.index', compact('leaveRequests'));
	}

	public function create()
	{
		$employees = Employee::all();
		return view('leave-request.create', compact('employees'));
	}

	public function store(Request $request)
	{
		// validation
		$request->validate([
			'employee_id' => 'required',
			'leave_type' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|after:start_date',
		]);

		$request->merge([
			'status' => 'pending',
		]);
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
