@if($related_articles)
	<div class="col-sm-12 col-md-3 p-t-4">
		<h4 class="bottom-bar">Related Articles</h4>
		<ul class="list-unstyled list-news">
			@foreach($related_articles as $related)
				<li>
					<h5 class="h4 m-y-0">{{ str_limit(strip_tags($related->article_title), 20) }}</h5>
					<small class="text-muted">Posted on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($related->article_date)) }}</span></small>
					<p class="m-t-1 m-b-4">{{ str_limit(strip_tags($related->article_content), 50) }} <a href="{{ route('article.details', ['id' => $related->id] ) }}" class="read-more text-danger text-uppercase">Read More</a></p>
				</li>
			@endforeach
		</ul>
	</div>
@endif