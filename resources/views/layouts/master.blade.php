<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@yield('meta-tags')

	<link rel="icon" href="{{ asset('gambar/logo/icon.svg') }}">
	<title>Mokumovies - @yield('meta_title', 'Home')</title>

	@include('layouts.css-extension')

	@yield('css')
</head>

<body class="layout-3 primary-pattern-1 starback">
	<canvas id="canvas" style="width: 100%;height: 100%;position: absolute;inset: 0;"></canvas>
	
	<div id="app">
		@include('layouts.navbar')

		@yield('content')

		{{-- @include('layouts.footer') --}}
	</div>

	@include('layouts.script-extension')

	@yield('script')
	@stack('script')

	<script src="https://unpkg.com/starback@2.0.1/dist/starback.js"></script>
	
	<script>
	
	let wrapper = document.querySelector('.starback')

	const starback = new Starback("#canvas", {
		width: wrapper.clientWidth,
		height: wrapper.clientHeight,
		type: 'dot',
		quantity: 50,
		starSize: [0.5,1],
		direction: 5,
		starColor: '#ffffff',
		randomOpacity: [0.3, 0.7],
		backgroundColor: 'transparent'
	})


	</script>
</body>

</html>