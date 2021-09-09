  <!-- BEGIN: Mobile Menu -->
  <div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Logo" src="{{ stage_asset('/dist/images/logo.png') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{  route('home') }}" class="menu">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>

        <li>
            <a href="{{  route('user-id') }}" class="menu">
                <div class="menu__icon"> <i data-feather="user-check"></i> </div>
                <div class="menu__title"> Your I.D </div>
            </a>
        </li>

        <li>
            <a href="javascript::" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" class="menu">
                <div class="menu__icon"> <i data-feather="toggle-right"></i> </div>
                <div class="menu__title"> 
                    <span>Logout</span>
                    <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
                     </form>
                 </div>
            </a>
        </li>
    </ul>
</div>
<!-- END: Mobile Menu -->
