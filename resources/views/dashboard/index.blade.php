@extends('layouts.dashboard')

@section('content')
	<header class="mb-3">
		<a href="#" class="burger-btn d-block d-xl-none">
			<i class="bi bi-justify fs-3"></i>
		</a>
	</header>
	<div class="page-heading">
		<h3>Dashboard</h3>
	</div> 
	<div class="page-content"> 
		<div class="row">
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
								<div class="stats-icon purple mb-2">
									<i class="icon dripicons dripicons-tag"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Department</h6>
								<h6 class="font-extrabold mb-0">{{ $department }}</h6>
							</div>
						</div> 
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card"> 
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
								<div class="stats-icon blue mb-2">
									<i class="icon dripicons dripicons-user"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Employee</h6>
								<h6 class="font-extrabold mb-0">{{ $employee }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
								<div class="stats-icon green mb-2">
									<i class="icon dripicons dripicons-alarm"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Presence</h6>
								<h6 class="font-extrabold mb-0">{{ $presence }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
								<div class="stats-icon red mb-2">
									<i class="icon dripicons dripicons-to-do"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Payroll</h6>
								<h6 class="font-extrabold mb-0">{{ $payroll }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Latest Presence</h4>
					</div>
					<div class="card-body">
						<canvas id="presence"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Latest Tasks</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-lg">
								<thead>
									<tr>
										<th>Employee</th>
										<th>Detail</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($tasks as $task)
									<tr>
										<td class="col-3">
											<div class="d-flex align-items-center">
												<div class="avatar avatar-md">
													<img src="https://ui-avatars.com/api/?name={{ $task->employee->fullname }}&background=random&color=random">
												</div>
												<p class="font-bold ms-3 mb-0">{{ ucwords($task->employee->fullname) }}</p>
											</div>
										</td>
										<td class="col-auto">
											<p class=" mb-0">{{ $task->title }}</p>
										</td>
										<td class="col-auto">
											@if ($task->status == 'pending')
												<p class=" mb-0 text-warning">{{ $task->status }}</p>
											@elseif ($task->status == 'onProgress')
												<p class=" mb-0 text-primary">{{ $task->status }}</p>
											@else
												<p class=" mb-0 text-success">{{ $task->status }}</p>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection