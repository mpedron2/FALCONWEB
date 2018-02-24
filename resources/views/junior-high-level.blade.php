@extends('layouts.main')
@section('additional-css')
  <!-- Photoswipe -->
  <link rel="stylesheet" href="{{ asset('assets/lib/photoswipe/photoswipe.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/lib/photoswipe/default-skin/default-skin.css') }}">
@endsection
@section('title', 'Falcon School | Junior High School Level')
@section('body-contents')
  <?php $inq_level = "Junior High"; ?>

  <div class="no-header container m-b-6">
    <div class="row">

      <!-- LEFT ROW -->
      <div class="col-sm-12 col-md-8">
        <small class="text-muted text-uppercase m-t-3">Levels</small>
        <h1 class="m-b-6 m-t-0">Junior High School</h1>
        <ul class="nav nav-pills nav-underline">
          <li id="tabnav-description" role="presentation" class="tabnav active"><a href="#tabDescription" data-toggle="tab">Description</a></li>
          <li id="tabnav-faculty" role="presentation" class="tabnav"><a href="#tabFaculty" data-toggle="tab">Faculty</a></li>
          <li id="tabnav-gallery" role="presentation" class="tabnav"><a href="#tabGallery" data-toggle="tab">Gallery</a></li>
          <li id="tabnav-relatednews" role="presentation" class="tabnav"><a href="#tabRelatedNews" data-toggle="tab">Related News</a></li>
        </ul>

        <div class="tab-content m-y-6">

          <!-- DESCRIPTION -->
          <div class="tab-pane fade in active" id="tabDescription">
            <p>Our Junior High School Department provides a set of activities that will develop their intellectual skills that will prepare the students for the world beyond the four walls of the classroom. Students are engaged in activities that help them become active citizens, aware of the significant issues that are happening in their surroundings and their role as Filipinos. They are tested not just to comprehend lectures, but to do things actively with responsibility, to accept the possible consequences of their decisions and actions, and to care for the welfare of other people. They are guided to choose their own career and the life that they want to have in the future, with self-awareness and respect for others. Guided by experienced administrators, nurtured by educated teachers, bounded by disciplined, well-formed and kind peers, they will soar to great heights.</p>
          </div>

          
          <!-- FACULTY -->
          <div class="tab-pane fade" id="tabFaculty">
            <figure class="m-b-5">
              <img src="{{ asset('assets/img/jr-high-school-faculty.jpg') }}" class="img-responsive w-100 m-b-3"/>
              <figcaption>From left to right, top to bottom: Dahn, Karl, Roda, MJ, Khen, Rechelle, Prince, Jerome, Wilson, Derick, Diane C, Darlleah, Jah, Dawn, Ruth, Van, Diane T., Karen, Daisy, Lai, Paz, Malu, Ime</figcaption>
            </figure>
          </div>

          
          <!-- GALLERY -->
          <div class="tab-pane fade" id="tabGallery">
            @if($gallery)
              <div class="row my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                @foreach($gallery as $gal)
                  <figure class="col-sm-12 col-md-4 m-y-3" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" >
                  
                    <div class="load-pswp" data-set="{{ $gal->gallery_id }}">
                      <a href="#" itemprop="contentUrl" class="pswp-thumb w-100 four-three" style="background-image:url('{{  asset('uploads/gallery/'.$gal->file_filename) }}');">
                        <div class="w-100 h-100" itemprop="thumbnail" data-src="{{  asset('uploads/gallery/'.$gal->file_filename) }}"></div>
                      </a>
                    </div>  
                  <p class="p-x-1">{{ $gal->gal_name }}</p>
                </figure>
                @endforeach

              </div>
            @endif

          </div>

          
          <!-- RELATED NEWS -->
          <div class="tab-pane fade" id="tabRelatedNews">
            @if($related_articles)
            <ul class="list-unstyled list-news">
              @foreach($related_articles as $articles)
                <li>
                  <h5 class="h4 m-y-0">{{ $articles->article_title }}</h5>
                  <small class="text-muted">Posted on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($articles->article_date)) }}</span></small>
                  <p class="m-t-1 m-b-4">{{ str_limit(strip_tags($articles->article_content), 200) }} <a href="{{ route('article.details', ['id' => $articles->article_id] ) }}" class="read-more text-danger text-uppercase">Read More</a></p>
                </li>
              @endforeach              
            </ul>
            @endif

            <div class="btn-group pull-left" role="group" aria-label="Pagination">
              {!! $related_articles->links() !!}
            </div>

            <a href="news-and-events.php" class="btn btn-info btn-sm pull-right">View All</a>

          </div>

        </div>
      </div>


      <!-- RIGHT ROW -->
      <div class="col-md-4 col-sm-12">

        <!-- SCHEDULE -->
        <div class="side-widget m-t-6">
          <h3 class="text-center text-muted">Schedule</h3>
          <ul class="list-group">
            <li class="list-group-item">
              <span class="badge badge-left badge-icon ion-icon ion-calendar"></span>
              <span class="badge-label m-y-2">Mon - Fri</span>
            </li>

            <li class="list-group-item">
              <span class="badge badge-left badge-icon ion-icon ion-clock"></span>
              <span class="badge-label m-y-2">8:00 AM - 11:00 AM</span>
            </li>
          </ul>
        </div>

        <!-- INQUIRE NOW -->
        @include('partials.levels-widget')

      </div>

    </div>
  </div>	
  
  @include('partials.pwsp')
