@extends('cpanel.layout.main')
@section('title', 'Accounts')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Accounts
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Achivements</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">

        <div class="box-header">
          <!-- <h3 class="box-title">Hover Data Table</h3> -->
          <div class="pull-right">
            <a href="#" class="btn btn-primary add_account_modal">Add new account</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <table id="accounts-tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            
            @if($users)
              @foreach($users as $user)
                <tr>
                  <td>
                    <a href="#" class="text-primary" data-id="{{ $user->id }}">{{ $user->name }}</a>
                  </td>
                  <td>{{ $user->email }}</td>
                  <td class="text-capitalize">
                    {{ $user->role_name }}
                  </td>
                  <td>
                    @if($role_restriction->position != 3)
                      @if(Auth::user()->id == 1) 
                        <button class="btn btn-success update_account" data-id="{{ $user->id }}">Update</button>
                      @else

                        @if($user->role_name == 'superadmin')
                          <button class="btn btn-success update_account" data-id="{{ $user->id }}">Update</button>
                        @else
                          <button class="btn btn-success update_account" data-id="{{ $user->id }}">Update</button>
                          <a href="#" class="btn btn-danger delete_button" data-id="{{ $user->id }}">Delete</a>
                        @endif

                      @endif
                      
                    @else
                      @if(Auth::user()->id == $user->id)
                        <button class="btn btn-success update_account" data-id="{{ $user->id }}">Update</button> 
                      @endif
                    @endif  
                  </td>
                </tr>
              @endforeach
            @endif

            </tbody>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>

      </div><!-- /. BOX -->
    </div><!-- /. COL -->
  </div><!-- /. ROW -->

  </section><!-- /. MAIN CONTENT -->

  @include('cpanel.partials.delete_modal');
  

@endsection

@section('additional-scripts')

<script src="{{ asset('cpanel/plugins/ckeditor/ckeditor.js') }}"></script>

<script>
  $(function () {
    $('#accounts-tbl').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script type="text/javascript">

  // ADD ACCOUNT
  $('.add_account_modal').click(function() {
    show_form_modal({
      method : 'POST',
      modal : '#account_add_modal',
      route : "{{ route('account.add.form') }}"
    });
  });


  // UPDATE ACCOUNT 
  $('.update_account').click(function() {
    var usr_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#account_update_modal',
      route : "{{ route('account.data.fetch') }}",
      id : usr_id
    });
  });
    


  // SHOW MODAL FORM FUNCTION
  function show_form_modal (data){
    var formData = {_token : '{{ csrf_token() }}'};
    if (data.id) {
        var formData = {_token : '{{ csrf_token() }}', id : data.id};
    }


    $.ajax({
        url : data.route,
        type : data.method,
        data : formData,
        success : function (retData) {
            $('.js-modal_holder').html(retData);
            $(data.modal).modal();

            
        }
    });
  } // END OF FUNCTION


  // DELETE ACCOUNT
  $(".delete_button").click(function() {
    var usr_id = $(this).data("id");
    delete_form_modal({
      method : 'GET',
      route : "{{ route('account.delete') }}",
      id : usr_id
    });
  });

  function delete_form_modal (data){
    $("#modal-danger").modal();

    var formData = {_token : '{{ csrf_token() }}'};
    if (data.id) {
        var formData = {_token : '{{ csrf_token() }}', id : data.id};
    }

    $(".delete_confirm").click(function() {
      $.ajax({
          url : data.route,
          type : data.method,
          data : formData,
          success : function (retData) {
            location.reload();
          }
      });
    });
  } // END OF FUNCTION


 




</script>



@endsection
