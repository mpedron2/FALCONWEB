<!doctype html>
<html lang="{{ app()->getLocale() }}">
	@include('livesite.layout.header')
<body>
	<div class="container">
		@yield('content')
	</div>
	@include('livesite.layout.footer')
</body>
</html>