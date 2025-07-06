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
					<h3>Employees</h3>
					<p class="text-subtitle text-muted">List of employees</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Employees</li>
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
						<a href="{{ route('employee.create') }}" class="btn btn-primary ms-auto">Add Employee</a>
					</div>
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>Fullname</th>
								<th>Birth Date</th>
								<th>Department</th>
								<th>Roles</th>
								<th>Salary</th>
								<th>Status</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($employees as $employee)
							<tr>
								<td>{{ $employee->fullname }}</td>
								<td>{{ $employee->birth_date }}</td>
								<td>{{ $employee->department->name }}</td>
								<td>{{ $employee->role->title }}</td>
								<td>{{ $employee->salary }}</td>
								<td>
									@if($employee->status == 'active')
										<span class="text-success">Active</span>
									@else
										<span class="text-warning">Inactive</span>
									@endif
								</td>
								<td>
									<a href="{{ route('employee.show', $employee) }}" class="btn btn-info btn-sm">View</a>
									<a href="{{ route('employee.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a>
									<form action="{{ route('employee.destroy', $employee) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete {{ $employee->fullname }}?')">Delete</button>
									</form>
								</td>
								{{-- <td>
									<a href="{{ route('employee.show', $employee) }}" class="btn btn-info btn-sm">View</a>
									@if ($employee->status == 'pending')
									<a href="{{ route('employee.onProgress', $employee) }}" class="btn btn-primary btn-sm">On Progress</a>
									<a href="{{ route('employee.done', $employee) }}" class="btn btn-success btn-sm">Done</a>
									@elseif ($employee->status == 'done')
									<a href="{{ route('employee.pending', $employee) }}" class="btn btn-warning btn-sm">Pending</a>
									<a href="{{ route('employee.onProgress', $employee) }}" class="btn btn-primary btn-sm">On Progress</a>
									@else
									<a href="{{ route('employee.done', $employee) }}" class="btn btn-success btn-sm">Done</a>
									<a href="{{ route('employee.pending', $employee) }}" class="btn btn-warning btn-sm">Pending</a>
									@endif
									<a href="{{ route('employee.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a> --}}
									{{-- <form action="{{ route('employee.destroy', $employee) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="submit" class="btn btn-danger btn-sm">Delete</button>
									</form>
								</td> --}}
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</section>
	</div>
@endsection