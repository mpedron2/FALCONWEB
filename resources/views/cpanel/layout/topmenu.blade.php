  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>FS</b>CMS</span>
      <span class="logo-lg"><b>Falcon School </b>CMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="#" class="p-y-2"><i class="fa fa-user"></i>
                  Profile
                </a>
                <a href="{{ route('cpanel.logout') }}" class="p-y-2"><i class="fa fa-sign-out"></i>
                  Sign-out
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>