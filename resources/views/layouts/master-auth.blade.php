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

<body class="layout-3 @yield('bg-color', 'bg-light')">
	<div id="app">		
		@yield('content')
	</div>

	@include('layouts.script-extension')

	@yield('script')
	@stack('script')
</body>

</html>