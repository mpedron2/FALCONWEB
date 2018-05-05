<?php 
  $checked_data = array();
  foreach($achivements_level as $levels_checked){
    $checked_data[] = $levels_checked->level_id;
  }

  $checked_levels_count = count($achivements_level);



?>

<!-- MODAL -->
 <div class="modal fade" id="achivements_update_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_update_achivements" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Achivements - {{ $achivements_details->ach_title }}</h4>
            </div>

            <div class="modal-body">

                <div id="ach_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Achivements!</h4>
                    <ul></ul>

                </div>


                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $achivements_details->id }}">

                <div class="form-group">
                    <div class="help-block text-center" id="general-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="ach_title">Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="ach_title" name="ach_title" value="{{ $achivements_details->ach_title }}" placeholder="Enter the Achivement Title Here">
                  <div class="help-block has-error text-center" id="ach_title-error"></div>
                </div>

                <div class="form-group">
                  <label for="ach_subtitle">Sub Title</label>
                  <input type="text" class="form-control" id="ach_subtitle" name="ach_subtitle" value="{{ $achivements_details->ach_subtitle }}">
                  <div class="help-block has-error text-center" id="ach_subtitle-error"></div>
                </div>

                
                <div class="form-group">
                  <label for="ach_date_awarded">Date Awarded <span class="text-red">*</span></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="ach_date_awarded" name="ach_date_awarded" value="{{ $achivements_details->ach_date_awarded }}" placeholder="yyyy-mm-dd">
                  </div>
                  <div class="help-block has-error text-center" id="ach_date_awarded-error"></div>
                </div>


                <div class="form-group">
                  <label for="ach_context">Content Text</label>
                  <textarea id="ach_context" rows="10" cols="80">{{ $achivements_details->ach_context }}</textarea>
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

                      <?php
                        if(in_array($level->id, $checked_data)) {
                          $checkbox_status = 'checked';
                        } else {
                          $checkbox_status = '';
                        }
                      ?>

                      <div class="m-b-2">
                        <input type="checkbox" class="ach_levels" name="ach_levels[]" value="{{ $level->id }}" {{ $checkbox_status }}>
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
                      <input type="radio" id="stat1" name="ach_status" class="flat-red" value="Published" {{ ($achivements_details->ach_status == 'Published') ? 'checked':'' }}>
                      <span class="m-l-2">Published</span>
                    </label>
                    <label class="m-r-2">
                      <input type="radio" id="stat2" name="ach_status" class="flat-red" value="Draft" {{ ($achivements_details->ach_status == 'Draft') ? 'checked':'' }} >
                      <span class="m-l-2">Draft</span>
                    </label>
                  </div>

                  <div class="help-block has-error text-center" id="ach_status-error"></div>
                </div>

                <div class="form-group">
                  <label for="article_content">Select / Check Gallery Album for this Section</label>
                  <div class="w-100 m-y-3">
                    <a id="show_albums_btn" class="btn btn-warning">Show Albums</a>
                  </div>
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


<!-- GALLERY MODAL -->
<div class="modal fade" id="achivements_gallery_modal" >
  <div class="modal-dialog" role="document">
      <div class="modal-content box box-solid">
      <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
      <form id="form_select_gallery" method="post">
          {{ csrf_field() }}
          <div class="modal-header box-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Select a Photo Gallery Album</h4>
          </div>

          <div class="modal-body">
            <div class="album_container">
              <div class="container-fluid">
                <div class="row">
                <?php
                  $achivements_images_data = array();
                  if($achivements_images) {
                    foreach ($achivements_images as $achivements_image) {
                      $achivements_images_data[] = $achivements_image->gallery_id;
                    }

                  }

                ?>


                  <input type="hidden" name="ach_id_fk" id="ach_id_fk" value="{{ $achivements_details->id }}">
                  
                  @if($gallerys)
                    @foreach($gallerys as $gallery)
                      <?php
                        if(in_array($gallery->gallery_id, $achivements_images_data)) {
                          $checkbox_status = 'checked';
                        } else {
                          $checkbox_status = '';
                        }
                      ?>

                      <label for="gal_id_{{ $gallery->gallery_id }}" class="col-md-4 album_col">
                        <input type="checkbox" class="album_checkbox" name="gal_id[]" id="gal_id_{{ $gallery->gallery_id }}" value="{{ $gallery->gallery_id }}" {{ $checkbox_status }}>
                        <div class="w-100">
                          <img src="{{ asset('cpanel/images/folder-icon.png') }}">
                        </div>
                        <p class="album_name m-y-0">
                          {{ $gallery->gal_name }}    
                        </p>
                      </label>
                    @endforeach
                  @endif

                  
                </div>
              </div>
            </div>
              
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-flat">Select</button>
              <button id="close_achievement_gal" type="button" class="btn btn-default btn-flat">Close</button>
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
  $('#form_update_achivements').on('submit', function(e) {
      e.preventDefault();
      var form_data =  $("#form_update_achivements").serialize();
      var content = CKEDITOR.instances.ach_context.getData();

      $.ajax({
          type: "post",
          url: "{{ route('achivements_update_save') }}",
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

                $('#achivements_update_modal').scrollTop(0);
                
            } else {
                location.reload();
            }
          }
      })
  });


  // SELECt GALLERY AJAX
  $('#form_select_gallery').on('submit', function(e) {
      e.preventDefault();
      var form_data =  $("#form_select_gallery").serialize();


      $.ajax({
          type: "post",
          url: "{{ route('ach_selected_gallery_save') }}",
          data: form_data,
          success : function (retData) {
            var event_error_logs;

            $('#achivements_gallery_modal').modal('hide');
            setTimeout(function() {
                $('body').addClass('modal-open');
            }, 400);
            $('#achivements_update_modal').modal('show');
                    
          }
      })
  });



  $("#show_albums_btn").click(function() {
    $('.modal.in').modal('hide')
    setTimeout(function() {
        $('body').addClass('modal-open');
    }, 400);
    $('#achivements_gallery_modal').modal('toggle');
  });


  $("#close_achievement_gal").click(function() {
    $('#achivements_gallery_modal').modal('hide');
    setTimeout(function() {
        $('body').addClass('modal-open');
    }, 400);
    $('#achivements_update_modal').modal('show');
  });

</script>

