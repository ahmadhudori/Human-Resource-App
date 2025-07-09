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
					<p class="text-subtitle text-muted">List of Leave Request</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Leave Request</li>
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
						<a href="{{ route('leave-request.create') }}" class="btn btn-primary ms-auto">New Leave Request</a>
					</div>
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>Employee</th>
								<th>Leave Type</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($leaveRequests as $leaveRequest)
							<tr>
								<td>{{ ucfirst($leaveRequest->employee->fullname) }}</td>
								<td>{{ $leaveRequest->leave_type }}</td>
								<td>{{ $leaveRequest->start_date }}</td>
								<td>{{ $leaveRequest->end_date }}</td>
								<td>
									@if($leaveRequest->status == 'pending')
										<span class="text-warning">Pending</span>
									@elseif ($leaveRequest->status == 'approved')
										<span class="text-success">Confirm</span>
									@else
										<span class="text-danger">Rejected</span>
									@endif
								</td>
								<td>
									@if ($leaveRequest->status == 'pending')
									<a href="{{ route('leaveRequest.approved', $leaveRequest) }}" class="btn btn-success btn-sm">Confirm</a>
									<a href="{{ route('leaveRequest.rejected', $leaveRequest) }}" class="btn btn-danger btn-sm">Rejected</a>
									@elseif($leaveRequest->status == 'approved')
									<a href="{{ route('leaveRequest.rejected', $leaveRequest) }}" class="btn btn-danger btn-sm">Rejected</a>
									@else
									<a href="{{ route('leaveRequest.approved', $leaveRequest) }}" class="btn btn-success btn-sm">Confirm</a>
									@endif
									<a href="{{ route('leave-request.edit', $leaveRequest) }}" class="btn btn-warning btn-sm">Edit</a>
									{{-- <a href="{{ route('leaveRequest.destroy', $leaveRequest) }}" class="btn btn-primary btn-sm">Delete</a> --}}
									<form action="{{ route('leave-request.destroy', $leaveRequest) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this leaveRequest?')">Delete</button>
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