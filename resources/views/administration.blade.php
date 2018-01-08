@extends('layouts.main')
@section('title', 'Falcon School | Administration')
@section('body-contents')


  <div class="no-header container m-b-6">

    <div class="row">
      <div class="col-sm-12 col-md-9">
        <h1 class="bottom-bar">Administration</h1>
        
        <div class="row m-b-6 p-b-4">
          <div class="col-md-4">
            <img src="assets/temp/300x350-teal.jpg" class="img-responsive" />
          </div>

          <div class="col-md-8">
            <h2>Mr. Elpidio Balatbat </h2>
            <!-- <p class="admin-position lead text-muted text-uppercase m-t-0">Directress</p> -->
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Sir Elpidio Balatbat finished college in the University of the East. He pursued his Masters in Business Administration in Ateneo de Manila University. He was the Vice President of the Administration in Ayala Life, Group of Companies before establishing Falcon Learning Center.</p>
          </div>
        </div>



        <div class="row m-b-6 p-b-4">
          <div class="col-md-8">
            <h2>Mrs. Pacita Balatbat</h2>
            <!-- <p class="admin-position lead text-muted text-uppercase m-t-0">Academic Chairperson</p> -->
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Mrs. Pacita Balatbat finished Cum Laude in St. Louis University – Baguio with the course of BS Education. She pursued her Masteral Studies in Language Teaching at the University of the Philippines and Michigan State University, USA. She was a classroom teacher at International School of Manila (ISM) for 36 years. She taught English as a Second Language (ESL) to non-English speaking nationalities.</p>
          </div>

          <div class="col-md-4">
            <img src="assets/temp/300x350-teal.jpg" class="img-responsive" />
          </div>
        </div>

        <div class="row m-b-6 p-b-4">
          <div class="col-md-4">
            <img src="assets/temp/300x350-teal.jpg" class="img-responsive" />
          </div>

          <div class="col-md-8">
            <h2>Mrs. Lorelei Balatbat-Aunario</h2>
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Mrs. Lorelei Balatbat – Aunario finished Magna Cum Laude in the University of the Philippines Diliman with the course of BS Early Childhood Education. She continued her Masteral Studies in Child Psychology in Ateneo de Manila University, where she also taught.</p>
          </div>
        </div>


        <div class="row m-b-6 p-b-4">
          <div class="col-md-8">
            <h2>Mrs. Ma. Lucila Balatbat-Deomano</h2>
            <!-- <p class="admin-position lead text-muted text-uppercase m-t-0">Academic Chairperson</p> -->
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Mrs. Malou Balatbat – Deomano finished Dean’s Medalist in the University of the Philippines Dimilan with the course of Bachelor of Science in Economics. She took her MA in Basic Education in Ateneo de Manila University. She was formerly the Branch Manager of Robinson’s Bank, Libis Branch. She was also a Sales Officer for Bank of America Savings Bank. </p>
          </div>

          <div class="col-md-4">
            <img src="assets/temp/300x350-teal.jpg" class="img-responsive" />
          </div>
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
      $("#nav--administration").addClass('active');
    });
	</script>

  
@endsection 




