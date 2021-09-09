<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{  $base_url }}">
    <meta name="base_api_url" content="{{  $base_api_url }}">
    <title>{{ config('app.name') }} | @yield('page-title')</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ stage_asset('/dist/css/app.css') }}" />

    @stack('page-css')
</head>
<!-- END: Head -->

<body class="app">
    @include('user.templates.mobile_menu')
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="{{ route('home') }}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Logo" src="{{ stage_asset('/dist/images/logo.png') }}">
                <span class="hidden xl:block text-white text-lg ml-3"> SurSur-<span class="font-medium">ATP</span>
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            @auth
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="side-menu side-menu--active">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user-id') }}" class="side-menu ">
                        <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                        <div class="side-menu__title"> Your I.D </div>
                    </a>
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
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class=""></a> <i
                        data-feather="chevron-right" class="breadcrumb__icon"></i> <a href=""
                        class="breadcrumb--active">Dashboard</a> </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                <d class="intro-x dropdown w-8 h-8 relative">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img alt="" src="{{ stage_asset('/storage/images/no_image.png') }}">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 text-white">
                            <div class="p-4 border-b border-theme-40">
                                <div class="font-medium capitalize">{{  Auth::user()->info->lastname }},
                                    {{  Auth::user()->info->firstname }} </div>
                                <div class="text-xs text-theme-41">{{ '@' . Auth::user()->username }}</div>
                            </div>
                            <div class="p-2">
                                <a href="{{  route('user.account.edit') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="settings" class="w-4 h-4 mr-2"></i> Settings </a>

                            </div>
                            <div class="p-2 border-t border-theme-40">
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="cursor-pointer flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                    <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </d>
                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            @yield('content')
        </div>
        <!-- END: Content -->
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="{{ stage_asset('/dist/js/app.js') }}"></script>
    @stack('page-scripts')
    <!-- END: JS Assets-->
</body>

</html>
