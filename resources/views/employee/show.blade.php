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
					<h3>Employee</h3>
					<p class="text-subtitle text-muted">Detail Employee</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Employee</li>
							<li class="breadcrumb-item " aria-current="page">Detail</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">
						Detail
					</h5>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<label class="fw-bolder">Employee ID</label>
						<p>{{ $employee->id }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Fullname</label>
						<p>{{ $employee->fullname }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Email</label>
						<p>{{ $employee->email }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Phone Number</label>
						<p>{{ $employee->phone_number }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Address</label>
						<p>{{ $employee->address }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Birth Date</label>
						<p>{{ $employee->birth_date }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Hire Date</label>
						<p>{{ $employee->hire_date }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Address</label>
						<p>{{ $employee->birth_date }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Department</label>
						<p>{{ $employee->department->name }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Roles</label>
						<p>{{ $employee->role->title }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Salary</label>
						<p>Rp.{{ number_format($employee->salary) }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Status</label>
						@if ($employee->status == 'active')
							<p class="text-success">{{ ucfirst($employee->status) }}</p>
						@else
							<p class="text-danger">{{ ucfirst($employee->status) }}</p>
						@endif
					</div>
					<a href="{{ route('task.index') }}" class="btn btn-secondary">Back to list</a>
				</div>
			</div>

		</section>
	</div>
@endsection