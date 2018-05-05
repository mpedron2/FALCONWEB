@extends('layouts.main')
@section('title', 'Falcon School')
@section('body-contents')
	<div class="no-header container m-b-6">
      <div class="row">
        <div class="col-sm-12 col-md-9">


          <h1 class="bottom-bar m-b-3">{{ $article_details->article_title }}</h1>
          <small class="text-muted m-b-5">Posted on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($article_details->article_date)) }}</span></small>

          @if(!empty($article_details->article_featured_img))
	        <div class="w-100">
	          	<img src="{{ asset('uploads/articles/'.$article_details->article_featured_img) }}" class="img-responsive">
	        </div>
	       @endif
          
          <div class="m-y-6">
          	<?= $article_details->article_content ?>
          </div>

          @if($related_gallery)
            <div class="w-100 m-y-3">
              @if(count($related_gallery) > 0) 
                <h5>View our Related Gallery</h5>
              @endif  
              <div class="row">
                @foreach($related_gallery as $gallery)
                <div class="col-sm-12 col-md-4 m-b-2">
                    <a href="{{ route('gallery.details', ['id' => $gallery->id]) }}">
                      <div class="w-100" style="height:180px; overflow:hidden;">
                        <img src="{{  asset('uploads/gallery/'.$gallery->file_filename) }}" class="img-responsive w-100"/>
                      </div>
                    </a>
                    <p class="p-x-1">{{ $gallery->gal_name }}</p>
                  </div>
                  @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
          @endif

          <div class="w-100">
            <a href="{{ route('article.newsannoucements') }}" class="btn btn-sm btn-info m-y-6">Back to News &amp; Announcements Listing</a>
          </div>
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




