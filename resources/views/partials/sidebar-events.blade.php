@if($upcoming_events)
	<div class="col-sm-12 col-md-3 p-t-4">
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

		@if(count($upcoming_events) == 0)
			<p>There are no upcoming events in the future. Please check back again later.</p>
		@else
			<a href="{{ route('academic.calendar') }}" class="btn btn-info btn-sm pull-right">See All Events</a>
		@endif
	</div>
@endif