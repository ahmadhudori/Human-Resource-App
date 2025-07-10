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
					@if(session('role') == 'Human Resource')
						<div class="d-flex mb-3">
							<a href="{{ route('task.create') }}" class="btn btn-primary ms-auto">Add Task</a>
						</div>
					@endif
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>Title</th>
								<th>Asiggned To</th>
								<th>Due Date</th>
								<th>Status</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tasks as $task)
							<tr>
								<td>{{ $task->title }}</td>
								<td>{{ ucwords($task->employee->fullname) }}</td>
								<td>{{ $task->due_date }}</td>
								<td>
									@if($task->status == 'pending')
										<span class="text-warning">Pending</span>
									@elseif ($task->status == 'done')
										<span class="text-success">Done</span>
									@else
										<span class="text-primary">On Progress</span>
									@endif
								</td>
								<td>
									<a href="{{ route('task.show', $task) }}" class="btn btn-info btn-sm">View</a>
									@if ($task->status == 'pending')
									<a href="{{ route('task.onProgress', $task) }}" class="btn btn-primary btn-sm">On Progress</a>
									<a href="{{ route('task.done', $task) }}" class="btn btn-success btn-sm">Done</a>
									@elseif ($task->status == 'done')
									<a href="{{ route('task.onProgress', $task) }}" class="btn btn-primary btn-sm">On Progress</a>
									@else
									<a href="{{ route('task.done', $task) }}" class="btn btn-success btn-sm">Done</a>
									@endif
									@if(session('role') == 'Human Resource')
										<a href="{{ route('task.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
										{{-- <a href="{{ route('task.destroy', $task) }}" class="btn btn-primary btn-sm">Delete</a> --}}
										<form action="{{ route('task.destroy', $task) }}" method="post" class="d-inline">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this task?')">Delete</button>
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