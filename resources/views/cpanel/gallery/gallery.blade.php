@extends('cpanel.layout.main')
@section('title', 'Gallery')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gallery
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Gallery</li>
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
            <a href="#" class="btn btn-primary add_album_modal">Add New Album</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <table id="gallery-tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Album Title</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            
            @if($gallery)
              @foreach($gallery as $albums)
                <tr>
                  <td>
                    <a href="#" class="text-primary" data-id="{{ $albums->id }}">{{ $albums->gal_name }}</a>
                  </td>
                  <td>{{ $albums->gal_date }}</td>
                  <td>
                    @if($albums->gal_status == 'Published')
                      <span class="label bg-blue">Published</span>
                    @elseif($albums->gal_status == 'Draft')
                      <span class="label bg-yellow">Draft</span>
                    @endif
                  </td>
                  <td> 
                    <a href="#" class="btn btn-sm btn-primary update_album" data-id="{{ $albums->id }}">Update Album</a>  
                    <a href="{{ route('manage_gallery', ['id' => $albums->id] ) }}" class="btn btn-sm btn-success" data-id="">Manage Gallery</a>  
                    <a href="#" class="btn btn-sm btn-danger delete_button" data-id="{{ $albums->id }}">Delete</a>  
                  </td>
                </tr>
              @endforeach
            @endif

             
            
            
            </tbody>
            <tfoot>
            <tr>
              <th>Album Title</th>
              <th>Date</th>
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
    $('#gallery-tbl').DataTable({
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

  // ADD ALBUM MODAL
  $('.add_album_modal').click(function() {
    show_form_modal({
      method : 'POST',
      modal : '#album_add_modal',
      route : "{{ route('album_add_modal') }}"
    });
  });


  // UPDATE ACHIVEMENTS 
  $('.update_album').click(function() {
    var album_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#album_update_modal',
      route : "{{ route('fetch_album_data') }}",
      id : album_id
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


  // DELETE ACHIVEMENTS
  /*$(".delete_button").click(function() {
    var ach_id = $(this).data("id");
    delete_form_modal({
      method : 'GET',
      route : "{{ route('achivements_delete') }}",
      id : ach_id
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
  } // END OF FUNCTION*/


 




</script>



@endsection
