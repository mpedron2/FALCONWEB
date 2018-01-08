<html lang="{{ app()->getLocale() }}" class="home">
	@include('layouts.header')
	<body>
		@include('layouts.topmenu')
		@yield('body-contents')
		@include('layouts.footer')
		@include('layouts.footerscripts')
	</body>
</html>