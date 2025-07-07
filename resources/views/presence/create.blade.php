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
					<h3>Presence</h3>
					<p class="text-subtitle text-muted">Create Presence</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Presence</li>
							<li class="breadcrumb-item " aria-current="page">New</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				<form action="{{ route('presence.store') }}" method="post" class="card-body">
					@csrf

					{{-- Employee --}}
					<div class="mb-2">
						<label for="employee_id" class="form-label">Employee</label>
						<select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id">
							<option value="">--Select Employee--</option>
							@foreach ($employees as $employee)
								<option value="{{ $employee->id }}">{{ ucfirst($employee->fullname) }}</option>
							@endforeach
						</select>
						@error('employee_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Check In --}}
					<div class="mb-2">
						<label for="check_in" class="form-label">Check In</label>
						<input type="datetime-local" name="check_in" value="{{ old('check_in') }}" class="form-control date @error('check_in') is-invalid @enderror" id="check_in">
						@error('check_in')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Check out --}}
					<div class="mb-2">
						<label for="check_out" class="form-label">Check out</label>
						<input type="datetime-local" name="check_out" value="{{ old('check_out') }}" class="form-control date @error('check_out') is-invalid @enderror" id="check_out">
						@error('check_out')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Date --}}
					<div class="mb-2">
						<label for="date" class="form-label">Date</label>
						<input type="datetime-local" name="date" value="{{ old('date') }}" class="form-control date @error('date') is-invalid @enderror" id="date">
						@error('date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Status --}}
					<div class="mb-2">
						<label for="status" class="form-label">Status</label>
						<select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
							<option value="">--Select Status--</option>
							<option value="present">Present</option>
							<option value="leave">Leave</option>
							<option value="absent">Absent</option>
						</select>
						@error('status')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<button class="btn btn-primary" type="submit">Submit Presence</button>
					<a href="{{ route('presence.index') }}" class="btn btn-secondary">Back to list</a>
				</form>
			</div>

		</section>
	</div>
@endsection