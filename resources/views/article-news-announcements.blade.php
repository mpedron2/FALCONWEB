@extends('layouts.main')
@section('title', 'Falcon School | News &#38; Announcements')
@section('body-contents')
	

  <div class="no-header container m-b-6">
    <div class="row">
      <div class="col-sm-12 col-md-9">

        <div class="w-100 pull-left m-t-3">
          <h1 class="bottom-bar pull-left m-t-0">
            News &amp; Announcements 
          </h1>

          @if(count($news_announcements) != 0)
          <div class="dropdown pull-right">
            <button class="btn btn-default dropdown-toggle" type="button" id="filterBy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              @if(!empty($type))
                {{ $type }}
              @else
                Filter By
              @endif
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="filterBy">
              <li><a href="{{ route('article.newsannoucements') }}">Show All</a></li>
              <li><a href="{{ route('articles.data.filter', ['type' => 'News']) }}">News Articles only</a></li>
              <li><a href="{{ route('articles.data.filter', ['type' => 'Annoucements']) }}">Announcements only</a></li>
            </ul>
          </div>
          @endif
        </div>
        <?php $curr_date = date("Y-m-d"); ?>
        @if($news_announcements)
          <ul class="m-t-6 list-unstyled list-news">
            @foreach($news_announcements as $newsannounce)

              <li>
                <h5 class="h4 m-y-0">{{ $newsannounce->article_title }}</h5>
                <small class="text-muted">Posted on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($newsannounce->article_date)) }}</span></small>
                <p class="m-t-1 m-b-4">{{ str_limit(strip_tags($newsannounce->article_content), 200) }} <a href="{{ route('article.details', ['id' => $newsannounce->id] ) }}" class="read-more text-danger text-uppercase">Read More</a></p>
              </li>
              
            @endforeach

            @if(count($news_announcements) == 0)
              <p style="min-height:300px;">There are no news and/or announcements as of this moment. Please check back again later.</p>
            @endif
          </ul>
        
        @endif

        <div class="btn-group pull-right" role="group" aria-label="Pagination">
          {!! $news_announcements->links() !!}
        </div>


      </div>
      @include('partials.sidebar-events')
    </div>
  </div>


@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');
	</script>

  
@endsection 




