@extends('layouts.main')
@section('title', 'Falcon School | Our Mission &amp; Vision')
@section('body-contents')
	

  <div class="no-header container m-b-6">
    <div class="row">
      
      <div class="col-sm-12 col-md-9">
        <div class="text-justify">
          <h1 class="bottom-bar">Mission &amp; Vision</h1>
          <p class="h4">We envision Falcon School as an educational institution that nurtures the mind, the heart, and soul of the students to become well-rounded individuals and Filipino leaders in a globalized world.</p>

          <p>We, at Falcon School, advocate developmentally appropriate practices to be used in the classroom. This means that the program to be implemented is designed for the age group being served and implemented with attention to the needs and differences of the individual children enrolled. Our mission is to foster a balanced, holistic development of each student in an environment that:</p>

          <ul class="text-left">
            <li>Encourages a passion for academic excellence complemented by extracurricular activities</li>
            <li>Instills Filipino values and appreciation for one's Filipino heritage as international anchors in globalized world</li>
            <li>Promotes concern for society and a sense of socio-civic responsibility</li>
            <li>Recognizes differences and learning styles of its students</li>
            <li>Pursues partnerships among the school administration, faculty and parents in ensuring the child's intellectual, emotional, spiritual and social growth</li>
          </ul>
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
      $("#nav--mission-vision").addClass('active');
    });
	</script>

  
@endsection 




