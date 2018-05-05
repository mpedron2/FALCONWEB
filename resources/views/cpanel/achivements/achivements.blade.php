@extends('cpanel.layout.main')
@section('title', 'Achievements')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Achievements
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Achievements</li>
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
            <a href="#" class="btn btn-primary add_achivements_modal">Add an Achievement</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <table id="achivements-tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Title</th>
              <th>Date Awarded</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            
            @if($achivements)
              @foreach($achivements as $achivement)
                <tr>
                  <td>
                    <a href="#" class="text-primary" data-id="{{ $achivement->id }}">{{ $achivement->ach_title }}</a>
                  </td>
                  <td>{{ $achivement->ach_date_awarded }}</td>
                  <td>
                    @if($achivement->ach_status == 'Published')
                      <span class="label bg-blue">Published</span>
                    @elseif($achivement->ach_status == 'Draft')
                      <span class="label bg-yellow">Draft</span>
                    @endif
                  </td>
                  <td> 
                    <button class="btn btn-success update_achivements" data-id="{{ $achivement->id }}">Update</button>  
                    <a href="#" class="btn btn-danger delete_button" data-id="{{ $achivement->id }}">Delete</a>  
                  </td>
                </tr>
              @endforeach
            @endif

             
            
            
            </tbody>
            <tfoot>
            <tr>
              <th>Title</th>
              <th>Date Awarded</th>
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

  // ADD ACHIVEMENTS
  $('.add_achivements_modal').click(function() {
    show_form_modal({
      method : 'POST',
      modal : '#achivements_add_modal',
      route : "{{ route('achivements_add_form') }}"
    });
  });


  // UPDATE ACHIVEMENTS 
  $('.update_achivements').click(function() {
    var ach_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#achivements_update_modal',
      route : "{{ route('fetch_achivements_data') }}",
      id : ach_id
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
  $(".delete_button").click(function() {
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
  } // END OF FUNCTION


 




</script>



@endsection
