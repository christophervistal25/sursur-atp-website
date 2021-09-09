@include('templates.header')
   <!-- fixed-top-->
   <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="collapse navbar-collapse show" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-block d-md-none text-white"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu"></i>{{  config('app.name') }}</a></li>
            <li class="app-name"><a class="text-white" href="{{  route('admin.dashboard') }}">{{ config('app.name') }}</a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <span class="avatar avatar-online"><img src="{{ asset('/theme-assets/images/portrait/small/{{ Auth::user()->profile }}') }}" alt="avatar"><i></i></span></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="arrow_box_right">
                  <a class="dropdown-item" href="#">
                    <span class="avatar avatar-online">
                      <span class="user-name text-bold-700 ml-1 text-capitalize">{{ Auth::user()->username }}</span>
                    </span>
                  </a>
                  <a  class="dropdown-item" style="cursor:pointer;" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                       <i class="ft-power"></i> Logout
                  </a>
                  <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- ////////////////////////////////////////////////////////////////////////////-->


  <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="theme-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a class="navbar-brand" href="">
            <h3><small>{{ config('app.name') }}</small></h3></a></li>
        <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
      </ul>
    </div>
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="{{ route('admin.dashboard') }}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('personnel.create') }}"><i class="ft-plus"></i><span class="menu-title" data-i18n="">QR for <small class="font-weight-bold">Individual</small></span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('establishment.create') }}"><i class="ft-plus"></i><span class="menu-title" data-i18n="">QR for <small class="font-weight-bold">Establishment</small></span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('personnel.index') }}"><i class="ft-list"></i><span class="menu-title" data-i18n="">View All Personnel</span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('establishment.index') }}"><i class="ft-list"></i><span class="menu-title" data-i18n="">View Establishment</span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('checker.index') }}"><i class="ft-list"></i><span class="menu-title" data-i18n="">View All Checkers</span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('track.index') }}"><i class="ft-map"></i><span class="menu-title" data-i18n="">Track</span></a>
        </li>
        <li class=" nav-item"><a href="{{ route('setting.index') }}"><i class="ft-settings"></i><span class="menu-title" data-i18n="">Settings</span></a>
        </li>
      </ul>
    </div>
    <div class="navigation-background"></div>
  </div>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">@yield('page-title')</h3>
        </div>
      </div>
      <div class="content-body"><!-- Basic Alerts start -->
            @yield('content')
      </div>
    </div>
  </div>
@include('templates.footer')
