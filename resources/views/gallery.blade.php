@extends('layouts.main')
@section('title', 'Falcon School | Gallery')
@section('body-contents')


  
  <div class="no-header container m-b-6">
    <div class="row">

      <div class="col-sm-12 col-md-12">
        <h1 class="bottom-bar">Gallery</h1>
        
        
        @if($galleries)
          <div class="row my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
            
            @foreach($galleries as $gallery)
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
        @endif  

      </div>

    </div>
  </div>


@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');

	</script>

  
@endsection 




