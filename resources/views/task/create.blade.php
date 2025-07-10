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
					<h3>Task</h3>
					<p class="text-subtitle text-muted">Employee Task</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Task</li>
							<li class="breadcrumb-item " aria-current="page">New</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				<form action="{{ route('task.store') }}" method="post" class="card-body">
					@csrf

					{{-- Title --}}
					<div class="mb-2">
						<label for="title" class="form-label">Title</label>
						<input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" id="title" required>
						@error('title')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Employee --}}
					<div class="mb-2">
						<label for="status" class="form-label">Employee</label>
						<select name="assigned_to" class="form-control text-gray-600 @error('assigned_to') is-invalid @enderror" id="assigned_to">
							<option value="">Select Employee</option>
							@foreach ($employees as $employee)
								<option value="{{ $employee->id }}" @if(old('assigned_to') == $employee->id) selected @endif>{{ ucwords($employee->fullname) }}</option>
							@endforeach
						</select>
						@error('assigned_to')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Due Date --}}
					<div class="mb-2">
						<label for="due_date" class="form-label">Due Date</label>
						<input type="datetime-local" value="{{ old('due_date') }}" class="form-control datetime @error('due_date') is-invalid @enderror" name="due_date" id="due_date" required>
						@error('due_date')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Description --}}
					<div class="mb-2">
						<label for="description" class="form-label">Description</label>
						<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description') }}</textarea>
						@error('description')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<button class="btn btn-primary" type="submit">Create Task</button>
					<a href="{{ route('task.index') }}" class="btn btn-secondary">Back to list</a>
				</form>
			</div>

		</section>
	</div>
@endsection