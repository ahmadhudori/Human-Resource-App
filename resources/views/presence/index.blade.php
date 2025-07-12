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
					<p class="text-subtitle text-muted">Employee's Presence</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Presence</li>
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
					@php
						$presenceToCheckout = $presences->first(function ($presence) {
							return is_null($presence->check_out);
						});
						// dd($presenceToCheckout);
					@endphp
					@if($presenceToCheckout && in_array(session('role'), ['Developer', 'Sales']))
						<div class="d-flex mb-3">
							<a href="{{ route('presence.checkout', $presenceToCheckout) }}" class="btn btn-success ms-auto">Checkout</a>
						</div>
					@else
						<div class="d-flex mb-3">
							<a href="{{ route('presence.create') }}" class="btn btn-primary ms-auto">Add Presence</a>
						</div>
					@endif
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>Employee</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Date</th>
								<th>Status</th>
								@if(session('role') == 'Human Resource')
									<th>Option</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach ($presences as $presence)
							<tr>
								<td>{{ $presence->employee->fullname }}</td>
								<td>{{ $presence->check_in }}</td>
								<td>{{ $presence->check_out }}</td>
								<td>{{ $presence->date }}</td>
								<td>
									@if($presence->status == 'present')
										<span class="text-success">Present</span>
									@elseif ($presence->status == 'leave')
										<span class="text-primary">Leave</span>
									@else
										<span class="text-danger">Absent</span>
									@endif
								</td>
								<td>
									@if (session('role') == 'Human Resource')
										<a href="{{ route('presence.edit', $presence) }}" class="btn btn-warning btn-sm">Edit</a>
										<form action="{{ route('presence.destroy', $presence) }}" method="post" class="d-inline">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this presence?')">Delete</button>
										</form>
									@endif
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