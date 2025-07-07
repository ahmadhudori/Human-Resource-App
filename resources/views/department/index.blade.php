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
					<h3>Department</h3>
					<p class="text-subtitle text-muted">List of Department</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Department</li>
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
						<a href="{{ route('department.create') }}" class="btn btn-primary ms-auto">Add Department</a>
					</div>
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Status</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($departments as $department)
							<tr>
								<td>{{ $department->name }}</td>
								<td>{{ $department->description }}</td>
								<td>
									@if($department->status == 'active')
										<span class="text-success">Active</span>
									@else
										<span class="text-danger">Inactive</span>
									@endif
								</td>
								<td>
									@if ($department->status == 'active')
									<a href="{{ route('department.inactive', $department) }}" class="btn btn-primary btn-sm">Inactive</a>
									@else
									<a href="{{ route('department.active', $department) }}" class="btn btn-warning btn-sm">Active</a>
									@endif
									<a href="{{ route('department.edit', $department) }}" class="btn btn-warning btn-sm">Edit</a>
									{{-- <a href="{{ route('department.destroy', $department) }}" class="btn btn-primary btn-sm">Delete</a> --}}
									<form action="{{ route('department.destroy', $department) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this department?')">Delete</button>
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