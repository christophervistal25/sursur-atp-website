<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ stage_asset('/favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{  $base_url }}">
    <meta name="base_api_url" content="{{ $base_api_url }}">
    <meta name="author" content="Surigao del Sur - ITU TEAM">
    <title>@yield('page-title') | {{ config('app.name') }}</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ stage_asset('/dist/css/app.css') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    @stack('page-css')
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="app">
    @auth('admin')
    @include('templates-2.mobile_menu')
    @endauth
    @auth('municipal')
    @include('templates-2.mobile_menu_municipal')
    @endauth
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="{{  route('admin.dashboard') }}" class="intro-x flex items-center pl-5 pt-4 outline-none">
                <img alt="Logo" src="{{ stage_asset('/dist/images/logo.png') }}">
                <span class="hidden xl:block text-white text-lg ml-3"> SurSur - <span class="font-medium">ATP</span>
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            @auth('admin')
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard', ['pass' => 'dashboard']) }}" class="side-menu {{ Str::contains(request()->pass, 'dashboard') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'generate') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="grid"></i> </div>
                        <div class="side-menu__title"> Generate QR <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{ route('personnel.create', ['pass' => 'generate']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                                <div class="side-menu__title"> Personnel </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('establishment.create', ['pass' => 'generate']) }}" class="side-menu ">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Establishment </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'personnel') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="side-menu__title"> People <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('personnel.index', ['pass' => 'personnel']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('personnel.index', ['menu_edit' => true, 'pass' => 'personnel']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="edit-3"></i> </div>
                                <div class="side-menu__title"> Edit Personnel </div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'checker') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="shield"></i> </div>
                        <div class="side-menu__title"> Checkers <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('checker.index', ['pass' => 'checker']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('checker.create', ['pass' => 'checker']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
                                <div class="side-menu__title"> Add Checker </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('checker.index', ['menu_edit' => true, 'pass' => 'checker']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="edit-3"></i> </div>
                                <div class="side-menu__title"> Edit Checker </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'establishments') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Establishments <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('establishment.index', ['pass' => 'establishments']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('establishment.index', ['menu_edit' => true, 'pass' => 'establishments']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="edit-3"></i> </div>
                                <div class="side-menu__title"> Edit Establishment </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'account') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="key"></i> </div>
                        <div class="side-menu__title"> Accounts <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('administrator.index', ['pass' => 'account']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                                <div class="side-menu__title"> Administrators </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('user.index', ['pass' => 'account']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                                <div class="side-menu__title"> Users </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('municipal-account.index', ['pass' => 'account']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                                <div class="side-menu__title"> Municipals </div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'province') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="map"></i> </div>
                        <div class="side-menu__title"> Province <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{ route('province.index', ['pass' => 'province']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('city.index', ['pass' => 'province']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Municipalities </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('barangay.index', ['pass' => 'province']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Barangay </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'track') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="map-pin"></i> </div>
                        <div class="side-menu__title"> Track <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('track.index', ['pass' => 'track']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Personnel </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('request.index', ['pass' => 'request']) }}" class="side-menu {{ Str::contains(request()->pass, 'request') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                        <div class="side-menu__title"> Request <span
                                class="w-6 bg-theme-6 text-white font-medium text-center rounded-full mx-auto">{{ $requestUpdate->count() }}</span>
                        </div>
                    </a>
                </li>
            </ul>
            @endauth

            @auth('municipal')
            <ul>
                <li>
                    <a href="{{  route('municipal.dashboard', ['pass' => 'dashboard']) }}" class="side-menu {{ Str::contains(request()->pass, 'dashboard') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'generate') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="grid"></i> </div>
                        <div class="side-menu__title"> Generate QR <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{ route('municipal-personnel.create', ['pass' => 'generate']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                                <div class="side-menu__title"> Personnel </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('m-establishment.create', ['pass' => 'generate']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Establishment </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'people') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="side-menu__title"> People <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('municipal-personnel.index', ['pass' => 'people']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'checkers') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="shield"></i> </div>
                        <div class="side-menu__title"> Checkers <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('m-checker.index', ['pass' => 'checkers']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('m-checker.create', ['pass' => 'checkers']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
                                <div class="side-menu__title"> Add Checker </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('m-checker.index', ['menu_edit' => true, 'pass' => 'checkers']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="edit-3"></i> </div>
                                <div class="side-menu__title"> Edit Checker </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'establishments') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Establishments <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('m-establishment.index', ['pass' => 'establishments']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('m-establishment.index', ['menu_edit' => true, 'pass' => 'establishments']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="edit-3"></i> </div>
                                <div class="side-menu__title"> Edit Establishment </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'province') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="map"></i> </div>
                        <div class="side-menu__title"> Province <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{ route('m-province.index', ['pass' => 'province']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> View All </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('m-city.index', ['pass' => 'province']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Municipalities </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('m-barangay.index', ['pass' => 'province']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Barangay </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Str::contains(request()->pass, 'track') ? ' side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="map-pin"></i> </div>
                        <div class="side-menu__title"> Track <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{  route('people.track.index', ['pass' => 'track']) }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Personnel </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                    <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
                </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Notifications -->
                <div class="intro-x dropdown relative mr-auto sm:mr-6">
                    <div
                        class="dropdown-toggle notification {{ $requestUpdateByAccount->count() != 0 ? 'notification--bullet' : '' }} cursor-pointer">
                        <i data-feather="bell" class="notification__icon"></i>
                    </div>
                    <div
                        class="notification-content dropdown-box mt-8 absolute top-0 left-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
                        <div class="notification-content__box dropdown-box__content box">
                            <div class="notification-content__title">Notifications</div>
                            @foreach($requestUpdateByAccount as $request)
                            <div class="cursor-pointer relative flex items-center hover:bg-gray-300 p-3 rounded request__item">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Notification Icon" class="rounded-full"
                                        src="{{ stage_asset('/dist/images/map-marker-region.png') }}">
                                    <div
                                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="{{ route('request.index') }}" class="font-medium text-xs truncate mr-5">Request
                                            Update
                                            {{ $request->person->lastname . ' ' . $request->person->firstname . ' ' . $request->person->middlename . ' ' . $request->person->suffix }}
                                        </a>
                                        <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">
                                            {{ $request->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="w-full truncate text-gray-600 text-xs">Please check this request
                                        from {{ $request->from }}</div>
                                        <div class="w-full truncate text-gray-600 text-xs">Your request status is {{ $request->status }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- END: Notifications -->
                @auth('admin')
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8 relative">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img alt="Profile Picture" src="{{ stage_asset('/storage/images/no_image.png') }}">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 text-white">
                            <div class="p-4 border-b border-theme-40">
                                <div class="font-medium capitalize">{{  Auth::user()->lastname }},
                                    {{  Auth::user()->firstname }} </div>
                                <div class="text-xs text-theme-41">{{ '@' . Auth::user()->username }} - Administrator
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="{{  route('admin.profile.edit') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="user" class="w-4 h-4 mr-2"></i> Update Profile </a>
                                <a href="{{  route('administrator.create') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                <a href=""
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                            </div>
                            <div class="p-2 border-t border-theme-40">
                                <a onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                                    class="cursor-pointer flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
                @endauth
                {{-- BEGIN OF MUNICIPAL MENU --}}
                @auth('municipal')
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8 relative">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img alt="" src="{{ stage_asset('/storage/images/no_image.png') }}">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 text-white">
                            <div class="p-4 border-b border-theme-40">
                                <div class="font-medium capitalize">{{  Auth::user()->city->name }}</div>
                                <div class="text-xs text-theme-41">{{ '@' . Auth::user()->username }} -
                                    {{ Auth::user()->city->code }}</div>
                                <div class="d-none" id="auth-city-code" data-source="{{ Auth::user()->city->code }}">
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('account.edit') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="user" class="w-4 h-4 mr-2"></i> Update Profile
                                </a>
                            </div>
                            <div class="p-2 border-t border-theme-40">
                                <a onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                                    class="cursor-pointer flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                <form id="logout-form" action="{{ route('municipal.auth.logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
                @endauth
                {{-- END OF MUNICIPAL MENU --}}
            </div>
            <!-- END: Top Bar -->
            @yield('content')
        </div>
        <!-- END: Content -->
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="{{ stage_asset('/dist/js/app.js') }}"></script>
    @stack('page-scripts')
    <script>
        $('.request__item').click((e) => window.location.href = "{{ route('request.index') }}")
    </script>
    <!-- END: JS Assets-->
</body>

</html>
