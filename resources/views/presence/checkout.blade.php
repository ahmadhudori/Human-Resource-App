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
				<form action="{{ route('presence.checkoutProcess', $presence) }}" method="POST" class="card-body">
					@csrf
					@method('PUT')
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

					<button type="submit" class="btn btn-primary" id="btn-present" disabled>Checkout</button>
				</form>
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