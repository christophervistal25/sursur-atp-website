@extends('templates-2.app')
@section('page-title', 'Log history of ' . $person->firstname)
@section('content')
<!-- BEGIN: Content -->
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{  stage_asset('storage/images/' . $person->image) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-theme-1">{{  $person->firstname }} {{  $person->middlename }} {{  $person->lastname }} {{  $person->suffix }}</div>
                        <div class="text-gray-600">Person ID : {{ $person->person_id }}</div>
                    </div>
                    <div class="dropdown relative">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-700"></i> </a>
                        <div class="dropdown-box mt-5 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box">
                                <div class="p-4 border-b border-gray-200 font-medium">Options</div>
                                <div class="p-2">
                                    <a href="{{  route('personnel.logs', $person->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="user-check" class="w-4 h-4 text-gray-700 mr-2"></i> Profile </a>

                                    <a href="{{ route('personnel.edit', $person->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="edit-3" class="w-4 h-4 text-gray-700 mr-2"></i> Update Profile </a>

                                    <a class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md" href="{{ route('personnel.logs', [$person->id, 'from_track' => true]) }}" title="Track Personnel">
                                        <i data-feather="map-pin" class="w-4 h-4 text-gray-700 mr-2"></i> Logs
                                        <div class="text-xs text-white px-1 rounded-full bg-theme-6 ml-auto">{{  $person->logs->count() }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-5 border-t border-gray-200">
                    <a class="flex items-center  font-medium"> <i data-feather="at-sign" class="w-4 h-4 mr-2"></i> {{  $person->email ?? 'No Email Address' }} </a>
                    <a class="flex items-center mt-5 font-medium"> <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> {{  $person->phone_number }} </a>
                    <a class="flex items-center mt-5 font-medium"> <i data-feather="phone" class="w-4 h-4 mr-2"></i> {{  $person->landline_number ?? 'No Landline Number' }} </a>
                </div>
                <div class="p-5 border-t border-gray-200">
                    <a class="flex items-center"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> Province of {{  $person->province->name }} </a>
                    <a class="flex items-center mt-5"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> Barangay {{  $person->barangay->name }} </a>
                    <a class="flex items-center mt-5"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> Municipality of {{  $person->city->name }} </a>
                    <a class="flex items-center mt-5"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> {{  $person->address }} </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box lg:mt-5">
                    @if(Session::has('success'))
                    <div class="intro-y col-span-12 md:col-span-6">
                        <div class="box">
                            <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded mb-3">
                                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                    <p class="font-medium  text-white">{{ Session::get('success') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Activities
                    </h2>
                </div>
                <div class="p-5">
                    <div class="accordion">
                        @forelse($person->logs as $log)
                        <div class="accordion__pane border border-gray-200 p-4 mb-2 bg-white">
                            <a href="javascript:;" class="accordion__pane__toggle font-medium block interact" id="log-{{ $log->id }}">> {{  $log->time }} {{ $log->location }} - {{  $log->purpose }}</a>

                            <input id="log_location-{{ $log->id }}" type="hidden" value="{{  $log->location }}">

                            <input id="log_time-{{ $log->id }}" type="hidden" value="{{  $log->time }}">

                            <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed" id="interact-container-{{ $log->id }}">
                                {{-- BEGIN OF LOADER --}}
                                <div class="flex justify-center">
                                    <svg id="loader-{{ $log->id }}" width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8 loaders">
                                        <rect y="10" width="15" height="120" rx="6">
                                            <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                        </rect>
                                        <rect x="30" y="10" width="15" height="120" rx="6">
                                            <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                        </rect>
                                        <rect x="60" width="15" height="140" rx="6">
                                            <animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                        </rect>
                                        <rect x="90" y="10" width="15" height="120" rx="6">
                                            <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                        </rect>
                                        <rect x="120" y="10" width="15" height="120" rx="6">
                                            <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                        </rect>
                                    </svg>
                                </div>
                                {{-- END OF LOADER --}}
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
            <!-- END: Daily Sales -->
        </div>
    </div>

            <div class="modal" id="personnel-info-modal">
                    <div class="modal__content modal__content--xl">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                Other Information
                            </h2>
                        </div>
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label>Email</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="email">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Landline Number</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="landline_number">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Date of Birth</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="date_of_birth">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Age</label>
                                <input type="text" class="input w-full border mt-2 flex-1"  readonly id="age">
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <label>Barangay</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="barangay">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>City</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="city">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Status</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="status">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Gender</label>
                                <input type="text" class="input w-full border mt-2 flex-1" readonly id="gender">
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <label>Temporary Address</label>
                                <br>
                                <textarea class="input w-full border mt-2 flex-1" rows="2" readonly id="temporary_address"></textarea>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Address</label>
                                <br>
                                <textarea class="input w-full border mt-2 flex-1" rows="2" readonly id="address"></textarea>
                            </div>
                        </div>
                        <div class="px-5 py-3 text-right border-t border-gray-200">
                            <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button>
                        </div>
                    </div>
                </div>
    <!-- END: Header & Footer Modal -->



<!-- END: Content -->

@push('page-scripts')
<script>
    const TRIGGER_CLASS = 'report-person';
    let selectedPerson = 0;

    $('.interact').click((e) => {
        // Get the ID of selected Log
        let log_id = $(e.target).attr('id')
                                .replace('log-', '');

        let phone_numbers = [];
        let log_location  = $(`#log_location-${log_id}`).val();
        let log_time      = $(`#log_time-${log_id}`).val();

        $(`#loader-${log_id}`).show();

        // Make an Ajax request to check the other information of encountered log.
        $.ajax({
            url : `/municipal/track/others/${log_id}`,
            type : 'GET',
            success : (response) => {
                // Clear the container
                $(`#interact-container-${log_id}`).html('');

                if(response.length !== 0) {
                    // Hide the loading icon
                    $(`#loader-${log_id}`).hide();

                    // Clear all the phone number in hidden text fields.
                    phone_numbers = [];

                    // Iterate from encountered person logs.
                    response.forEach((log) => {

                        // Insert the phone numbers of each person
                        phone_numbers.push(log.person.phone_number);

                        // Display the information of encountered person.
                        $(`#interact-container-${log_id}`).prepend(`
                            <div class="report-timeline relative mt-3 mb-1 ">
                                <div class="intro-x relative flex items-center">
                                    <div class="report-timeline__image">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img alt="Person Image" src="/storage/images/${log.person.image}">
                                        </div>
                                    </div>
                                    <div class="box px-5 py-3 ml-4 flex-1 zoom-in ${TRIGGER_CLASS}" data-id="${log.person_id}">
                                        <div class="flex items-center">
                                            <div class="font-medium">
                                                ${log.person.person_id} - ${log.person.firstname}
                                                ${log.person.middlename}
                                                ${log.person.lastname}
                                                ${log.person.suffix || ''}
                                            </div>
                                            <div class="text-xs text-gray-700 ml-auto">${log.time}</div>
                                        </div>
                                        <div class="text-gray-600">
                                            ${log.person.phone_number}
                                        </div>
                                        <div class="text-gray-600">
                                            Body temperature : ${log.body_temperature}
                                        </div>

                                        <div class="text-gray-600 text-sm capitalize">
                                            Checker :
                                            <span class="font-medium">
                                                ${log.checker.firstname}
                                                ${log.checker.middlename}
                                                ${log.checker.lastname}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                    // By default passing the array in textfield with automatically split by comma
                    $(`#interact-container-${log_id}`).append(`
                        <form action="{{ route('notify.others') }}" method="POST">
                            @csrf
                            <input type="hidden" name="location" value="${log_location}">
                            <input type="hidden" name="time" value="${log_time}">
                            <input type="hidden" name="phone_numbers"  value="${phone_numbers}" />
                            <button type="submit" class="button bg-theme-1 px-2 py-2 text-white ">
                                Send SMS Notification
                            </button>
                        </form>
                   `);
                } else {
                    // No encountered person.
                    $(`#interact-container-${log_id}`).append(`
                        <div class="rounded-md flex items-center px-5 py-4 mb-2 border border-theme-6 text-theme-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            No Available Records
                        </div>
                    `);
                }
            }
        });
    });

    $(document).on('click', (e) => {
        let clickedElement = $(e.target).attr('class');

        // Get the parent element of clicked item
        let parentElement = $(e.target).parent().get(0);

        // Check if the parent has a attribute of report-person
        // if so this means we need to display an modal with the information
        // of the selected user or clicked user.

        if($(parentElement).attr('class').includes(TRIGGER_CLASS)) {
            let person_id = $(parentElement).attr('data-id');

            // Make an ajax request for getting the personnel information.
            $.ajax({
                url : `/api/person/${person_id}/profile`,
                success : (response) => {
                    $('#email').val(response.email || 'N/A');
                    $('#landline_number').val(response.landline_number || 'N/A');
                    $('#date_of_birth').val(response.date_of_birth);
                    $('#age').val(response.age);
                    $('#barangay').val(response.barangay.name);
                    $('#city').val(response.city.name);
                    $('#status').val(response.civil_status);
                    $('#gender').val(response.gender.toUpperCase());
                    $('#temporary_address').val(response.temporary_address);
                    $('#address').val(response.address);
                },
            })


            $('#personnel-info-modal').modal('show');
            $('#personnel-info-modal').on('show.bs.modal', function (e) {
                console.log('modal display');
            });
        }
    });


</script>
@endpush
@endsection
