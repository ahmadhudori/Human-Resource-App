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
				@if(session('role') == 'Human Resource')
					<form action="{{ route('presence.store') }}" method="post" class="card-body">
						@csrf
						{{-- Employee --}}
						<div class="mb-2">
							<label for="employee_id" class="form-label">Employee</label>
							<select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id">
								<option value="">--Select Employee--</option>
								@foreach ($employees as $employee)
									<option value="{{ $employee->id }}" @if(old('employee_id') == $employee->id) selected @endif>{{ ucfirst($employee->fullname) }}</option>
								@endforeach
							</select>
							@error('employee_id')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						{{-- Check In --}}
						<div class="mb-2">
							<label for="check_in" class="form-label">Check In</label>
							<input type="datetime-local" name="check_in" value="{{ old('check_in') }}" class="form-control datetime @error('check_in') is-invalid @enderror" id="check_in">
							@error('check_in')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						{{-- Check out --}}
						<div class="mb-2">
							<label for="check_out" class="form-label">Check out</label>
							<input type="datetime-local" name="check_out" value="{{ old('check_out') }}" class="form-control datetime @error('check_out') is-invalid @enderror" id="check_out">
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
								<option value="present" @if(old('status') == 'present') selected @endif>Present</option>
								<option value="leave" @if(old('status') == 'leave') selected @endif>Leave</option>
								<option value="absent" @if(old('status') == 'absent') selected @endif>Absent</option>
							</select>
							@error('status')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<button class="btn btn-primary" type="submit">Submit Presence</button>
						<a href="{{ route('presence.index') }}" class="btn btn-secondary">Back to list</a>
					</form>
				@endif
				
				@if(in_array(session('role'), ['Developer', 'Sales']))
					<form action="{{ route('presence.store') }}" method="POST" class="card-body">
						@csrf
						<div class="mb-3">
							<b>Note: </b>Mohon izinkan lokasi supaya presensi diterima
						</div>
						<div class="mb-3">
							<label for="" class="form-label">Latitude</label>
							<input type="text" name="latitude" class="form-control" id="latitude">
						</div>
						<div class="mb-3">
							<label for="" class="form-label">Longitude</label>
							<input type="text" name="longitude" class="form-control" id="longitude">
						</div>

						<div class="mb-3">
							<iframe src="" frameborder="0" width="500" height="300" scrolling="no" marginheight="0" marginwidth="0"></iframe>
						</div>

						<button type="submit" class="btn btn-primary" id="btn-present" disabled>Present</button>
					</form>
				@endif
			</div>

		</section>
	</div>

	<script>
		const iframe = document.querySelector('iframe');
		const officeLat = -7.657125379551392;
		const officeLong = 109.52366035309177;
		const threshold = 0.01;

		navigator.geolocation.getCurrentPosition((position) => {
			const lat = position.coords.latitude;
			const long = position.coords.longitude;

			iframe.src = `https://www.google.com/maps?q=${lat},${long}&output=embed`;
		})

		document.addEventListener('DOMContentLoaded', (event) => {
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (position) {
					const lat = position.coords.latitude;
					const long = position.coords.longitude;

					document.getElementById('latitude').value = lat;
					document.getElementById('longitude').value = long;

					// Compare lokasi user sekarang dengan lokasi office
					const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(long - officeLong, 2));

					if(distance <= threshold) {
						// posisi berada di sekitar office
						alert('Posisi anda berada di sekitar office, selamat bekerja');
						document.querySelector('#btn-present').removeAttribute('disabled');
					} else
					{
						// posisi tidak berada di sekitar office
						alert('Posisi anda tidak berada di sekitar office, silahkan kembali ke office untuk melakukan presensi');
					}
				})
			}

		})
	</script>
@endsection