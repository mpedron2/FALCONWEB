@extends('layouts.main')
@section('additional-css')
	<!-- Owl Carousel -->
    <link href="{{ asset('assets/lib/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owl.carousel/assets/owl.theme.default.min.css')}}" rel="stylesheet"> 
@endsection

@section('title', 'Falcon School')
@section('body-contents')


	<!-- CAROUSEL -->
	<ul id="myCarousel" class="owl-carousel list-inline m-b-0">
		<li>
			<img src="assets/uploads/slide1.jpg" alt="">
			<div class="container">
				<div class="row">
					<div class="dim">
					 	<div class="carousel-text text-white">
					    	<p class="h1">Lorem ipsum dolor sit amet</p>
					    	<p>Curabitur velit lectus, sollicitudin eget risus id, tempor faucibus </p>
					 	</div>
					</div>
				</div>
			</div>
		</li>

	    <li>
			<img src="assets/uploads/slide2.jpg" alt="">
			<div class="container">
				<div class="row">
					<div class="dim">
						<div class="carousel-text text-white">
					    	<p class="h1">Lorem ipsum dolor sit amet</p>
					    	<p>Curabitur velit lectus, sollicitudin eget risus id, tempor faucibus </p>
						</div>
					</div>
			  	</div>

			</div>
	    </li>

	    <li>
	    	<img src="assets/uploads/slide3.jpg" alt="">

	        <div class="container">
				<div class="row">
					<div class="dim">
					 	<div class="carousel-text text-white">
							<p class="h1">Lorem ipsum dolor sit amet</p>
					    	<p>Curabitur velit lectus, sollicitudin eget risus id, tempor faucibus </p>
					  	</div>
					</div>
				</div>
	        </div>
	    </li>

	</ul><!-- /.carousel -->

	<!-- ABOUT US -->
	<section id="about-us" class="container">
	    <div class="row">
	    	<h1 class="hidden">Falcon School</h1>
	        <h2 class="hidden">We envision Falcon School as an educational institution that nurtures the mind, the heart, and soul of the students to become well-rounded individuals and Filipino leaders in a globalized world.</h2>

	        <div class="col-sm-4 col-xs-12">
	        	<span class="badge-icon ion-icon ion-ribbon-a"></span>
	        	<h3 class="m-b-4 h2">Excellence</h3>
	        	<p>We strive to provide the highest quality services and continually challenge ourselves to be the best.</p>
	        </div>

	        <div class="col-sm-4 col-xs-12">
				<span class="badge-icon ion-icon ion-thumbsup"></span>
				<h3 class="m-b-4 h2">Integrity</h3>
				<p>We are committed to a high standard of integrity. We are devoted to keeping our word and honoring our commitments.</p>
	        </div>

	        <div class="col-sm-4 col-xs-12">
	        	<span class="badge-icon ion-icon ion-ios-people"></span>
	        	<h3 class="m-b-4 h2">Service</h3>
	        	<p>We try to understand, determine and deliver what our clienteles want, with a high standard of professionalism.</p>
	        </div>
	    </div>
	</section> <!-- /.about us -->

	<!-- LEVELS -->
	<section id="levels" class="container-fluid">
	    <div class="row">
	    	<div class="container">
		        <div class="row">

		            <div class="container">
		              <h4 class="text-white h1 m-b-6">Levels</h4>
		            </div>

		            <div class="container-fluid">

			            <div class="row">
			                <div class="col-xs-12 col-sm-6 col-lg-3 col-gap">
			                	<div class="panel panel-default">
				                    <div class="panel-heading">
				                    	<h5 class="panel-title text-center text-uppercase">Pre-School</h5>
				                    </div>

				                    <div class="panel-body">
				                    	<img src="assets/img/pre-school.jpg" class="w-100">
				                    	<p class="m-y-2">Offers developmentally appropriate programs which focus on Language, Math and Social Skills.</p>
				                    	<a href="pre-school-level.php" class="btn btn-info btn-sm pull-right">Read More</a>
				                    </div>
			                	</div>
			                </div>

			              
			                <div class="col-xs-12 col-sm-6 col-lg-3 col-gap">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h5 class="panel-title text-center text-uppercase">Grade School</h5>
									</div>

									<div class="panel-body">
									  <img src="assets/img/grade-school.jpg" class="w-100">
									  <p class="m-y-2">Offers content-rich knowledge such as Problem-Solving, Critical Thinking, Communication, Creativity, Collaboration and Values Formation.</p>
									  <a href="grade-school-level.php" class="btn btn-info btn-sm pull-right">Read More</a>
									</div>
								</div>
			                </div>

			                <div class="col-xs-12 col-sm-6 col-lg-3 col-gap">
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h5 class="panel-title text-center text-uppercase">Junior High School</h5>
									</div>

									<div class="panel-body">
									  <img src="assets/img/jr-high-school.jpg" class="w-100">
									  <p class="m-y-2">Provides a set of activities that will develop their intellectual skills that will prepare the students for the world beyond the four walls of the classroom.</p>
									  <a href="junior-high-level.php" class="btn btn-info btn-sm pull-right">Read More</a>
									</div>
								</div>
			                </div>

			                <div class="col-xs-12 col-sm-6 col-lg-3 col-gap">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h5 class="panel-title text-center text-uppercase">Senior High School</h5>
									</div>

									<div class="panel-body">
										<img src="assets/img/sr-high-school.jpg" class="w-100">
										<p class="m-y-2">Like our Junior High School Department, our Senior High School Department is as dedicated to the holistic rearing of the students.</p>
										<a href="senior-high-level.php" class="btn btn-info btn-sm pull-right">Read More</a>
									</div>
								</div>
			                </div>

			            </div>
		            </div>

		        </div>
	        </div>
	    </div>
	</section><!-- /.levels -->


	<!-- LATEST NEWS, EVENTS, ANNOUNCEMENT -->
	<section id="latest-news" class="container">
		<div class="row">

			<div class="col-xs-12 col-sm-6 col-md-9">
				<div class="row">
					@if($upcoming_events)
						<div class="col-xs-12 col-md-6 hidden visible-md visible-lg visible-xl">
							<h4 class="bottom-bar">Upcoming Events</h4>

							<ul class="list-unstyled list-events">
								@foreach($upcoming_events as $events)
								    <li>
								    	<div class="posting-date pull-left text-center">
									    	<span class="h4">{{ date('d', strtotime($events->article_eventdate1)) }}</span>
									    	{{ date('M', strtotime($events->article_eventdate1)) }}
								    	</div>

										<div class="event-details">
											<h5 class="event-title">{{ $events->article_title }}</h5>
											<p class="event-desc">{{ str_limit(strip_tags($events->article_content), 40) }}</p>
										</div>
								    </li>
								@endforeach
							</ul>

							<a href="{{ route('academic.calendar') }}" class="btn btn-info btn-sm pull-right">See All Events</a>

						</div>
					@endif

					@if($latest_news)
						<div class="col-xs-12 col-md-6">
							<h4 class="bottom-bar">Latest News</h4>

							<ul class="list-unstyled list-news">
								@foreach($latest_news as $news)
									<li>
										<h5 class="h4 m-y-0">{{ $news->article_title }}</h5>
										<small class="text-muted">Posted on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($news->article_date)) }}</span></small>
										<p class="m-t-1 m-b-4">{{ str_limit(strip_tags($news->article_content), 100) }} <a href="{{ route('article.details', ['id' => $news->id] ) }}" class="read-more text-danger text-uppercase">Read More</a></p>
									</li>
								@endforeach
							</ul>

							<a href="{{ route('article.newsannoucements') }}" class="btn btn-info btn-sm pull-right">View All</a>
						</div>
					@endif

					@if($upcoming_events)
						<div class="col-xs-12 col-md-6 hidden visible-xs visible-sm">
							<h4 class="bottom-bar">Upcoming Events</h4>

							<ul class="list-unstyled list-events">
								@foreach($upcoming_events as $events)
								    <li>
								    	<div class="posting-date pull-left text-center">
									    	<span class="h4">{{ date('d', strtotime($events->article_eventdate1)) }}</span>
									    	{{ date('M', strtotime($events->article_eventdate1)) }}
								    	</div>

										<div class="event-details">
											<h5 class="event-title">{{ $events->article_title }}</h5>
											<p class="event-desc">{{ str_limit(strip_tags($events->article_content), 40) }}</p>
										</div>
								    </li>
								@endforeach
							</ul>

							<a href="{{ route('academic.calendar') }}" class="btn btn-info btn-sm pull-right">See All Events</a>

						</div>
					@endif
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-3">
				<h4 class="bottom-bar">The Falcon Gazette</h4>
				<a href="assets/uploads/falcon-gazette-sy-2015-2016.pdf" target="_blank"><img src="assets/temp/falcon-gazette-sy-2015-2016.jpg" alt="falcon-gazette-sy-2015-2016" title="Falcon Gazette SY 2015-2016" class="w-100"></a>
			</div>

		</div>
	</section><!-- /.Latest News, Events, Announcements -->



@endsection

@section('additional-scripts')
	<script src="{{ asset('assets/lib/owl.carousel/owl.carousel.min.js')}}"></script>
	<script type="text/javascript">
	  $('#myCarousel.owl-carousel').owlCarousel({
	    margin:0,
	    loop:true,
	    autoWidth:false,
	    items:1,
	    dots:true
	  });

	</script>
@endsection


