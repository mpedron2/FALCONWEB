@extends('cpanel.layout.main')
@section('title', 'Gallery')
@section('additional-css')
  <link rel="stylesheet" href="{{ asset('cpanel/css/dropzone.css') }}">
@endsection

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Gallery
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
          <h3 class="box-title">{{ $album->gal_name }}<br><small>Created: <span class="m-l-2 text-red">{{ $album->gal_date }}</span></small></h3>
          <div class="pull-right">
            <a href="{{ route('gallery') }}" class="btn btn-default">Back to Albums</a>
          </div>
          <div class="cleafix"></div>
        </div>

        <div class="box-body">
          <div class="w-100">
            <small>
              <?php echo $album->gal_desc; ?>
            </small>
            <hr>
          </div>

        
          <!-- DISPLAY GALLERY IMAGES -->
          <div class="w-100 m-y-3">
            <p>
              <span class="text-red m-r-2">Note:</span> <strong>DRAG</strong> the images to proper order.
            </p>

            <div id="sortable" class="row">
            @if($gallery_pictures)
              @foreach($gallery_pictures as $images)
                <div id="item-{{ $images->img_id_fk }}" class="col-md-3 col-sm-4 col-xs-6 p-a-3">
                  <p>{{ $images->file_title }}</p>
                  <div class="image_col w-100">
                    <div class="image_col_button text-center">
                      <button type="button" class="btn btn-info btn-sm update_image" data-id="{{ $images->img_id_fk }}" title="Update">
                        <i class="fa fa-pencil"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn-sm delete_button" data-id="{{ $images->img_id_fk }}" title="Delete">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>

                    <img src="{{  asset('uploads/gallery/'.$images->file_filename) }}" class="img-responsive">  
                  </div>

                </div>
              @endforeach
            @endif
            </div>
          </div>

          <!-- UPLOAD GALLERY IMAGES -->
          <h4><strong>Gallery Uploader</strong></h4> 
          <p>
            <ul class="m-l-0 p-l-4">
              <li>Supported File Types: .jpeg, .jpg, .png</li>
              <li>No Image Dimension Restriction</li>
              <li>Up to 2MB per Image</li>
              <li>Maximum of 10 images upload</li>
            </ul>
          </p> 

          <form class="dropzone" method="post" enctype="multipart/form-data" id="image_upload">
            {{ csrf_field() }}
            <input type="hidden" name="gal_id_fk" id="gal_id_fk" value="{{ $album->id }}"> 
            <input type="hidden" name="file_title" id="file_title" value="{{ $album->gal_name }}"> 
            <div class="fallback">
              <input name="file[]" type="file" multiple />
            </div>
          </form>

          <div class="m-y-4 text-center">
            <a href="#" class="btn btn-primary upload_images">Upload</a>
          </div>
          
        </div>

      </div><!-- /. BOX -->
    </div><!-- /. COL -->
  </div><!-- /. ROW -->

  </section><!-- /. MAIN CONTENT -->

  @include('cpanel.partials.delete_modal');
  

@endsection

@section('additional-scripts')

<script src="{{ asset('cpanel/js/dropzone.js') }}"></script>

<script type="text/javascript">
 
  // DROPZONE SCRIPTS
  Dropzone.autoDiscover = false;

  var myDropzone = new Dropzone("#image_upload",{
    url: "{{ route('post_gallery') }}", 
    acceptedFiles: ".jpeg,.jpg,.png,",
    addRemoveLinks: true,
    autoProcessQueue: false,
    parallelUploads: 10,
   
    init: function() {
      var thisDropzone = this;
      this.on("sendingmultiple", function(file, xhr, formData) {
        //Add additional data to the upload
        formData.append('gal_id_fk', $('#gal_id_fk').val());
        formData.append('file_title', $('#file_title').val());       
      });
    }
  });

   myDropzone.on("complete", function (file) {
      if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
          location.reload();
      }
      myDropzone.removeFile(file);
  });

  $('.upload_images').click(function(){           
    myDropzone.processQueue();
  });


  // UPDATE IMAGE TITLE 
  $('.update_image').click(function() {
    var images_id = $(this).data("id");
    show_form_modal({
      method : 'GET',
      modal : '#update_image',
      route : "{{ route('fetch_images_data') }}",
      id : images_id
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


  // DELETE IMAGES
  $(".delete_button").click(function() {
    var images_id = $(this).data("id");
    delete_form_modal({
      method : 'GET',
      route : "{{ route('delete_gallery_images') }}",
      id : images_id
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



  $(function() {
   $('#sortable').sortable({
      update: function (event, ui) {
        var data = $(this).sortable('serialize');
        data = data+'&_token='+'{{ csrf_token() }}';

        // POST to server using $.post or $.ajax
        $.ajax({
            data: data,
            type: 'POST',
            url: '{{ route("images_sorting_save") }}'
        });
      }
    });
    $( "#sortable" ).disableSelection();
  });

</script>


@endsection
