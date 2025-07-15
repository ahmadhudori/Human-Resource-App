<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Presence;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
	{
		$employee = Employee::count();
		$department = Department::count();
		$payroll = Payroll::count();
		$presence = Presence::count();
		$tasks = Task::all();
		
		return view('dashboard.index', compact('employee', 'department', 'payroll', 'presence', 'tasks'));
	}

	public function presence()
	{
		$data = Presence::where('status', 'present')
				->selectRaw('MONTH(date) as month, YEAR(date) as year, COUNT(*) as total_present')
				->groupBy('year', 'month')
				->orderBy('month', 'asc')
				->get();
		
		$result = array_fill(0, 12, 0); // inisialisasi array

		foreach ($data as $item) {
			$index = $item->month - 1; // agar Jan = 0
			if ($index >= 0 && $index < 12) {
				$result[$index] = $item->total_present;
			}
		}

		return response()->json($result);

	}
}
