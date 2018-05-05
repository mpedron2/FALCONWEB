<!-- MODAL -->
 <div class="modal fade" id="album_add_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_add_album" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gallery Album</h4>
            </div>

            <div class="modal-body">

                <div id="album_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Album!</h4>
                    <ul></ul>

                </div>

                {{ csrf_field() }}
                <div class="form-group">
                    <div class="help-block text-center" id="general-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="ach_title">Album Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="gal_name" name="gal_name" value="">
                  <div class="help-block has-error text-center" id="gal_name-error"></div>
                </div>

                
                <div class="form-group">
                  <label for="gal_date">Date <span class="text-red">*</span></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="gal_date" name="gal_date" value="" placeholder="yyyy-mm-dd">
                  </div>
                  <div class="help-block has-error text-center" id="gal_date-error"></div>
                </div>


                <div class="form-group">
                  <label for="gal_desc">Description</label>
                  <textarea id="gal_desc" rows="10" cols="80"></textarea>
                  <div class="help-block has-error text-center" id="gal_desc-error"></div>
                </div>

                <div class="form-group">
                  <label>Album Type <span class="text-red">*</span></label><br>
                    <div class="input-group w-100">
                      <div class="m-b-2">
                        <input type="checkbox" class="gallery_type" name="gallery_type[]" value="achivements">
                        <span class="m-l-2">Achievement Gallery</span>
                      </div>

                      <div class="m-b-2">
                        <input type="checkbox" class="gallery_type" name="gallery_type[]" value="articles">
                        <span class="m-l-2">Article Gallery</span>
                      </div>

                      <div class="m-b-2">
                        <input type="checkbox" class="gallery_type" name="gallery_type[]" value="facilities">
                        <span class="m-l-2">Facility</span>
                      </div>

                      <div class="m-b-2">
                        <input type="checkbox" class="gallery_type" name="gallery_type[]" value="gallery">
                        <span class="m-l-2">Miscellaneous Gallery</span>
                      </div>

                      
                    </div>

                    <div class="help-block has-error text-center" id="gallery_type-error"></div>
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
                        <input type="checkbox" class="gal_levels" name="gal_levels[]" value="{{ $level->id }}">
                        <span class="m-l-2">{{ $level->level_name }}</span>
                      </div>
                    @endforeach
                  @endif

                  <div class="help-block has-error text-center" id="gal_levels-error"></div>
                </div>




                <div class="form-group">
                  <label>Status</label><br>
                    <div class="input-group w-100">
                      <label class="m-r-2">
                        <input type="radio" id="stat1" name="gal_status" class="flat-red" value="Published" checked>
                        <span class="m-l-2">Published</span>
                      </label>
                      <label class="m-r-2">
                        <input type="radio" id="stat2" name="gal_status" class="flat-red" value="Draft" >
                        <span class="m-l-2">Draft</span>
                      </label>
                    </div>

                  <div class="help-block has-error text-center" id="gal_status-error"></div>
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


  CKEDITOR.replace( 'gal_desc',{
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
      $('.gal_levels').prop('checked', checked);
      $(this).val(checked ? 'uncheck all' : 'check all' )
      $(this).data('checked', checked);
  });




  // ADD ACHIVEMENTS AJAX
  $('#form_add_album').on('submit', function(e) {
      e.preventDefault();
      var form_data =  $("#form_add_album").serialize();
      var content = CKEDITOR.instances.gal_desc.getData();

      $.ajax({
          type: "post",
          url: "{{ route('gallery_add_save') }}",
          data: form_data+"&gal_desc="+content,
          success : function (retData) {
            $('.has-error').html('');

            var event_error_logs;
            if(retData.code == 0) {
                $('#album_validation_error ul').html("");
                $.each(retData.messages, function( index, value ) {
                    event_error_logs="<li>"+value+"</li>";
                    $('#album_validation_error ul').append(event_error_logs);
                });
                $('#album_validation_error').show();

                for(var err in retData.messages) {
                  $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                }

                $('#album_add_modal').scrollTop(0);
                
            } else {
                location.reload();
            }
          }
      })
  });

  




</script>

