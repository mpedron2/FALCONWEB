@extends('cpanel.layout.main')
@section('title', 'News, Events &#38; Annoucements')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      News, Events &#38; Annoucements
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">News, Events &#38; Annoucements</li>
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
            <a href="#" class="btn btn-primary add_article">Add New Article</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th width="40%">Article Details</th>
              <th>Posting Date</th>
              <th>Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            @if($news_events)
              @foreach($news_events as $articles)

              <tr>
                <td>
                  <a href="#" class="text-primary">{{ $articles->article_title }}</a>
                  <p>{{ str_limit(strip_tags($articles->article_content), 100) }}</p>
                </td>
                <td>
                  {{ $articles->article_date }}
                </td>
                <td>{{ $articles->article_type }}</td>
                <td>
                  @if ($articles->article_status == 'Published')
                    <span class="label bg-blue">Published</span>
                  @elseif($articles->article_status == 'Draft')
                    <span class="label bg-yellow">Draft</span>
                  @endif
                </td>
                <td>
                  <button class="btn btn-success update_article" data-id="{{ $articles->id }}">Update</button>  
                  <a href="#" class="btn btn-danger delete_button" data-id="{{ $articles->id }}">Delete</a>  
                </td>
              </tr>

              @endforeach
            @endif

           
            
            
            </tbody>
            <tfoot>
            <tr>
              <th>Article Details</th>
              <th>Posting Date</th>
              <th>Type</th>
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
    $('#example2').DataTable({
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

  // ADD ARTICLE 
  $('.add_article').click(function() {
    var article_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#article_add_modal',
      route : "{{ route('news_events_add') }}"
    });
  });


  // UPDATE ARTICLE 
  $('.update_article').click(function() {
    var article_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#article_update_modal',
      route : "{{ route('fetch_articles_data') }}",
      id : article_id
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

            CKEDITOR.replace( 'article_content',{
                toolbar :
                [
                    { name: 'document', items : [ 'Source'] },
                    { name: 'basicstyles', items : [ 'Bold','Italic' ] },
                    { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                    { name: 'tools', items : [ 'Maximize','-','About' ] }
                ]
            });
        }
    });
  } // END OF FUNCTION


  // DELETE ARTICLE
  $(".delete_button").click(function() {
    var article_id = $(this).data("id");
    delete_form_modal({
      method : 'GET',
      route : "{{ route('news_events_delete') }}",
      id : article_id
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
