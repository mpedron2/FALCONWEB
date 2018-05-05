@extends('layouts.main')
@section('additional-css')
  <!-- Photoswipe -->
  <link rel="stylesheet" href="{{ asset('assets/lib/photoswipe/photoswipe.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/lib/photoswipe/default-skin/default-skin.css') }}">
@endsection
@section('title', 'Falcon School | Grade School Level')
@section('body-contents')
  
  <?php $inq_level = "Grade School"; ?>

  <div class="no-header container m-b-6">
    <div class="row">

      <!-- LEFT ROW -->
      <div class="col-sm-12 col-md-8">
        <small class="text-muted text-uppercase m-t-3">Levels</small>
        <h1 class="m-b-6 m-t-0">Grade School</h1>
        <ul class="nav nav-pills nav-underline">
          <li id="tabnav-description" role="presentation" class="tabnav active"><a href="#tabDescription" data-toggle="tab">Description</a></li>
          <li id="tabnav-faculty" role="presentation" class="tabnav"><a href="#tabFaculty" data-toggle="tab">Faculty</a></li>
          <li id="tabnav-gallery" role="presentation" class="tabnav"><a href="#tabGallery" data-toggle="tab">Gallery</a></li>
          <li id="tabnav-relatednews" role="presentation" class="tabnav"><a href="#tabRelatedNews" data-toggle="tab">Related News</a></li>
        </ul>

        <div class="tab-content m-y-6">

          <!-- DESCRIPTION -->
          <div class="tab-pane fade in active" id="tabDescription">
            <p>Our Grade School Department offers content rich knowledge which are focused on 21st century learning skills such as:</p>
            <ul>
              <li>Problem-solving</li>
              <li>Critical thinking</li>
              <li>Communication</li>
              <li>Creativity</li>
              <li>Collaboration</li>
              <li>Values Formation</li>
            </ul>

            <p>Relevant knowledge and appropriate skills for the various grade levels are presented in a strengthening manner. Varied, interesting and thought-provoking activities that appeal to the students' diverse learning styles are utilized by competent teachers to ensure mastery of the target skills. The fundamentals in reading and language, established during the preschool years, are further advanced in the grade school. Math concepts become increasingly challenging and abstract as the children become older, training their mathematical and analytical comprehensions. Learning activities are geared towards fostering appreciation for our rich cultural heritage. Group and individual activities develop cooperation, sense of responsibility, creativity and initiative - social skills necessary to ensure their emotional development in an ever-expanding world. Extracurricular activities further enhance the student's talents, skills, sociability, and familiarity with the diverse environment of our society. These include sports activities, field trips, interschool competitions and clubs.</p>
            
          </div>

          
          <!-- FACULTY -->
          <div class="tab-pane fade" id="tabFaculty">
            <figure class="m-b-5">
              <img src="{{ asset('assets/img/grades-1-to-3-faculty.jpg') }}" class="img-responsive w-100 m-b-3"/>
              <figcaption>From left to right, top to bottom: Ru, Levi, Jonas, Lyn, Glen, Nadia, Juna, Roselle, Kath, Jan Lorei, Rein, Joan, Marielle, Murphy, Gemma, Paz, Lai, Bing, Fe, Eunice</figcaption>
            </figure>

            <figure class="m-b-5">
              <img src="{{ asset('assets/img/grades-4-to-6-faculty.jpg') }}" class="img-responsive w-100 m-b-3"/>
              <figcaption>From left to right, top to bottom: Ru, Brodley, Ronnel, James, Dan, Glen, Gemma, Donna, Levi, Kath, Fe, Jovi, Joy, Jen, Marlyn, Marielle, Paz, Lai, Sharmaine, Harriete, Nida</figcaption>
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

              @if (count($related_articles) == 0)
                <p class="text-center">There are no news and/or announcements as of this moment. Please check back again later.</p>
              @endif

            @endif

            <div class="btn-group pull-left" role="group" aria-label="Pagination">
              {!! $related_articles->links() !!}
            </div>

            @if (count($related_articles) != 0)
              <a href="{{ route('article.newsannoucements') }}" class="btn btn-info btn-sm pull-right">View All</a>
            @endif
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
          url:"{{ route('school.level.gallery', ['level' => 'grade-school']) }}",
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




