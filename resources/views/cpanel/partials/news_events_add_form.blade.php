<!-- ADD ARTICLE MODAL -->
 <div class="modal fade" id="article_add_modal" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_add_articles" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Articles</h4>
            </div>

            <div class="modal-body">


                <div id="article_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Articles!</h4>
                    <ul></ul>

                </div>

                {{ csrf_field() }}
                <div class="form-group">
                    <div class="help-block has-error text-center" id="general-error"></div>
                </div>

                <div class="form-group">
                  <label for="article_type">Article Type</label>
                  <select class="form-control" name="article_type" id="article_type">
                    <option value="">Select a Article Type</option>
                    <option value="News">News</option>
                    <option value="Events">Events</option>
                    <option value="Annoucements">Annoucements</option>
                  </select>
                 
                  <div class="help-block has-error text-center" id="article_type-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="article_title">Title</label>
                  <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Enter the Article Title Here">
                  <div class="help-block has-error text-center" id="article_title-error"></div>
                </div>

                <div class="form-group event_fields">
                  <label for="article_eventdate1">Event Start Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="article_eventdate1" name="article_eventdate1" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="help-block has-error text-center" id="article_eventdate1-error"></div>
                </div>

                <div class="form-group event_fields" >
                  <label for="article_eventdate2">Event End Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right picker-date" id="article_eventdate2" name="article_eventdate2" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="help-block has-error text-center" id="article_eventdate2-error"></div>
                </div>

                <div class="form-group">
                  <div class="input-group w-100">
                    <label for="article_featured_img">Featured Image (Optional)</label>
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
                  <textarea id="article_content" rows="10" cols="80"></textarea>
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
                            <div class="m-b-2">
                              <input type="checkbox" class="article_levels" name="article_levels[]" value="{{ $level->id }}" >
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
                      <input type="radio" id="stat1" name="article_status" class="flat-red" value="Published">
                      <span class="m-l-2">Published</span>
                    </label>
                    <label class="m-r-2">
                      <input type="radio" id="stat2" name="article_status" class="flat-red" value="Draft">
                      <span class="m-l-2">Draft</span>
                    </label>
                  </div>
                  <div class="help-block has-error text-center" id="article_status-error"></div>

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
  $('#form_add_articles').on('submit', function(e) {
      e.preventDefault();
      var content = CKEDITOR.instances.article_content.getData();
      var form = document.forms.namedItem("form_add_articles");
      var formData = new FormData(form);
      formData.append('article_content', content);
      

      $.ajax({
          type: "post",
          dataType: "json",
          contentType: false,
          enctype: 'multipart/form-data',
          url: "{{ route('save_articles') }}",
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

                $('#article_add_modal').scrollTop(0);

                
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
          }
      })
  });



</script>

