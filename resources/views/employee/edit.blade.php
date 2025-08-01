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
					<p class="text-subtitle text-muted">Edit Employee</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Employee</li>
							<li class="breadcrumb-item " aria-current="page">Edit</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				@if (session('error'))
					<div class="alert alert-danger">{{ session('error') }}</div>
				@endif
				<form action="{{ route('employee.update', $employee) }}" method="post" class="card-body">
					@csrf
					@method('PUT')

					{{-- Fullname --}}
					<div class="mb-2">
						<label for="fullname" class="form-label">fullname</label>
						<input type="text" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname', $employee->fullname) }}" name="fullname" id="fullname" >
						@error('fullname')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Email --}}
					<div class="mb-2">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" >
						@error('email')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- phone number --}}
					<div class="mb-2">
						<label for="phone_number" class="form-label">Phone Number</label>
						<input type="tel" value="{{ old('phone_number', $employee->phone_number) }}" class="form-control @error('phone_number') is-invalid @enderror " name="phone_number" id="phone_number" >
						@error('phone_number')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- address --}}
					<div class="mb-2">
						<label for="address" class="form-label">Address</label>
						<textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" >{{ old('address', $employee->address) }}</textarea>
						@error('address')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Birthdate --}}
					<div class="mb-2">
						<label for="birth_date" class="form-label">Birth Date</label>
						<input type="date" name="birth_date" value="{{ old('birth_date', $employee->birth_date) }}" class="form-control date" id="birth_date" >
						@error('birth_date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Hire date --}}
					<div class="mb-2">
						<label for="hire_date" class="form-label">Hire Date</label>
						<input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" class="form-control date" id="hire_date" >
						@error('hire_date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- department --}}
					<div class="mb-2">
						<label for="department_id" class="form-label">Department</label>
						<select name="department_id" class="form-control" id="department_id" >
							<option value="">--Select Department--</option>
							@foreach ($departments as $department)
								<option value="{{ $department->id }}" @if ($department->id == old('department_id', $employee->department_id)) selected @endif>{{ $department->name }}</option>
							@endforeach
						</select>
						@error('department_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- role --}}
					<div class="mb-2">
						<label for="role_id" class="form-label">role</label>
						<select name="role_id" class="form-control" id="role_id" >
							<option value="">--Select Role--</option>
							@foreach ($roles as $role)
								<option value="{{ $role->id }}" @if ($role->id == old('role_id', $employee->role_id)) selected @endif>{{ $role->title }}</option>
							@endforeach
						</select>
						@error('role_id')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Status --}}
					<div class="mb-2">
						<label for="status" class="form-label">Status</label>
						<select name="status" class="form-control @error('status') is-invalid @enderror" id="status" >
							<option value="">--Select Status--</option>
							<option value="active" @if ($employee->status == 'active') selected @endif>Active</option>
							<option value="inactive"  @if ($employee->status == 'inactive') selected @endif>Inactive</option>
						</select>
						@error('status')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Salary --}}
					<div class="mb-2">
						<label for="salary" class="form-label">Salary</label>
						<input type="number" value="{{ old('salary', $employee->salary) }}" class="form-control @error('salary') is-invalid @enderror " name="salary" id="salary" >
						@error('salary')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<button class="btn btn-primary" type="submit">Update Employee</button>
					<a href="{{ route('employee.index') }}" class="btn btn-secondary">Back to list</a>
				</form>
			</div>

		</section>
	</div>
@endsection