@endsection


@section('additional-scripts')
  
  <?php if(isset($_GET['page'])) { ?>
    <script type="text/javascript">
      $('.tab-pane').removeClass('active');
      $('.tab-pane').removeClass('in');
      $('#tabRelatedNews').addClass('active');
      $('#tabRelatedNews').addClass('in');

      $('.tabnav').removeClass('active');
      $('#tabnav-relatednews').addClass('active');

    </script>
  <?php } ?>

  <script type="text/javascript">
    $(function(){
      $('.dropdown-toggle').dropdown();
    });
  </script>

  <!-- PHOTOSWIPE -->
  <script src="{{ asset('assets/lib/photoswipe/photoswipe.min.js') }}"></script>
  <script src="{{ asset('assets/lib/photoswipe/photoswipe-ui-default.min.js') }}"></script>

	<script type="text/javascript">
    $('html').addClass('about-us');

    $(function(){


      $(".load-pswp").click(function(e){
        e.preventDefault();
        var set = $(this).attr("data-set");
        var pswpElement = document.querySelectorAll('.pswp')[0];
        $.ajax({
          type:'post',
          url:"{{ route('school.level.gallery', ['level' => 'junior-high']) }}",
          dataType:'json',
          data : {
            'id': set,
            '_token': '{{ csrf_token() }}'

          },
          success: function (data){
            var items = data;

            var options = {      
              history               : false,
              showHideOpacity       : true,
              bgOpacity             : .95,
              zoomEl                : true,
              hideAnimationDuration : 333,
              showAnimationDuration : 333,
              shareEl               : false
            };

            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();


          }
        });



      });

    });
    
  </script>

  <script type="text/javascript">
    // INQUIRY SUMBIT
    $('#inquireNow').on('submit', function(e) {
        e.preventDefault();
        var form_data =  $("#inquireNow").serialize();
        
        $.ajax({
            type: "post",
            url: "{{ route('contact.form.save') }}",
            data: form_data,
            success : function (retData) {

              $('.has-error').html('');

              var event_error_logs;
              if(retData.code == 0) {
                  for(var err in retData.messages) {
                    $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                  }
                  
              } else {
                $("#inquiry_success").modal();
              }
            }
        })
    });


    $('#inquiry_success').on('hidden.bs.modal', function (e) {
      location.reload();
    });
  </script>

  
@endsection 




