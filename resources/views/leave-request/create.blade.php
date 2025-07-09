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
					<h3>Leave Request</h3>
					<p class="text-subtitle text-muted">Create Leave Request</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Leave Request</li>
							<li class="breadcrumb-item " aria-current="page">New</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				@if($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form action="{{ route('leave-request.store') }}" method="post" class="card-body">
					@csrf

					{{-- Employee --}}
					<div class="mb-2">
						<label for="employee_id" class="form-label">Employee</label>
						<select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id">
							<option value="">--Select Employee--</option>
							@foreach ($employees as $employee)
								<option value="{{  $employee->id }}" @if(old('employee_id') == $employee->id) selected @endif>{{ ucfirst($employee->fullname) }}</option>
							@endforeach
						</select>
						@error('employee_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Leave Type --}}
					<div class="mb-2">
						<label for="leave_type" class="form-label">Leave Type</label>
						<select name="leave_type" class="form-control" id="leave_type">
							<option value="">--Select Leave Type--</option>
							<option value="sick-leave" @if(old('leave_type') == 'sick-leave') selected @endif>Sick Leave</option>
							<option value="birth-leave" @if(old('leave_type') == 'birth-leave') selected @endif>Birth Leave</option>
							<option value="marriage-leave" @if(old('leave_type') == 'marriage-leave') selected @endif>Marriage Leave</option>
						</select>
					</div>

					{{-- Start Date --}}
					<div class="mb-2">
						<label for="start_date" class="form-label">Start Date</label>
						<input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control date @error('start_date') is-invalid @enderror" id="start_date">
						@error('start_date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- End Date --}}
					<div class="mb-2">
						<label for="end_date" class="form-label">End Date</label>
						<input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control date @error('end_date') is-invalid @enderror" id="end_date">
						@error('end_date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<button class="btn btn-primary" type="submit">Submit Leave Request</button>
					<a href="{{ route('leave-request.index') }}" class="btn btn-secondary">Back to list</a>
				</form>
			</div>

		</section>
	</div>
@endsection
