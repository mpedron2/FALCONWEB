@extends('layouts.main')
@section('title', 'Falcon School | Falcon Hymn')
@section('body-contents')

  <div class="no-header container m-b-6">
    <div class="row">

      <div class="col-sm-12 col-md-9">
        <div class="text-center">
          <h1 class="bottom-bar text-left">Falcon Hymn</h1>
          <audio controls>
            <source src="{{ asset('assets/uploads/falcon-hymn.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
          </audio>

          <p><em>Chorus:</em></p>

          <p>Soar, Falcons, soar high,<br/>

          To heights up above;<br/>

          Spread your strong wings and be free,<br/>

          Lead us in truth, justice, and love.</p>

          <p><em>I.</em></p>

          <p>There's a whole new world we see -<br/>

          Many things we can do.<br/>

          In your strength in us we ask,<br/>

          That you come and guide our way.</p>

          <p><em>(Repeat Chorus)</em></p>

          <p><em>II.</em></p>

          <p>Give us the wings of a falcon.<br/>

          We will soar into the clear sky.<br/>

          Give us the eyes of tomorrow,<br/>

          To see the light and do what's right.</p>

          <p><em>(Repeat Chorus)</em></p>

          <p>Falcon School, our dear alma mater,<br/>

          Spread your wings -- Falconians!<br/>

          Lead us to victory.</p>

      </div>
    </div>

    @include('partials.sidebar-about-us')

    </div>
  </div>


@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');

    $(function(){
      $("#nav--falcon-hymn").addClass('active');
    });
	</script>

  
@endsection 




