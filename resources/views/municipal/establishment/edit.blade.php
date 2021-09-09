@extends('templates-2.app')
@section('page-title', 'Edit ' . $establishment->name . ' Establishment')
@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
        <!-- BEGIN: Edit Establishment -->
        <div class="col-span-12 mt-8">
            @include('templates.error')
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Edit {{  $establishment->name }} Establishment
                </h2>
                <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i>
                    Reload Data </a>
            </div>
            <div class="grid grid-cols mt-5">
                <div class="intro-y col-span-12 lg:col-span-6">
                    @if(Session::has('success'))
                    <div class="intro-y col-span-12 md:col-span-6">
                        <div class="box">
                            <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded mb-2">
                                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                    <p class="font-medium text-white">{{  $establishment->name }} Establishment Update
                                        Successfully!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6">
                        <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
                        <span class="text-white font-medium">All fields with * mark are required.</span>
                    </div>
                    @endif
                    <!-- BEGIN: Input -->
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                Establishment Information
                            </h2>
                        </div>
                        <div class="p-5" id="input">
                            <form method="POST" action="{{ route('m-establishment.update', $establishment->id) }}"
                                class="preview">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
                                    <div class="flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1">
                                            <label>
                                                Establishment/Office/Store Name
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            </label>

                                            <div
                                                class="p-1 bg-white flex border rounded  {{ $errors->has('name')  ? 'border-red-500' : '' }}">
                                                <input
                                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                                    type="text" placeholder="e.g. Gaisano Capital" aria-invalid="true"
                                                    name="name" value="{{ old('name') ?? $establishment->name }}">
                                            </div>
                                            <div class="text-xs text-theme-6">
                                                @if($errors->has('name'))
                                                {{ $errors->first('name') }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 mx-2">
                                            Establishment Type
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            <div
                                                class="{{ $errors->has('type') ? 'border border-theme-6 rounded' : '' }}">
                                                <select class="select2 w-full input border apperance-none outline-none"
                                                    name="type">
                                                    <option selected disabled>Select Establishment Type</option>
                                                    @foreach($types as $type)
                                                    @if(old('type'))
                                                    <option {{ old('type') == $type ? 'selected' : '' }}
                                                        value="{{ $type }}"> {{ $type }}</option>
                                                    @else
                                                    <option {{ $establishment->type == $type ? 'selected' : '' }}
                                                        value="{{ $type }}"> {{ $type }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="text-xs text-theme-6">
                                                @if($errors->has('type'))
                                                {{ $errors->first('type') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label>
                                        Address
                                        <span class="text-theme-6">*</span>
                                    </label>
                                    <textarea
                                        class="input w-full border {{  $errors->has('address')  ? 'border-theme-6' : '' }}"
                                        name="address"
                                        rows="5">{{ old('address') ?? $establishment->address }}</textarea>
                                    <div class="text-xs text-theme-6">
                                        @if($errors->has('address'))
                                        {{ $errors->first('address') }}
                                        @endif
                                    </div>
                                </div>


                                <div class="mt-3 mb-3">
                                    <label>
                                        Contact Number
                                        <span class="text-theme-6">*</span>
                                    </label>
                                    <input type="text"
                                        class="input w-full border {{  $errors->has('contact_no')  ? 'border-theme-6' : '' }}"
                                        placeholder="+639193693499"
                                        value="{{ old('contact_no') ?? $establishment->contact_no }}" name="contact_no">
                                    <div class="text-xs text-theme-6">
                                        @if($errors->has('contact_no'))
                                        {{ $errors->first('contact_no') }}
                                        @else
                                        Please include country code e.g. +639
                                        @endif
                                    </div>
                                </div>


                                <div class="mt-3">
                                    <label>
                                        Geo tag location
                                        <span class="text-theme-6">*</span>
                                    </label>
                                    <input type="text"
                                        class="input w-full border {{  $errors->has('geo_tag_location')  ? 'border-theme-6' : '' }}"
                                        value="{{ $establishment->latitude }}&{{ $establishment->longitude }}"
                                        name="geo_tag_location" id="geo_tag_location" readonly>
                                    <div class="text-xs text-theme-6">
                                        @if($errors->has('geo_tag_location'))
                                        {{ $errors->first('geo_tag_location') }}
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row mt-3">
                                    <div class="flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1">
                                            Barangay
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            <div
                                                class="{{ $errors->has('barangay')  ? 'border border-theme-6 rounded' : ''}}">
                                                <select name="barangay" id="barangay"
                                                    class="select2 w-full input border">
                                                    <option selected disabled>Select Barangay</option>
                                                    @foreach($barangays as $barangay)
                                                    @if(old('barangay'))
                                                    <option {{ old('barangay') == $barangay->code ? 'selected' : '' }}
                                                        value="{{ $barangay->code }}">
                                                        {{  $barangay->name }}
                                                    </option>
                                                    @else
                                                    <option
                                                        {{ $establishment->barangay->code == $barangay->code ? 'selected' : '' }}
                                                        value="{{ $barangay->code }}">
                                                        {{  $barangay->name }}
                                                    </option>
                                                    @endif

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="text-xs text-theme-6">
                                                @if($errors->has('barangay'))
                                                {{ $errors->first('barangay') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex lg:justify-end mt-5">
                                    <button type="submit" class="button bg-theme-9 shadow text-white w-auto">Edit
                                        Establishment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Input -->
            </div>
        </div>
    </div>
    <!-- END: Edit Establishment -->
</div>
</div>
@push('page-scripts')
<script>
    const BASE_URL = '/api/province';
    const ESTABLISHMENT_PROVINCE = "{{ $establishment->province_code }}";

    // Setting value for province then trigger change event in select
    $('#province').val(ESTABLISHMENT_PROVINCE).change();

    $('#province').change((e) => {
        let provinceCode = e.target.value;
        let citiesElement = $('#cities');

        // Make an AJAX request to get all city filtered by selected province.
        $.ajax({
            url: `${BASE_URL}/municipal/${provinceCode}`,
            success: (response) => {
                // Clear all option of cities select element
                citiesElement.find('option').remove();

                // Iterate to all barangay by city code and display to select
                response.municipals.forEach((municipal) => {
                    $('#cities').append(
                        `<option value="${municipal.code}">${municipal.name}</option>`);
                });
            }
        });
    });

    $('#cities').change((e) => {

        $.ajax({
            url: `${BASE_URL}/barangay/${e.target.value}`,
            success: (response) => {

                $('#barangay').find('option').remove();

                response.barangays.forEach((barangay) => $('#barangay').append(
                    `<option value="${barangay.code}">${barangay.name}</option>`));
            },
        });
    });

</script>
@endpush
@endsection
