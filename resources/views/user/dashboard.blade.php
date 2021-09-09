    @extends('user.templates.app')
@section('page-title', 'Your Dashboard')
@section('content')
 <!-- BEGIN: Content -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto capitalize">
     Your Profile
    </h2>
</div>
<!-- BEGIN: Profile Info -->
@if(Session::has('success'))
    <div class="intro-y col-span-12 md:col-span-6">
        <div class="box">
            <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <p class="font-medium text-white">{{  Session::get('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">

                <img alt="Personnel Image" class="rounded-full" src="{{ stage_asset('/storage/images/' . $person->info->image) }}">
                <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-1 rounded-full p-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera w-4 h-4 text-white"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg> </div>
            </div>
            <div class="ml-5">
                <div class="w-auto truncate sm:whitespace-normal font-medium text-md">{{  $person->info->firstname }} {{  $person->info->middlename }} {{  $person->info->lastname }} {{  $person->info->suffix }}</div>
                <div class="font-medium">{{ $person->info->person_id }} </div>
                <div class="font-medium">{{ $person->info->age }} Years Old</div>
                <div class="font-medium">
                    <a
                        target="_blank"
                        href="{{ route('user-id') }}"
                        class="button button--sm text-white bg-theme-1">View Your I.D</a>
                </div>

            </div>
        </div>
        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="truncate sm:whitespace-normal flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mr-2 mb-2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smartphone mx-auto"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                <span class="text-md">{{  $person->info->phone_number }}</span> </div>

            <div class="truncate sm:whitespace-normal flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mr-2 mb-2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign mx-auto"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                <span class="text-md">{{  $person->info->email ?? 'No Email Address' }}</span> </div>

            <div class="truncate sm:whitespace-normal flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mr-2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone mx-auto"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                 <span class="text-md">{{  $person->info->landline_number ?? 'No Landline Number' }}</span> </div>
        </div>
    </div>
    <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start">
        <a data-toggle="tab" data-target="#account-and-profile" href="javascript:;" class="py-4 sm:mr-8 active">Profile &amp; History Logs</a>
    </div>
</div>
<!-- END: Profile Info -->
<div class="intro-y tab-content mt-5">
    <div class="tab-content__pane active" id="dashboard">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Top Categories -->
            <div class="intro-y box col-span-12 lg:col-span-6">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Your Information
                    </h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col sm:flex-row">
                        <div class="w-1/4">
                            <span class="font-medium">Firstname</span>
                            <div class="text-gray-600 ">{{  $person->info->firstname }}</div>
                        </div>

                        <div class="w-1/4">
                            <span class="font-medium">Middlename</span>
                            <div class="text-gray-600 ">{{  $person->info->middlename }}</div>
                        </div>

                        <div class="w-1/4">
                            <span class="font-medium">Lastname</span>
                            <div class="text-gray-600 ">{{  $person->info->lastname }}</div>
                        </div>

                        <div class="w-1/4">
                            <span class="font-medium">Suffix</span>
                            <div class="text-gray-600 ">{{  $person->info->suffix }}</div>
                        </div>
                    </div>

                    <hr class="mt-3 mb-3">

                    <div class="flex flex-col sm:flex-row">
                        <div class="xl:w-1/4 sm:w-auto">
                            <span class="font-medium">Date of birth</span>
                            <div class="text-gray-600 ">{{  $person->info->date_of_birth }}</div>
                        </div>

                        <div class="xl:w-1/4 sm:w-auto">
                            <span class="font-medium">Barangay</span>
                            <div class="text-gray-600 ">{{  $person->info->barangay->name }}</div>
                        </div>

                        <div class="xl:w-1/4 sm:w-auto">
                            <span class="font-medium">Gender</span>
                            <div class="text-gray-600 capitalize">{{  $person->info->gender }}</div>
                        </div>

                        <div class="xl:w-1/4 sm:w-auto">
                            <span class="font-medium">Status</span>
                            <div class="text-gray-600 capitalize">{{  $person->info->civil_status }}</div>
                        </div>
                    </div>

                    <hr class="mt-3 mb-3">

                    <div class="flex flex-col sm:flex-row mt-2">
                        <div class="xl:w-1/2 sm:w-auto">
                            <span class="font-medium">Temporary Address</span>
                            <div class="text-gray-600">{{  $person->info->temporary_address }}</div>
                        </div>


                        <div class="xl:w-1/2 sm:w-auto">
                            <span class="font-medium">Permanent Address</span>
                            <div class="text-gray-600">{{  $person->info->address }}</div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- END: Top Categories -->
            <!-- BEGIN: Work In Progress -->
            <div class="intro-y box col-span-12 lg:col-span-6">
                <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto py-5">
                        Account Information
                    </h2>
                </div>
                <div class="p-5">
                    <div class="tab-content">
                        <div class="tab-content__pane active" id="work-in-progress-new">
                            <div>
                                <div class="flex">
                                    <div class="text-gray-700 font-medium mr-auto">Username</div>
                                </div>
                                <div class="w-full h-1">
                                  {{  $person->username }}
                                </div>
                            </div>
                            <div class="mt-10">
                                <div class="flex">
                                    <div class="text-gray-700 font-medium mr-auto">MPIN</div>
                                </div>
                                <div class="w-full h-1">
                                    {{  str_repeat('●', 10) }}
                                </div>
                            </div>
                            <div class="mt-10">
                                <div class="flex">
                                    <div class="text-gray-700 font-medium mr-auto">Password</div>
                                </div>
                                <div class="w-full h-1">
                                    {{  str_repeat('●', 10) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Work In Progress -->
            <!-- BEGIN: Latest Tasks -->
            <div class="box col-span-12 lg:col-span-12 shadow intro-y ">
                <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto py-5" >
                        Your History
                    </h2>
                </div>
                <div class="p-5">
                    <div class="tab-content">
                        <div class="tab-content__pane active">
                            @if($person->info->logs->count() !== 0)
                                <div class="mb-3">
                                    <a class="bg-theme-9 px-2 text-white text-xs py-1 rounded shadow">NORMAL</a>
                                    <a class="ml-1 bg-theme-12 px-4 text-white text-xs py-1 rounded shadow">FEVER</a>
                                    <a class="ml-1 bg-theme-6 px-3 text-white text-xs py-1 rounded shadow">SEVERE</a>
                                </div>
                            @endif
                            @forelse($person->info->logs as $log)
                                <div class="rounded-md px-5 py-4 mb-2 {{  $log->color_for_temperature }} {{  $log->color_for_temperature == 'bg-theme-12' ? 'text-black' : 'text-white' }}">
                                    <div class="flex items-center">
                                        <div class="font-medium text-lg">{{  $log->time }}</div>
                                        {{-- <a href="javsacript::" class="bg-white px-2 py-2 rounded text-gray-800 ml-auto shadow font-medium">
                                                TRACK
                                        </a> --}}
                                    </div>
                                    <div class="mt-3">
                                        Checked by
                                        <u class="capitalize font-medium">
                                            {{  $log->checker->firstname }}
                                            {{  $log->checker->middlename[0] }}.
                                            {{  $log->checker->lastname }}
                                        </u>
                                      <span>
                                       for being a <u class="font-medium">{{  $log->purpose }}</u> in <u class="font-medium">{{  $log->location }}</u> with body temperature of <u class="font-medium">{{ $log->body_temperature }}</u>
                                      </span>
                                    </div>
                                </div>
                            @empty
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 border border-theme-6 text-theme-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                No Available Records
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Latest Tasks -->
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
