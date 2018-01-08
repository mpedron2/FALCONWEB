<!-- MODAL -->
 <div class="modal fade" id="gazette_add_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_add_gazette" name="form_add_gazette" method="post" enctype="multipart/form-data">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Falcon Gazette</h4>
            </div>

            <div class="modal-body">

                <div id="gaette_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Achivements!</h4>
                    <ul></ul>

                </div>

                {{ csrf_field() }}
                <div class="form-group">
                    <div class="help-block text-center" id="general-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="gaz_title">Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="gaz_title" name="gaz_title" value="" placeholder="Enter the Achivement Title Here">
                  <div class="help-block has-error text-center" id="gaz_title-error"></div>
                </div>

                
                <div class="form-group">
                  <label for="gaz_date">Date <span class="text-red">*</span></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="gaz_date" name="gaz_date" value="" placeholder="yyyy-mm-dd">
                  </div>
                  <div class="help-block has-error text-center" id="gaz_date-error"></div>
                </div>


                <div class="form-group">
                  <label for="gaz_pdf_filename">Upload PDF</label>
                  <div class="input-group w-100">
                    <input type="file" name="gaz_pdf_filename" id="gaz_pdf_filename">
                  </div>
                  <div class="help-block has-error text-center" id="gaz_pdf_filename-error"></div>
                </div>


                <div class="form-group">
                  <label>Status</label><br>
                  <div class="input-group w-100">
                    <label class="m-r-2">
                      <input type="radio" id="stat1" name="gaz_status" class="flat-red" value="Published" checked>
                      <span class="m-l-2">Published</span>
                    </label>
                    <label class="m-r-2">
                      <input type="radio" id="stat2" name="gaz_status" class="flat-red" value="Draft" >
                      <span class="m-l-2">Draft</span>
                    </label>
                  </div>

                  <div class="help-block has-error text-center" id="gaz_status-error"></div>
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
  $('.picker-date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });


  // ADD GAZETTE AJAX
  $('#form_add_gazette').on('submit', function(e) {
      e.preventDefault();
      var form = document.forms.namedItem("form_add_gazette"); // high importance!, here you need change "yourformname" with the name of your form
      var formdata = new FormData(form); // high importance!

      $.ajax({
          async: true,
          type: "POST",
          dataType: "json", // or html if you want...
          contentType: false, // high importance!
          enctype: 'multipart/form-data',
          url: "{{ route('gazette_add_save') }}", // you need change it.
          data: formdata, // high importance!
          processData: false, // high importance!
          success: function (retData) {
            var event_error_logs;
            $('.has-error').html('');

            if(retData.code == 0) {
                $('#gaette_validation_error ul').html("");
                $.each(retData.messages, function( index, value ) {
                    event_error_logs="<li>"+value+"</li>";
                    $('#gaette_validation_error ul').append(event_error_logs);
                });
                $('#gaette_validation_error').show();

                for(var err in retData.messages) {
                  $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                }

            } else if(retData.code == 2) {
              $('#gaette_validation_error ul').html("");
              event_error_logs = "<li>"+retData.messages+"</li>";
              $('#gaette_validation_error ul').append(event_error_logs);

              for(var err in retData.messages) {
                $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
              }
            } else {
                location.reload();
            }

          },
          timeout: 10000
      });



      return false;

     
  });
</script>

