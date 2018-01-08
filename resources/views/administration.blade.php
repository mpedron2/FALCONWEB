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
            <div class="admin-social text-center m-t-3">
              <a href="#" class="ion-icon ion-social-facebook p-x-3"></a>
              <a href="#" class="ion-icon ion-social-linkedin p-x-3"></a>
            </div>
          </div>

          <div class="col-md-8">
            <h2>Pacita R. Balatbat</h2>
            <p class="admin-position lead text-muted text-uppercase m-t-0">Directress</p>
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vehicula lorem, nec tristique velit. Fusce orci diam, maximus ac purus at, euismod imperdiet lorem. Quisque vestibulum, tellus sed faucibus feugiat, lectus massa consectetur ligula, id consequat magna odio ac nibh. Donec faucibus nisi vitae convallis aliquam. Cras sodales augue ac purus convallis tempor.</p>
            <ul>
              <li>Has taught at International School of Manila for 36 years.</li>
            </ul>
          </div>
        </div>



        <div class="row m-b-6 p-b-4">
          <div class="col-md-8">
            <h2>Lorelei B. Aunario</h2>
            <p class="admin-position lead text-muted text-uppercase m-t-0">Academic Chairperson</p>
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vehicula lorem, nec tristique velit. Fusce orci diam, maximus ac purus at, euismod imperdiet lorem. Quisque vestibulum, tellus sed faucibus feugiat, lectus massa consectetur ligula, id consequat magna odio ac nibh. Donec faucibus nisi vitae convallis aliquam. Cras sodales augue ac purus convallis tempor.</p>
            <ul>
              <li>Has taught at Ateneo Grade School for 9 years.</li>
            </ul>
          </div>

          <div class="col-md-4">
            <img src="assets/temp/300x350-teal.jpg" class="img-responsive" />
            <div class="admin-social text-center m-t-3">
              <a href="#" class="ion-icon ion-social-facebook p-x-3"></a>
              <a href="#" class="ion-icon ion-social-linkedin p-x-3"></a>
            </div>
          </div>
        </div>

        <div class="row m-b-6 p-b-4">
          <div class="col-md-4">
            <img src="assets/temp/300x350-teal.jpg" class="img-responsive" />
            <div class="admin-social text-center m-t-3">
              <a href="#" class="ion-icon ion-social-facebook p-x-3"></a>
              <a href="#" class="ion-icon ion-social-linkedin p-x-3"></a>
            </div>
          </div>

          <div class="col-md-8">
            <h2>Malou B. Deomano</h2>
            <p class="admin-position lead text-muted text-uppercase m-t-0">Coordinator - Student Affairs</p>
            <h3 class="h4 bottom-bar">Background</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vehicula lorem, nec tristique velit. Fusce orci diam, maximus ac purus at, euismod imperdiet lorem. Quisque vestibulum, tellus sed faucibus feugiat, lectus massa consectetur ligula, id consequat magna odio ac nibh. Donec faucibus nisi vitae convallis aliquam. Cras sodales augue ac purus convallis tempor.</p>
            <ul>
              <li>MA in Basic Education, Ateneo de Manila University.</li>
              <li>Bachelor of Science in Economics, Dean's Medalist, U.P. Diliman, Quezon City</li>
            </ul>
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




