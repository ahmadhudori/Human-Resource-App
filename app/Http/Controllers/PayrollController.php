<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
	{
		$payrolls = Payroll::with('employee')->get();
		foreach ($payrolls as $payroll) {
			$salary = $payroll->salary;
			$bonuses = $payroll->bonuses;
			$deductions = $payroll->deductions;
			$payroll->net_salary = $salary + $bonuses - $deductions;
		}

		return view('payroll.index', compact('payrolls'));
	}

	public function create()
	{
		$employees = Employee::all();
		return view('payroll.create', compact('employees'));
	}

	public function store(Request $request)
	{
		// validation
		$request->validate([
			'employee_id' => 'required',
			'salary' => 'required|numeric',
			'bonuses' => 'required|numeric',
			'deductions' => 'required|numeric',
			'net_salary' => 'required|numeric',
			'pay_date' => 'required|date'
		]);

		Payroll::create($request->all());
		// new Payroll([
		// 	'employee_id' => $request->employee_id,
		// 	'salary' => $request->salary,
		// 	'bonuses' => $request->bonuses,
		// 	'deductions' => $request->deductions,
		// 	'net_salary' => $request->net_salary,
		// 	'pay_date' => $request->pay_date
		// ])->save();
		return redirect()->route('payroll.index')->with('success', 'Payroll created successfully');
	}
}
