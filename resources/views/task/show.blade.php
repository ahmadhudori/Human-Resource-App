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
						<label class="fw-bolder">Title</label>
						<p>{{ $task->title }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Employee</label>
						<p>{{ $task->employee->fullname }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Due Date</label>
						<p>{{ $dueDate }}</p>
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Status</label>
						@if ($task->status == 'pending')
							<p class="text-warning">{{ ucfirst($task->status) }}</p>
						@elseif ($task->status == 'onProgress')
							<p class="text-primary">{{ ucfirst($task->status) }}</p>
						@else
							<p class="text-success">{{ ucfirst($task->status) }}</p>
						@endif
					</div>
					<div class="mb-3">
						<label  class="fw-bolder">Description</label>
						<p>{{ $task->description }}</p>
					</div>
					<a href="{{ route('task.index') }}" class="btn btn-secondary">Back to list</a>
				</div>
			</div>

		</section>
	</div>
@endsection