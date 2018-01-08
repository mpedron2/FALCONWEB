@extends('layouts.main')
@section('title', 'Falcon School | Our Core Values')
@section('body-contents')
	
  <div class="no-header container m-b-6">
    <div class="row">

      <div class="col-sm-12 col-md-9">
        <div>
          <h1 class="bottom-bar">Core Values</h1>
          <span class="ion-icon ion-ribbon-a"></span>
          <h3 class="m-b-4 h2">Excellence</h3>
          <p>We strive to provide the highest quality services and continually challenge ourselves to be the best.</p>
          
          <ul>
            <li>Proud of personal achievement</li>
            <li>Produces work of the highest quality</li>
            <li>Sets high standards and personal goals for improvement</li>
            <li>Makes best use of talents, time and resources</li>
          </ul>
        </div>


        <div class="m-t-6">
          <span class="ion-icon ion-thumbsup"></span>
          <h3 class="m-b-4 h2">Integrity</h3>
          <p>We are committed to a high standard of integrity. We are devoted to keeping our word and honoring our commitments.</p>

          <ul>
            <li>Shows loyalty to friends, colleagues and the school</li>
            <li>Is willing to support and show care for those who need help</li>
            <li>Keeps the school rules</li>
            <li>Is willing to walk extra miles</li>
          </ul>
        </div>

        <div class="m-t-6">
          <span class="ion-icon ion-ios-people"></span>
          <h3 class="m-b-4 h2">Service</h3>
          <p>We try to understand, determine and deliver what our clienteles want, with a high standard of professionalism.</p>
          <li>Values all members of the school community</li>
          <li>Displays good manners all the times</li>
          <li>Displays tolerance of others with different points of view and beliefs</li>
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
      $("#nav--core-values").addClass('active');
    });
	</script>

  
@endsection 




