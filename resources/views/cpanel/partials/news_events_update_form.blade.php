<?php
  $checked_levels = array();
  if($articles_level_checked) {
    foreach ($articles_level_checked as $level_checked) {
      $checked_levels[] = $level_checked->level_id;
    }
  }

?>

<!-- UPDATE ARTICLE MODAL -->
 <div class="modal fade" id="article_update_modal" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_update_articles" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Event ({{ $article_details->article_title }})</h4>
            </div>

            <div class="modal-body">


                <div id="article_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Event!</h4>
                    <ul></ul>

                </div>

                <?php
                  if($article_details->article_type == 'Events') {
                    $event_fields='display:block';
                  } else {
                    $event_fields='display:none;';
                  }
                ?>

                
                <input type="hidden" name="id" value="{{ $article_details->id }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="help-block has-error text-center" id="general-error"></div>
                </div>

                <div class="form-group">
                  <label for="article_type">Article Type</label>
                  <select class="form-control" name="article_type" id="article_type">
                    <option value="">Select a Article Type</option>
                    <option value="News" {{ ($article_details->article_type == 'News') ? 'selected':'' }}>News</option>
                    <option value="Events" {{ ($article_details->article_type == 'Events') ? 'selected':'' }}>Events</option>
                    <option value="Annoucements" {{ ($article_details->article_type == 'Annoucements') ? 'selected':'' }}>Annoucements</option>
                  </select>
                 
                  <div class="help-block has-error text-center" id="article_type-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="article_title">Title</label>
                  <input type="text" class="form-control" id="article_title" name="article_title" value="{{ $article_details->article_title }}" placeholder="Enter the Article Title Here">
                  <div class="help-block has-error text-center" id="article_title-error"></div>
                </div>

                <div class="form-group event_fields" style="{{ $event_fields }}">
                  <label for="article_eventdate1">Event Start Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="article_eventdate1" name="article_eventdate1" value="{{ $article_details->article_eventdate1 }}" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="help-block has-error text-center" id="article_eventdate1-error"></div>
                </div>

                <div class="form-group event_fields" style="{{ $event_fields }}">
                  <label for="article_eventdate2">Event End Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="article_eventdate2" name="article_eventdate2" value="{{ $article_details->article_eventdate2 }}" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="help-block has-error text-center" id="article_eventdate2-error"></div>
                </div>

                <div class="form-group">
                  <label>Featured Image (Optional)</label>
                  <div class="m-y-3" style="width:200px;">
                    <img src="{{ asset('uploads/articles/'.$article_details->article_featured_img) }}" class="w-100 img-responsive">
                  </div>

                  <div class="input-group w-100">
                    <label for="article_featured_img">Upload New Featured Image?</label>
                    <input type="file" name="article_featured_img" id="article_featured_img">
                    <p>
                      <i>Only accepts: jpg, jpeg, png</i><br>
                      <i>Maximum file size is 3MB</i>
                    </p>
                  </div>

                  <div class="help-block has-error text-center" id="article_featured_img-error"></div>
                </div>                


                <div class="form-group">
                  <label for="article_content">Content Text</label>
                  <textarea id="article_content" rows="10" cols="80">{{ $article_details->article_content }}</textarea>
                  <div class="help-block has-error text-center" id="article_content-error"></div>
                </div>

                <div class="form-group">
                    <label>Applicable Levels <span class="text-red">*</span></label><br>

                    <div class="m-b-2">
                      <input type="checkbox" class="all_levels" name="all_levels" value="All">
                      <span class="m-l-2">All Levels</span>
                    </div>
                    @if($school_level)
                      <div class="input-group w-100">
                        @foreach($school_level as $level)
                            <?php
                              if(in_array($level->id, $checked_levels)) {
                                $check_stat = 'checked';
                              } else {
                                $check_stat = '';
                              }
                            ?>

                            <div class="m-b-2">
                              <input type="checkbox" class="article_levels" name="article_levels[]" value="{{ $level->id }}" {{ $check_stat }}>
                              <span class="m-l-2">{{ $level->level_name }}</span>
                            </div>
                        @endforeach
                      </div>
                    @endif
                    <div class="help-block has-error text-center" id="article_levels-error"></div>
                </div>

                <div class="form-group">
                  <label>Status</label><br>
                  <div class="input-group w-100">
                    <label class="m-r-2">
                      <input type="radio" id="stat1" name="article_status" class="flat-red" value="Published" {{ ($article_details->article_status == 'Published') ? 'checked':'' }}>
                      <span class="m-l-2">Published</span>
                    </label>
                    <label class="m-r-2">
                      <input type="radio" id="stat2" name="article_status" class="flat-red" value="Draft" {{ ($article_details->article_status == 'Draft') ? 'checked':'' }}>
                      <span class="m-l-2">Draft</span>
                    </label>
                  </div>
                  <div class="help-block has-error text-center" id="article_status-error"></div>

                </div>

                <div class="form-group">
                  <label for="article_content">Select / Check Gallery Album for this Article</label>
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
<div class="modal fade" id="article_gallery_modal" >
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
                  $article_images_data = array();
                  if($article_images) {
                    foreach ($article_images as $article_image) {
                      $article_images_data[] = $article_image->gallery_id;
                    }

                  }

                ?>


                  <input type="hidden" name="article_id_fk" id="article_id_fk" value="{{ $article_details->id }}">
                  


                  @if($gallerys)
                    @foreach($gallerys as $gallery)
                      <?php
                        if(in_array($gallery->id, $article_images_data)) {
                          $checkbox_status = 'checked';
                        } else {
                          $checkbox_status = '';
                        }
                      ?>

                      <label for="gal_id_{{ $gallery->id }}" class="col-md-4 album_col">
                        <input type="checkbox" class="album_checkbox" name="gal_id[]" id="gal_id_{{ $gallery->id }}" value="{{ $gallery->id }}" {{ $checkbox_status }}>
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
              <button id="close_article_gal_modal" type="button" class="btn btn-default btn-flat">Close</button>
          </div>
      </form>
      </div>
  </div>
