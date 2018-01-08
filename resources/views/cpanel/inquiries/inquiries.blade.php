@extends('cpanel.layout.main')
@section('title', 'Achivements')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Web Inquiries
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inquiries</li>
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
            <!-- <a href="#" class="btn btn-primary add_achivements_modal">Add New Achivements</a> -->
            <a href="{{ route('cms.iexport.inquiries') }}" class="btn btn-primary">Export to Excel File (xlsx)</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <table id="inquiries-tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th class="no-sort">Date of Inquiry</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Mobile #</th>
              <th>Level</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            
            @if($inquiry_all)
              @foreach($inquiry_all as $inquiries)
                <tr>
                  <td>{{ date('F d, Y | h:i:s a', strtotime($inquiries->created_at)) }}</td>
                  <td>
                    <a href="#" class="text-primary">{{ $inquiries->fullname }}</a>
                  </td>
                  <td><a href="mailto:{{ $inquiries-> email }}">{{ $inquiries-> email }}</a></td>
                  <td>{{ $inquiries->mobile }}</td>
                  <td>{{ $inquiries->level }}</td>                  
                  <td> 
                    <button class="btn btn-success view_inquiry" data-id="{{ $inquiries->id }}">View</button>  
                    <a href="#" class="btn btn-danger delete_button" data-id="{{ $inquiries->id }}">Delete</a>  
                  </td>
                </tr>
              @endforeach
            @endif

             
            
            
            </tbody>
            <tfoot>
            <tr>
              <th>Date of Inquiry</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Mobile #</th>
              <th>Level</th>
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
    $('#inquiries-tbl').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [],
      columnDefs: [{ targets: 'no-sort', orderable: false }]
    });
  });
</script>

<script type="text/javascript">

 
  // VIEW INQUIRIES 
  $('.view_inquiry').click(function() {
    var inq_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#inquiries_view_modal',
      route : "{{ route('cms.inquiries.details') }}",
      id : inq_id
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


  // DELETE INQUIRY
  $(".delete_button").click(function() {
    var inq_id = $(this).data("id");
    delete_form_modal({
      method : 'GET',
      route : "{{ route('cms.inquiries.delete') }}",
      id : inq_id
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
