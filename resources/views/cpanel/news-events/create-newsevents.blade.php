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
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Create New Articles</h3>
          <a href="{{ route('news-events') }}" class="btn btn-primary pull-right">Back to Article List</a>
          <div class="cleafix"></div>
        </div>

        @if (count($errors)>0)
          <div class="callout callout-danger">
            <h4>Error!</h4>
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- FORM START -->
        <form role="form" action="{{ route('save_articles') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group">

              <div class="input-group w-100">  
                <label for="article_type">Article Type</label>
                <select class="form-control" name="article_type" id="article_type">
                  <option value="">Select a Article Type</option>
                  <option value="News">News</option>
                  <option value="Events">Events</option>
                  <option value="Annoucements">Annoucements</option>
                </select>
              </div>
              
              @if ($errors->has('article_type'))
                <div class="help-block text-red">{{ $errors->first('article_type') }}</div>
              @endif
            </div>
            
            <div class="form-group">
              <div class="input-group w-100">
                <label for="article_title">Title</label>
                <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Enter the Article Title Here">
              </div>
              @if ($errors->has('article_title'))
                <div class="help-block text-red">{{ $errors->first('article_title') }}</div>
              @endif
            </div>

            <div class="form-group event_fields" style="display:none;">
              <label for="article_eventdate1">Event Start Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right picker-date" id="article_eventdate1" name="article_eventdate1" placeholder="YYYY-MM-DD">
              </div>

              @if ($errors->has('article_eventdate1'))
                <div class="help-block text-red">{{ $errors->first('article_eventdate1') }}</div>
              @endif
            </div>

            <div class="form-group event_fields" style="display:none;">
              <label for="article_eventdate2">Event End Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right picker-date" id="article_eventdate2" name="article_eventdate2" placeholder="YYYY-MM-DD">
              </div>

              @if ($errors->has('article_eventdate2'))
                <div class="help-block text-red">{{ $errors->first('article_eventdate2') }}</div>
              @endif

            </div>

            <div class="form-group">
              <label for="gaz_pdf_filename">Upload Featured Image (Optional)</label>
              <div class="input-group w-100">
                <input type="file" name="article_featured_img" id="article_featured_img">
                <p><i>Maximum file size is 3MB</i></p>
              </div>

              @if ($errors->has('article_featured_img'))
                <div class="help-block text-red">{{ $errors->first('article_featured_img') }}</div>
              @endif
            </div>



            <div class="form-group">
              <label for="article_content">Content Text</label>
              <div class="input-group w-100">
                <textarea id="article_content" name="article_content" rows="10" cols="80"></textarea>
              </div>

              @if ($errors->has('article_content'))
                <div class="help-block text-red">{{ $errors->first('article_content') }}</div>
              @endif
            </div>

            <div class="form-group">
                <label>Applicable Levels <span class="text-red">*</span></label><br>

                <div class="input-group w-100">
                  <div class="m-b-2">
                    <input type="checkbox" class="all_levels" name="all_levels" value="All">
                    <span class="m-l-2">All Levels</span>
                  </div>
                  @if($school_level)
                    @foreach($school_level as $level)
                        <div class="m-b-2">
                          <input type="checkbox" class="article_levels" name="article_levels[]" value="{{ $level->id }}">
                          <span class="m-l-2">{{ $level->level_name }}</span>
                        </div>
                    @endforeach
                  @endif
                </div>

                @if ($errors->has('article_levels'))
                  <div class="help-block text-red">{{ $errors->first('article_levels') }}</div>
                @endif
            </div>

            <div class="form-group">
              <label for="article_content">Status</label><br>
              <div class="input-group w-100">
                <label class="m-r-2">
                  <input type="radio" id="stat1" name="article_status" class="flat-red" value="Published" checked>
                  <span class="m-l-2">Published</span>
                </label>
                <label class="m-r-2">
                  <input type="radio" id="stat2" name="article_status" class="flat-red" value="Draft">
                  <span class="m-l-2">Draft</span>
                </label>
              </div>

                @if ($errors->has('article_status'))
                  <div class="help-block text-red">{{ $errors->first('article_status') }}</div>
                @endif
            </div>


            
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form><!-- /.FORM -->

        

      </div><!-- /. BOX -->
    </div><!-- /. COL -->
  </div><!-- /. ROW -->

  </section><!-- /. MAIN CONTENT -->




@endsection

@section('additional-scripts')

  <script type="text/javascript">
    // ALL LEVELS CHECKBOX
    $('.all_levels').change(function(){
        var checked = !$(this).data('checked');
        $('.article_levels').prop('checked', checked);
        $(this).val(checked ? 'uncheck all' : 'check all' )
        $(this).data('checked', checked);
    });
  </script>


  <script src="{{ URL::asset('cpanel/plugins/ckeditor/ckeditor.js') }}"></script>
  <script type="text/javascript">
      CKEDITOR.replace( 'article_content',
      {
          toolbar :
          [
              { name: 'document', items : [ 'Source'] },
              { name: 'basicstyles', items : [ 'Bold','Italic' ] },
              { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
              { name: 'tools', items : [ 'Maximize','-','About' ] }
          ]
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

  </script>

@endsection


