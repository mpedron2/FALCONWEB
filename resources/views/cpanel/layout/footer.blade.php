<!-- FOOTER SCRIPTS --	>
<!-- jQuery 3.1.1 -->
<script src="{{ asset('cpanel/js/jquery-3.1.1.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('cpanel/js/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('cpanel/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('cpanel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cpanel/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('cpanel/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('cpanel/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('cpanel/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('cpanel/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('cpanel/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('cpanel/js/adminlte.min.js') }}"></script>

<script type="text/javascript">
	//Date picker
    $('.picker-date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
</script>

@yield('additional-scripts')