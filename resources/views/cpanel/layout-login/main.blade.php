<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	@include('cpanel.layout.header')
<body class="hold-transition login-page">
	@yield('content')
	@include('cpanel.layout.footer')	
</body>
</html>