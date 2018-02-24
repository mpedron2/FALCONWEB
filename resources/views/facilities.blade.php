@extends('layouts.main')
@section('title', 'Falcon School | Facilities')
@section('body-contents')


  
  <div class="no-header container m-b-6">
    <div class="row">

      <div class="col-sm-12 col-md-9">
        <h1 class="bottom-bar">Facilities</h1>
        
        
        @if($gal_facilities)
          <div class="row my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
            
            @foreach($gal_facilities as $facilities)
              <div class="col-xs-6 col-md-4 col-sm-3 m-b-2">
                <a href="{{ route('facilities.details', ['id' => $facilities->id]) }}">
                  <div class="w-100 my-gallery-item">
                    <img src="{{  asset('uploads/gallery/'.$facilities->file_filename) }}" class="img-responsive w-100"/>
                  </div>
                </a>
                <p class="p-x-1">{{ $facilities->gal_name }}</p>
              </div>
            @endforeach

          </div>
        @endif  

      </div>

      @include('partials.sidebar-about-us')

    </div>
  </div>


@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');

    $(function(){
      $("#nav--facilities").addClass('active');
    });
	</script>

  
@endsection 