</div>







<script type="text/javascript">
  // ALL LEVELS CHECKBOX
  $('.all_levels').change(function(){
      var checked = !$(this).data('checked');
      $('.article_levels').prop('checked', checked);
      $(this).val(checked ? 'uncheck all' : 'check all' )
      $(this).data('checked', checked);
  });



  $('.picker-date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });

  $('#article_type').change(function() {
    if($(this).val() == 'Events') {
      $('.event_fields').show();
    } else {
      $('.event_fields').hide();
      $("#article_eventdate1").val("");
      $("#article_eventdate2").val("");
    }
  });


  // UPDATE ARTICLES AJAX
  $('#form_update_articles').on('submit', function(e) {
      e.preventDefault();
      var content = CKEDITOR.instances.article_content.getData();
      var form = document.forms.namedItem("form_update_articles"); // high importance!, here you need change "yourformname" with the name of your form
      var formData = new FormData(form);
      formData.append('article_content', content);
      

      $.ajax({
          type: "post",
          dataType: "json",
          contentType: false,
          enctype: 'multipart/form-data',
          url: "{{ route('news_events_update') }}",
          data: formData,
          processData: false,
          success : function (retData) {
            //console.log(retData);
            $('.has-error').html('');

            var event_error_logs;
            if(retData.code == 0) {
                $('#article_validation_error ul').html("");
                $.each(retData.messages, function( index, value ) {
                    event_error_logs="<li>"+value+"</li>";
                    $('#article_validation_error ul').append(event_error_logs);
                });
                $('#article_validation_error').show();


                for(var err in retData.messages) {
                  $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                }

                $('#article_update_modal').scrollTop(0);
                
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
          url: "{{ route('selected_gallery_save') }}",
          data: form_data,
          success : function (retData) {
            var event_error_logs;
            $('#article_gallery_modal').modal('hide');
            setTimeout(function() {
                $('body').addClass('modal-open');
            }, 400);
            $('#article_update_modal').modal('show');
            

          }
      })
  });


  $("#show_albums_btn").click(function() {
    $('.modal.in').modal('hide')
    setTimeout(function() {
        $('body').addClass('modal-open');
    }, 400);
    $('#article_gallery_modal').modal('toggle');
  });


  $("#close_article_gal_modal").click(function() {
    $('#article_gallery_modal').modal('hide');
    setTimeout(function() {
        $('body').addClass('modal-open');
    }, 400);
    $('#article_update_modal').modal('show');
  });
 



</script>

