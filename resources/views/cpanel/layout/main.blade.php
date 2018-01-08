<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	@include('cpanel.layout.header')
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('cpanel.layout.topmenu')
		@include('cpanel.layout.sidebar')
		<div class="content-wrapper">
			@yield('content')
		</div>
	</div>
	<div class="js-modal_holder"></div>
	@include('cpanel.layout.footer')	
</body>
</html>