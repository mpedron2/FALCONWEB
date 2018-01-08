<!-- MODAL -->
 <div class="modal fade" id="update_image">
    <div class="modal-dialog" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_update_gallery_images_data" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Image Title / Name</h4>
            </div>

            <div class="modal-body">

                <div id="gal_images_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Updating Image Details!</h4>
                    <ul></ul>

                </div>

                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $FileUploads->id }}">

                <div class="form-group">
                    <div class="help-block text-center" id="general-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="file_title">Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="file_title" name="file_title" value="{{ $FileUploads->file_title }}" placeholder="Enter the Image title">
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>




<script type="text/javascript">
 
  // ADD ACHIVEMENTS AJAX
  $('#form_update_gallery_images_data').on('submit', function(e) {
      e.preventDefault();
      var form_data =  $("#form_update_gallery_images_data").serialize();

      $.ajax({
          type: "post",
          url: "{{ route('images_data_update_save') }}",
          data: form_data,
          success : function (retData) {
            console.log(retData);

            var event_error_logs;
            if(retData.code == 0) {
                $('#gal_images_validation_error ul').html("");
                $.each(retData.messages, function( index, value ) {
                    event_error_logs="<li>"+value+"</li>";
                    $('#gal_images_validation_error ul').append(event_error_logs);
                });
                $('#gal_images_validation_error').show();
                
            } else {
                location.reload();
            }
          }
      })
  });
</script>

