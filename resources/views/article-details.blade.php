@extends('layouts.main')
@section('title', 'Falcon School')
@section('body-contents')
	<div class="no-header container m-b-6">
      <div class="row">
        <div class="col-sm-12 col-md-9">

          <h1 class="bottom-bar m-b-3">{{ $article_details->article_title }}</h1>
          <small class="text-muted m-b-5">Posted on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($article_details->article_date)) }}</span></small>

          @if(!empty($article_details->	article_featured_img))
	        <div class="w-100">
	          	<img src="{{ asset('uploads/articles/'.$article_details->article_featured_img) }}" class="img-responsive">
	        </div>
	       @endif
          
          <div class="m-y-3">
          	<?= $article_details->article_content ?>
          </div>

          <a href="news-and-announcements.php" class="btn btn-sm btn-info m-y-6">Back to News &amp; Announcements Listing</a>
        </div>
        @include('partials.sidebar-articles')
      </div>
    </div>
@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');
	</script>

@endsection 




