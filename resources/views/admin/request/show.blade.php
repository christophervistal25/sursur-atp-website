@extends('templates-2.app')
@section('page-title','Update Request for ' . $person->lastname . ' \'s information.')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto capitalize">
        {{ strtolower($person->firstname) }}'s Profile
    </h2>
</div>
@if($person->account->status)
<div class="rounded-md flex items-center px-5 py-4 mt-2 bg-theme-6 text-white intro-y">
    <svg xmlns="http://www.w3.org/2000/svg"
        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
        stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>
    Sorry but you can't generate or print a QR I.D for this person please complete first all information.
</div>
@endif
<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">

                <img alt="Personnel Image" class="rounded-full" src="{{ str_replace('public/', '', asset('storage/images/' . $person->image)) }}">
                <div
                    class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-1 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-camera w-4 h-4 text-white">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                        </path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg> </div>
            </div>
            <div class="ml-5">
                <div class="w-auto truncate sm:whitespace-normal font-medium text-md">{{  $person->firstname }}
                    {{  $person->middlename }} {{  $person->lastname }} {{  $person->suffix }}</div>
                <div class="font-medium">{{ $person->person_id }} </div>
                <div class="font-medium">{{ $person->age }} Years Old</div>
                <div class="font-medium">Registered in {{ $person->registered_from }}</div>
            </div>
        </div>
        <div
            class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="truncate sm:whitespace-normal flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" class="mr-2 mb-2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-smartphone mx-auto">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                </svg>
                <span class="text-md">{{  $person->phone_number }}</span> </div>

            <div class="truncate sm:whitespace-normal flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" class="mr-2 mb-2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-at-sign mx-auto">
                    <circle cx="12" cy="12" r="4"></circle>
                    <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                </svg>
                <span class="text-md">{{  $person->email ?? 'No Email Address' }}</span> </div>

            <div class="truncate sm:whitespace-normal flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" class="mr-2 mb-2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-phone mx-auto">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                    </path>
                </svg>
                <span class="text-md">{{  $person->landline_number ?? 'No Landline Number' }}</span>
            </div>
        </div>
    </div>
    <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start">
        <a data-toggle="tab" data-target="#account-and-profile" href="javascript:;" class="py-4 sm:mr-8 active"></a>
    </div>
</div>
<!-- END: Profile Info -->
<div class="intro-y tab-content mt-5">
    <div class="tab-content__pane active" id="dashboard">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Latest Tasks -->
            <div
                class="box col-span-12 lg:col-span-12 {{  request()->has('from_track') ? 'border border-theme-15 shadow intro-x ' : 'intro-y' }}">
                <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto py-5">
                        Requested by {{ $request->from }} 
                    </h2>
                </div>
                <div class="p-5">
                    <div class="tab-content">
                        <div class="tab-content__pane active">
                            <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="text-center whitespace-no-wrap">FIELD</th>
                                    <th class="text-center whitespace-no-wrap">OLD INFORMATION</th>
                                    <th class="text-center whitespace-no-wrap">MODIFIED INFORMATION</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($request->fields as $key => $newValue)
                                <tr class="intro-x">
                                    <td class='text-center font-medium'> {{ $key }} </th>
                                    <td class='text-center'>
                                        @if(in_array($key, ['password', 'mpin']))
                                            {{ str_repeat('*', 16) }}
                                        @else
                                            {{ $person->$key ?? $person->account->$key }}
                                        @endif
                                    </td>
                                      <td class='text-center'>
                                       @if(in_array($key, ['password', 'mpin']))
                                            {{ str_repeat('*', 16) }}
                                        @else
                                            {{ $newValue }}
                                        @endif
                                     
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                           <div class="col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <form method="POST" action="{{ str_replace('public/', '', route('request.update', $request->id)) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="reject" name="status"/>
                                 <button type="submit" class="button w-24 justify-center block bg-theme-6 text-white"
                                   >Disapprove</button>
                            </form>
                                   
                            <form method="POST" action="{{ str_replace('public/', '', route('request.update', $request->id)) }}">
                            @csrf
                            @method('PUT')
                                <input type="hidden" value="accept" name="status"/>
                                <button type="submit" class="button w-24 justify-center block bg-theme-9 text-white ml-2">Approve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Latest Tasks -->
        </div>
    </div>
</div>
@endsection
