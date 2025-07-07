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
					<h3>Role</h3>
					<p class="text-subtitle text-muted">Edit Role</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Role</li>
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
				<form action="{{ route('role.update', $role) }}" method="post" class="card-body">
					@csrf
					@method('PUT')

					{{-- title --}}
					<div class="mb-2">
						<label for="title" class="form-label">Title</label>
						<input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $role->title) }}" name="title" id="title" >
						@error('title')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					{{-- Description --}}
					<div class="mb-2">
						<label for="description" class="form-label">Description</label>
						<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" >{{ old('description', $role->description) }}</textarea>
						@error('description')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<button class="btn btn-primary" type="submit">Update Role</button>
					<a href="{{ route('task.index') }}" class="btn btn-secondary">Back to list</a>
				</form>
			</div>

		</section>
	</div>
@endsection