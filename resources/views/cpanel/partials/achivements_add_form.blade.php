<!-- MODAL -->
 <div class="modal fade" id="achivements_add_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_add_achivements" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Achivements</h4>
            </div>

            <div class="modal-body">

                <div id="ach_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Achivements!</h4>
                    <ul></ul>

                </div>

                {{ csrf_field() }}
                <div class="form-group">
                    <div class="help-block has-error text-center" id="general-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="ach_title">Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="ach_title" name="ach_title" value="" placeholder="Enter the Achivement Title Here">
                  <div class="help-block has-error text-center" id="ach_title-error"></div>
                </div>

                <div class="form-group">
                  <label for="ach_subtitle">Sub Title</label>
                  <input type="text" class="form-control" id="ach_subtitle" name="ach_subtitle" value="">
                  <div class="help-block has-error text-center" id="ach_subtitle-error"></div>
                </div>

                
                <div class="form-group">
                  <label for="ach_date_awarded">Date Awarded <span class="text-red">*</span></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="ach_date_awarded" name="ach_date_awarded" value="" placeholder="yyyy-mm-dd">
                  </div>
                  <div class="help-block has-error text-center" id="ach_date_awarded-error"></div>
                </div>

                <!-- <div class="form-group">
                  <label class="w-100" for="">Images</label>
                  <div class="btn btn-success upload_web_photos_btn" data-toggle="modal" data-target="#upload_add_modal">Upload / Select Images</div>
                </div> -->



                <div class="form-group">
                  <label for="ach_context">Content Text</label>
                  <textarea id="ach_context" rows="10" cols="80"></textarea>
                  <div class="help-block has-error text-center" id="ach_context-error"></div>
                </div>

                <div class="form-group">
                  <label>Applicable Levels <span class="text-red">*</span></label><br>

                  <div class="m-b-2">
                    <input type="checkbox" class="all_levels" name="all_levels" value="All">
                    <span class="m-l-2">All Levels</span>
                  </div>

                  @if($levels)
                    @foreach($levels as $level)
                      <div class="m-b-2">
                        <input type="checkbox" class="ach_levels" name="ach_levels[]" value="{{ $level->id }}">
                        <span class="m-l-2">{{ $level->level_name }}</span>
                      </div>
                    @endforeach
                  @endif

                  <div class="help-block has-error text-center" id="ach_levels-error"></div>
                </div>

                <div class="form-group">
                  <label>Status</label><br>
                  <div class="input-group w-100">
                    <label class="m-r-2">
                      <input type="radio" id="stat1" name="ach_status" class="flat-red" value="Published" checked>
                      <span class="m-l-2">Published</span>
                    </label>
                    <label class="m-r-2">
                      <input type="radio" id="stat2" name="ach_status" class="flat-red" value="Draft" >
                      <span class="m-l-2">Draft</span>
                    </label>
                  </div>

                  <div class="help-block has-error text-center" id="ach_status-error"></div>
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




@include('cpanel.partials.upload_add_form');




<script type="text/javascript">
  $('.picker-date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });


  CKEDITOR.replace( 'ach_context',{
      toolbar :
      [
          { name: 'document', items : [ 'Source'] },
          { name: 'basicstyles', items : [ 'Bold','Italic' ] },
          { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },

          { name: 'tools', items : [ 'BulletedList', 'NumberedList', '-', 'Maximize','-','About' ] }
      ]
  });


  // ALL LEVELS CHECKBOX
  $('.all_levels').change(function(){
      var checked = !$(this).data('checked');
      $('.ach_levels').prop('checked', checked);
      $(this).val(checked ? 'uncheck all' : 'check all' )
      $(this).data('checked', checked);
  });




  // ADD ACHIVEMENTS AJAX
  $('#form_add_achivements').on('submit', function(e) {
      e.preventDefault();
      var form_data =  $("#form_add_achivements").serialize();
      var content = CKEDITOR.instances.ach_context.getData();

      $.ajax({
          type: "post",
          url: "{{ route('achivements_add_save') }}",
          data: form_data+"&ach_context="+content,
          success : function (retData) {

            $('.has-error').html('');

            var event_error_logs;
            if(retData.code == 0) {
                $('#ach_validation_error ul').html("");
                $.each(retData.messages, function( index, value ) {
                    event_error_logs="<li>"+value+"</li>";
                    $('#ach_validation_error ul').append(event_error_logs);
                });
                $('#ach_validation_error').show();

                for(var err in retData.messages) {
                  $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                }
                
            } else {
                location.reload();
            }
          }
      })
  });

  




</script>

