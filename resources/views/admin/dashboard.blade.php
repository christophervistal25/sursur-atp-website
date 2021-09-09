@extends('templates-2.app')
@section('page-title', 'Dashboard')
@section('content')
<!-- BEGIN: Content -->
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Dashboard
                    {{  session()->pull('fetched_data') }}
                </h2>
                <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i>
                    Reload Data </a>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <a href="{{  route('personnel.index') }}">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="users" class="report-box__icon text-theme-10"></i>
                                    {{-- <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div> --}}
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{  $person_count }}</div>
                                <div class="text-base text-gray-600 mt-1">People</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <a href="{{  route('municipal-account.index') }}">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="home" class="report-box__icon text-theme-9"></i>
                                    {{-- <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                        </div> --}}
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $municipal_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Municipals account</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <a href="{{  route('checker.index') }}">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user-check" class="report-box__icon text-theme-11"></i>
                                    {{-- <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4"></i> </div>
                                        </div> --}}
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{  $checker_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Checkers</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <a href="{{  route('track.index') }}">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="grid" class="report-box__icon text-theme-12"></i>
                                    {{-- <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                        </div> --}}
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $scanned_qr }}</div>
                                <div class="text-base text-gray-600 mt-1">Scanned QR</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- END: General Report -->

        <!-- BEGIN: Sales Report -->
        <div class="intro-y box col-span-12 lg:col-span-6">
            <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto py-3">
                    Person by Age
                </h2>
            </div>
            <div class="p-5">
                <div class="tab-content">
                    <div class="tab-content__pane active p-2">
                        <div id="person__by__age__container">
                            {{-- CONTENT OF THIS ELEMENT IS IN PERSON-TEMPERATURE-CHART.JS --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Sales Report -->
        <!-- BEGIN: PERON'S TEMPERATURE CHART -->
        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Scanned Temperature
                </h2>
            </div>
            <div class="intro-y box p-5 mt-5">
                <canvas class="mt-3" id="temperatureChart" height="280"></canvas>
                <div class="mt-8" id="person__temperature__chart__container">
                </div>
            </div>
        </div>
        <!-- END: PERON'S TEMPERATURE CHART -->
        <!-- BEGIN: PIE CHART BY GENDER -->
        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                   Scanned Person by Sex
                </h2>
                {{-- <a href="" class="ml-auto text-theme-1 truncate">See all</a> --}}
            </div>
            <div class="intro-y box p-5 mt-5">
                <canvas class="mt-3" id="sexTemperatureChart" height="280"></canvas>
                <div class="mt-8" id="person__temperature__chart__by__sex__container">
                </div>
            </div>
        </div>
        <!-- END: PIE CHART BY GENDER -->
    </div>
</div>
<!-- BEGIN: SURIGAO DEL SUR CHART OF COVID-19 -->
<div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Surigao del Sur Chart of COVID-19
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5">
        <canvas id="horizontal-bar"></canvas>
    </div>
</div>
<!-- END: SURIGAO DEL SUR CHART OF COVID-19 -->

<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">
        COVID - 19 Quick Update
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-10 sm:py-20 mt-5">
    <div class="flex justify-center">
        <button class="intro-y w-auto h-auto rounded-full button text-white bg-theme-1 mx-2 update-category"
            data-target="surigao-del-sur">SURIGAO DEL SUR</button>
        <button class="intro-y w-auto h-auto rounded-full button bg-gray-200 text-gray-600 mx-2 update-category"
            data-target="philippines">PHILIPPINES</button>
        <button class="intro-y w-auto h-auto rounded-full button bg-gray-200 text-gray-600 mx-2 update-category"
            data-target="world-wide">WORLD-WIDE</button>
    </div>
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg" id="base-title">
            COVID-19 Quick Stat for SURIGAO DEL SUR</div>
        <div class="font-medium text-center text-xs" id="base-title">
            Source : <a target="_blank" class="text-theme-1" href="https://covid19stats.ph/">Covid-19 Tracker
                Philippines</a>
        </div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200">
        <div class="grid grid-cols-12 gap-4" id="surigao-del-sur">
            <div class=" col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-plus" class="w-12 h-12 text-theme-1 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-1">Confirmed Cases</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="surigao-confirmed-case">
                            {{ $confirmed }}
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-check" class="w-12 h-12 text-theme-9 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-9">Recovered</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="surigao-recovered">
                            {{ $recovered }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-x" class="w-12 h-12 text-theme-6 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-6">Deaths</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="surigao-deaths">{{ $deaths }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 hidden" id="philippines">
            <div class=" col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-plus" class="w-12 h-12 text-theme-1 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-1">Confirmed Cases</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="philippines-confirmed">
                            <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg"
                                fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s"
                                            values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20"
                                            calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s"
                                            values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-check" class="w-12 h-12 text-theme-9 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-9">Recovered</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="philippines-recovered">
                            <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg"
                                fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s"
                                            values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20"
                                            calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s"
                                            values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-x" class="w-12 h-12 text-theme-6 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-6">Deaths</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="philippines-deaths">
                            <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg"
                                fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s"
                                            values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20"
                                            calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s"
                                            values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-12 gap-4 hidden" id="world-wide">
            <div class=" col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-plus" class="w-12 h-12 text-theme-1 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-1">Confirmed Cases</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="world-wide-confirmed">
                            <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg"
                                fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s"
                                            values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20"
                                            calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s"
                                            values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-check" class="w-12 h-12 text-theme-9 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-9">Recovered</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="world-wide-recovered">
                            <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg"
                                fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s"
                                            values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20"
                                            calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s"
                                            values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y flex-1 px-5 py-16  sm:col-span-4 ">
                    <i data-feather="user-x" class="w-12 h-12 text-theme-6 mx-auto"></i>
                    <div class="text-xl font-medium text-center mt-10 text-theme-6">Deaths</div>
                    <div class="flex justify-center">
                        <div class="relative text-5xl font-semibold mt-2 mx-auto" id="world-wide-deaths">
                            <svg width="15" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg"
                                fill="rgb(45, 55, 72)" class="w-8 h-8">
                                <g transform="matrix(1 0 0 -1 0 80)">
                                    <rect width="10" height="20" rx="3">
                                        <animate attributeName="height" begin="0s" dur="4.3s"
                                            values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20"
                                            calcMode="linear" repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="15" width="10" height="80" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="30" width="10" height="50" rx="3">
                                        <animate attributeName="height" begin="0s" dur="1.4s"
                                            values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                    <rect x="45" width="10" height="30" rx="3">
                                        <animate attributeName="height" begin="0s" dur="2s"
                                            values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"
                                            repeatCount="indefinite"></animate>
                                    </rect>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Wizard Layout -->


<!-- END: Content -->
@push('page-scripts')
{{-- <script src="/dist/js/custom/dashboard/covid-stats-chart.js"></script> --}}
<script src="{{ stage_asset('/dist/js/custom/dashboard/covid-stats.js') }}"></script>
<script src="{{ stage_asset('/dist/js/custom/dashboard/person-temperature-chart.js') }}"></script>
<script>
    const DATA_SEPARATOR = "|";
    let ctx = document.getElementById('horizontal-bar').getContext('2d');

    let chartLabel = "{{ $horizontal_chart_label }}".split(DATA_SEPARATOR);
    let confirmed  = "{{ $horizontal_chart_confirmed }}".split(DATA_SEPARATOR);
    let recovered  = "{{ $horizontal_chart_recovered }}".split(DATA_SEPARATOR);
    let deaths     = "{{ $horizontal_chart_deaths }}".split(DATA_SEPARATOR);


    let barChartData = {
        labels: chartLabel,
        datasets: [{
                label: 'Confirmed Cases',
                backgroundColor: "#f1c40f",
                data : confirmed,
            }, {
                label: 'Recovered',
                backgroundColor: "#2ecc71",
                data : recovered,
            },
            {
                label: 'Deaths',
                backgroundColor: "#e74c3c",
                data : deaths
            },
        ],
    };


    new Chart(ctx, {
        type: 'bar',
        data: barChartData,
    });
</script>
@endpush
@endsection
