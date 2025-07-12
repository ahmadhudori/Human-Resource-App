@extends('layouts.dashboard')

@section('content')
	<header class="mb-3">
		<a href="#" class="burger-btn d-block d-xl-none">
			<i class="bi bi-justify fs-3"></i>
		</a>
	</header>
            
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Payroll</h3>
					<p class="text-subtitle text-muted">Edit Payroll</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Payroll</li>
							<li class="breadcrumb-item " aria-current="page">Edit</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				<form action="{{ route('payroll.update', $payroll) }}" method="post" class="card-body">
					@csrf
					@method('put')

					{{-- Employee --}}
					<div class="mb-2">
						<label for="employee_id" class="form-label">Employee</label>
						<select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id">
							<option value="">--Select Employee--</option>
							@foreach ($employees as $employee)
								<option value="{{ $employee->id }}" @if ($employee->id == old('employee_id', $payroll->employee_id)) selected @endif>{{ ucfirst($employee->fullname) }}</option>
							@endforeach
						</select>
						@error('employee_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Salary --}}
					<div class="mb-2">
						<label for="salary" class="form-label">Salary</label>
						<input type="number" name="salary" value="{{ old('salary', $payroll->salary) }}" class="form-control @error('salary') is-invalid @enderror" id="salary">
						@error('salary')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- bonuses --}}
					<div class="mb-2">
						<label for="bonuses" class="form-label">Bonuses</label>
						<input type="number" name="bonuses" value="{{ old('bonuses', $payroll->bonuses) }}" class="form-control @error('bonuses') is-invalid @enderror" id="bonuses">
						@error('bonuses')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Deductions --}}
					<div class="mb-2">
						<label for="deductions" class="form-label">Deductions</label>
						<input type="number" name="deductions" value="{{ old('deductions', $payroll->deductions) }}" class="form-control @error('deductions') is-invalid @enderror" id="deductions">
						@error('deductions')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Net Salary --}}
					<div class="mb-2">
						<label for="net_salary" class="form-label">Net Salary</label>
						<input type="number" name="net_salary" value="{{ old('net_salary', $payroll->net_salary) }}" class="form-control @error('net_salary') is-invalid @enderror" id="net_salary" readonly>
						@error('net_salary')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Pay Date --}}
					<div class="mb-2">
						<label for="pay_date" class="form-label">Pay Date</label>
						<input type="datetime-local" name="pay_date" value="{{ old('pay_date', $payroll->pay_date) }}" class="form-control date @error('pay_date') is-invalid @enderror" id="pay_date">
						@error('pay_date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<button class="btn btn-primary" type="submit">Update Payroll</button>
					<a href="{{ route('payroll.index') }}" class="btn btn-secondary">Back to list</a>
				</form>
			</div>

		</section>
	</div>
@endsection

@section('script')
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const salaryInput = document.getElementById('salary');
		const bonusesInput = document.getElementById('bonuses');
		const deductionsInput = document.getElementById('deductions');
		const netSalaryInput = document.getElementById('net_salary');

		function calculateNetSalary() {
			const salary = parseFloat(salaryInput.value) || 0;
			const bonuses = parseFloat(bonusesInput.value) || 0;
			const deductions = parseFloat(deductionsInput.value) || 0;

			const netSalary = salary + bonuses - deductions;
			netSalaryInput.value = netSalary;
		}

		salaryInput.addEventListener('input', calculateNetSalary);
		bonusesInput.addEventListener('input', calculateNetSalary);
		deductionsInput.addEventListener('input', calculateNetSalary);
	});
</script>

@endsection