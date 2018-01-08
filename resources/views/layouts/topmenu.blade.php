<nav class="navbar navbar-default navbar-fixed-top p-b-2">

  <!-- Mini Header -->
  <div class="mini-header text-white p-y-2">
    <div class="container">
      
      <ul class="pull-left list-inline text-uppercase m-b-0 contact-left">
        <li>
          <span class="pull-left ion-icon ion-ios-calendar-outline m-r-2"></span>
          <p class="pull-left">Mon - Sat : 8:00 AM - 5:00 PM</p>
        </li>

        <li>
          <span class="pull-left ion-icon ion-ios-telephone-outline m-r-2"></span>
          <p class="pull-left">Admin / Accounting: <a href="tel:+6329395848" class="text-white">(02) 939 5848</a></p>
        </li>
      </ul>

      <ul class="pull-right list-inline m-b-0 contact-right">
        <li>
          <a class="social-facebook text-white" href="https://www.facebook.com/falconschoolqc/" target="_blank">/falconschoolqc</a>
        </li>
      </ul>

    </div>
  </div>

  <div class="container p-t-2">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="{{ route('indexpage') }}">
        <img src=" {{ asset('assets/img/logo.png') }}" alt="Falcon School" class="h-100 pull-left">
        <div class="pull-left hidden-sm">
          <h1 class="h4">Falcon School</h1>
          <h2 class="lead">Great minds grow at Falcon</h2>  
        </div>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/mission-vision') }}">Mission and Vision</a></li>
            <li><a href="{{ url('/core-values') }}">Core Values</a></li>
            <li><a href="{{ url('/history') }}">History</a></li>
            <li><a href="{{ url('/falcon-hymn') }}">Falcon Hymn</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/administration') }}">Administration</a></li>
            <li><a href="{{ route('facilities.gallery') }}">Facilities</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Levels <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('school.level', ['level' => 'pre-school']) }}">Pre-School</a></li>
            <li><a href="{{ route('school.level', ['level' => 'grade-school']) }}">Grade School</a></li>
            <li><a href="{{ route('school.level', ['level' => 'junior-high']) }}">Junior High School</a></li>
            <li><a href="{{ route('school.level', ['level' => 'senior-high']) }}">Senior High School</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('achievements.data') }}">Achievements</a></li>
          </ul>
        </li>

        <li><a href="{{ route('gallery.all') }}">Gallery</a></li>

        <li><a href="{{ route('article.newsannoucements') }}">News &amp; Events</a></li>

        <li><a href="{{ route('contact.form') }}">Contact Us</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>