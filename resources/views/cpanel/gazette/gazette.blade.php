@extends('cpanel.layout.main')
@section('title', 'Falcon Gazette')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Falcon Gazette
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Falcon Gazette</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">

        <div class="box-header">
          <div class="pull-right">
            <a href="#" class="btn btn-primary add_gazette_modal">Upload a new Gazette</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <table id="achivements-tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Date</th>
              <th>Title</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            @if($falcon_gazette)
              @foreach($falcon_gazette as $gazette)
                <tr>
                  <td>{{ $gazette->gaz_date }}</td>

                  <td>
                    <a href="#" class="text-primary" data-id="{{ $gazette->id }}">{{ $gazette->gaz_title }}</a>
                  </td>
                  <td>
                    @if($gazette->gaz_status == 'Published')
                      <span class="label bg-blue">Published</span>
                    @elseif($gazette->gaz_status == 'Draft')
                      <span class="label bg-yellow">Draft</span>
                    @endif
                  </td>

                  <td> 
                    <button class="btn btn-success update_gazette" data-id="{{ $gazette->id }}">Update</button>  
                    <a href="#" class="btn btn-danger delete_button" data-id="{{ $gazette->id }}">Delete</a>  
                  </td>
                </tr>
              @endforeach
            @endif

            
            </tbody>
            <tfoot>
            <tr>
              <th>Date</th>
              <th>Title</th>
              <th>Status</th>
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
    $('#achivements-tbl').DataTable({
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

  // ADD GAZETTE
  $('.add_gazette_modal').click(function() {
    show_form_modal({
      method : 'POST',
      modal : '#gazette_add_modal',
      route : "{{ route('gazette_add_form') }}"
    });
  });


  // UPDATE GAZETTE 
  $('.update_gazette').click(function() {
    var gaz_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#gazette_update_modal',
      route : "{{ route('fetch_gazette_data') }}",
      id : gaz_id
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


  // DELETE GAZETTE
  $(".delete_button").click(function() {
    var gaz_id = $(this).data("id");
    delete_form_modal({
      method : 'GET',
      route : "{{ route('gazette_delete') }}",
      id : gaz_id
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
