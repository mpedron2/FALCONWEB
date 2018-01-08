<!-- FOOTER SCRIPTS --	>
<!-- jQuery 3.1.1 -->
<script src="{{ asset('cpanel/js/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('cpanel/js/bootstrap.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('cpanel/plugins/iCheck/icheck.min.js') }}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

@yield('additional-scripts')