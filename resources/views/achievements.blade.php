@extends('layouts.main')
@section('additional-css')
  <style type="text/css">
    .achievements {
      min-height:50%; 
    }
  </style>
@endsection
@section('title', 'Falcon School | Achievements')
@section('body-contents')

  <div class="no-header container m-b-6">
    <div class="row">

      <div>

        <div class="w-100 pull-left m-t-3">
          <div class="pull-left">
            <small class="text-muted text-uppercase m-t-3">Levels</small>
            <h1 class="bottom-bar m-b-6 m-t-0">Achievements</h1>  
          </div>



          <div class="dropdown pull-right m-t-4">
            <button class="btn btn-default dropdown-toggle" type="button" id="filterByYear" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Year
              <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="filterByYear">
              <li><a href="#" class="ach_filter_year" data-year="">Show All</a></li>
              <li><a href="#" class="ach_filter_year" data-year="2017">2017</a></li>
              <li><a href="#" class="ach_filter_year" data-year="2016">2016</a></li>
              <li><a href="#" class="ach_filter_year" data-year="2015">2015</a></li>
              <li><a href="#" class="ach_filter_year" data-year="2014">2014</a></li>
            </ul>
          </div>



          <div class="dropdown pull-right m-r-3 m-t-4">
            <button class="btn btn-default dropdown-toggle" type="button" id="filterByLevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Level
              <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="filterByLevel">
              <li><a href="#" class="ach_filter_level" data-level="">Show All</a></li>
              <li><a href="#" class="ach_filter_level" data-level="pre-school">Pre-School</a></li>
              <li><a href="#" class="ach_filter_level" data-level="grade-school">Grade School</a></li>
              <li><a href="#" class="ach_filter_level" data-level="junior-high">Jr. High School</a></li>
              <li><a href="#" class="ach_filter_level" data-level="senior-high">Sr. High School</a></li>
            </ul>
          </div>

        </div>


        @if($achievements_data_all)
          @if (count($achievements_data_all) > 0)
          <section class="achievements">
              @include('partials.achievement-data')
          </section> 
          @endif
        @else
          <div class="row" id="load">
              <div class="tile col-xs-12 col-sm-12 col-md-12 m-b-2 text-center">
                <div class="va-container">
                    <p>No Data</p>
                </div>
              </div>
          </div>

        @endif

        

      </div>

    </div>
  </div>

@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');

    $(function(){
      $("#nav--news-and-announcements").addClass('active');
    });
	</script>

  <script type="text/javascript">

    $(function() {
        var year = "";
        var level = "";

        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');  
            getAchievements(url);
            window.history.pushState("", "", url);
        });

        function getAchievements(url) {
            $.ajax({
                url : url  
            }).done(function (data) {
                $('.achievements').html(data);  
            }).fail(function () {
                alert('Achievements data could not be loaded.');
            });
        }

        

        $('.ach_filter_level').click(function() {
          level = $(this).data('level');

          if(level == "") {
            $("#filterByLevel").html('Level <span class="caret"></span>');
          } else {
            $("#filterByLevel").html(level+' <span class="caret"></span>');
          }

          if(year == "") {
            $("#filterByYear").html('Year <span class="caret"></span>');
          } else {
            $("#filterByYear").html(year+' <span class="caret"></span>');
          }

          $.ajax({
              type: "get",
              url: "{{ route('achievements.data') }}",
              data: {
                'level': level,
                'year': year
              },
              success : function (retData) {
                 $('.achievements').html(retData); 
              },

              error : function() {
                console.log('Achivements Filter Error - Level');
              }
          });
                  

        });  

        $('.ach_filter_year').click(function() {
          year = $(this).data('year');

          if(level == "") {
            $("#filterByLevel").html('Level <span class="caret"></span>');
          } else {
            $("#filterByLevel").html(level+' <span class="caret"></span>');
          }

          if(year == "") {
            $("#filterByYear").html('Year <span class="caret"></span>');
          } else {
            $("#filterByYear").html(year+' <span class="caret"></span>');
          }


          $.ajax({
              type: "get",
              url: "{{ route('achievements.data') }}",
              data: {
                'level': level,
                'year': year
              },
              success : function (retData) {
                $('.achievements').html(retData); 
              },

              error : function() {
                console.log('Achivements Filter Error - year');
              }
          });

        });





    });

  </script>

  
@endsection 




