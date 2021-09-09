  <!-- BEGIN: Mobile Menu -->
  <div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Logo"  src="{{ stage_asset('/dist/images/logo.png') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{  route('municipal.dashboard') }}" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="grid"></i> </div>
                <div class="menu__title"> Generate QR <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('municipal-personnel.create') }}" class="menu">
                        <div class="menu__icon"> <i data-feather="user"></i> </div>
                        <div class="menu__title"> Personnel </div>
                    </a>
                </li>
                <li>
                    <a href="{{  route('m-establishment.create') }}" class="menu">
                        <div class="menu__icon"> <i data-feather="home"></i> </div>
                        <div class="menu__title"> Establishment </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> People  <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
        <li>
            <a href="{{  route('municipal-personnel.index') }}" class="menu">
                <div class="menu__icon"> <i data-feather="list"></i> </div>
                <div class="menu__title"> View All </div>
            </a>
        </li>
    </ul>
 </li>
        
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="shield"></i> </div>
                <div class="menu__title"> Checkers <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{  route('m-checker.index') }}" class="menu">
                        <div class="menu__icon"> <i data-feather="list"></i> </div>
                        <div class="menu__title"> View All </div>
                    </a>
                </li>
                <li>
                    <a href="{{  route('m-checker.create') }}" class="menu">
                        <div class="menu__icon"> <i data-feather="user-plus"></i> </div>
                        <div class="menu__title"> Add Checker </div>
                    </a>
                </li>
                <li>
                    <a href="{{  route('m-checker.index', ['menu_edit' => true]) }}" class="menu">
                        <div class="menu__icon"> <i data-feather="edit-3"></i> </div>
                        <div class="menu__title"> Edit Checker </div>
                    </a>
                </li>
            </ul>
            </li>
        
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> Establishments <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
            <li>
                <a href="{{  route('m-establishment.index') }}" class="menu">
                    <div class="menu__icon"> <i data-feather="list"></i> </div>
                    <div class="menu__title"> View All </div>
                </a>
            </li>
           <li>
                <a href="{{  route('m-establishment.index', ['menu_edit' => true]) }}" class="menu">
                    <div class="menu__icon"> <i data-feather="edit-3"></i> </div>
                    <div class="menu__title"> Edit Establishment </div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu__devider my-6"></li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="map"></i> </div>
                    <div class="menu__title"> Province <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
            <li>
                <a href="{{ route('m-province.index') }}" class="menu">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> View All </div>
                </a>
            </li>
            <li>
                <a href="{{  route('m-city.index') }}" class="menu">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> Municipalities </div>
                </a>
            </li>
            <li>
                <a href="{{ route('m-barangay.index') }}" class="menu">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> Barangay </div>
                </a>
            </li>
        </ul>
    </li>

            <li class="menu__devider my-6"></li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="map-pin"></i> </div>
                    <div class="menu__title"> Track <i data-feather="chevron-down" class="menu__sub-icon"></i></div>
                </a>
            <ul class="">
                <li>
                    <a href="{{  route('people.track.index') }}" class="menu">
                    <div class="menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="menu__title"> Personnel </div>
                </a>
            </li>
        </ul>
    </li>
</ul>
</div>
<!-- END: Mobile Menu -->
