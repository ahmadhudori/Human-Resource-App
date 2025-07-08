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
					<p class="text-subtitle text-muted">List of Payroll</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Payroll</li>
							<li class="breadcrumb-item " aria-current="page">Index</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">
						Data
					</h5>
				</div>
				<div class="card-body">
					<div class="d-flex mb-3">
						<a href="{{ route('payroll.create') }}" class="btn btn-primary ms-auto">Add Payroll</a>
					</div>
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>Employee</th>
								<th>Salary</th>
								<th>Bonuses</th>
								<th>Deductions</th>
								<th>Net Salary</th>
								<th>Pay Date</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($payrolls as $payroll)
							<tr>
								<td>{{ $payroll->employee->fullname }}</td>
								<td>Rp.{{ number_format($payroll->salary) }}</td>
								<td>Rp.{{ number_format($payroll->bonuses) }}</td>
								<td>Rp.{{ number_format($payroll->deductions) }}</td>
								<td>Rp.{{ number_format($payroll->net_salary) }}</td>
								<td>{{ $payroll->pay_date }}</td>
								<td>
									<a href="{{ route('payroll.show', $payroll) }}" class="btn btn-info btn-sm">Detail Payroll</a>
									<a href="{{ route('payroll.edit', $payroll) }}" class="btn btn-warning btn-sm">Edit</a>
									{{-- <a href="{{ route('payroll.destroy', $payroll) }}" class="btn btn-primary btn-sm">Delete</a> --}}
									<form action="{{ route('payroll.destroy', $payroll) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(`Do you want to delete this {{ $payroll->employee->fullname }}'s payroll?`)">Delete</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</section>
	</div>
@endsection