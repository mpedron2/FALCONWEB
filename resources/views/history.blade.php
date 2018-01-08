@extends('layouts.main')
@section('title', 'Falcon School | Our History')
@section('body-contents')

  <div class="no-header container m-b-6">
    <div class="row">

      <div class="col-sm-12 col-md-9">
        <div class="text-justify">
          <h1 class="bottom-bar">History</h1>
          <p>We envision Falcon School as an educational institution that nurtures the mind, the heart, and soul of the students to become well-rounded individuals and Filipino leaders in a globalized world.</p>
          <p>The idea of establishing the school came to Mr. Elpidio Balatbat and his wife, Mrs. Pacita Balatbat, the current Directress of Falcon School, after the graduation of Mrs. Lorelai Balatbat-Aunario, the current Academic Chairperson of Falcon School, from the University of the Philippines College of Education. Because of her passion for teaching and love for children, she began as a grade school teacher at the Ateneo de Manila. Her perseverance and dedication convinced her parents that running her own school was her biggest dream. On November 16, 1997, Falcon Learning Center was established as a small pre-school at Falcon Street, initially offering primary education from nursery to grade three.</p>
          
          <p>Falcon Learning Center got its name from the Falcon bird, a member of the eagle family and known to be the fastest and keenest specie among birds. The Falcon logo resembles much of Ateneo's blue eagle because Mrs. Lai found it difficult to detach herself from Ateneo and teach at this school initially; moreover, it represents the Balatbat family's vision for the children who enroll at the school to soar to great heights like a falcon, achieving excellence and leadership in "a globalized world".</p>

          <p>In 2002, the Grade School Department was moved to a new building at Dahlia Avenue, with the pre-school department remaining at Falcon Street.</p>

          <p>The High School Department was established in 2007 and was relocated to a new building adjacent to the Grade School building at Dahlia Avenue in 2009. The first batch of alumni graduated in March 2011. To provide a well-rounded education for Falconians, a huge gym was constructed in July 2011 and it began operational in April 2012.</p>

          <p>With the full implementation of the K-12 program in school year 2016-2017, the construction of the Senior High School building began in December 2015 and finished completion in July 2016, ready to accommodate the senior high students enrolled in the different strands, namely: HUMSS, GAS, ABM and Graphic Arts and Designs.</p>

          <p>A bigger enrollment is expected in School year 2017-2018 with the school offering of STEM in school year 2017-2018.</p>

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
      $("#nav--history").addClass('active');
    });
	</script>

  
@endsection 




