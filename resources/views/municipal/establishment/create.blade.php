@extends('templates-2.app')
@section('page-title', 'Add New Establishment')
@prepend('page-css')
@include('templates.select-option')
@endprepend
@section('content')
<div class="grid grid-cols-12">
    <div class="col-span-12 grid grid-cols-12">
        <!-- BEGIN: Add New Establishment -->
        <div class="col-span-12 mt-8">
            {{-- @include('templates.error') --}}
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Add New Establishment
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
                                    <p class="font-medium text-white">Establishment Successfully Added!</p>
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
                            <form method="POST" action="{{ route('m-establishment.store') }}" class="preview">
                                @csrf
                                <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
                                    <div class="flex-1 flex flex-col md:flex-row">
                                        <div class="w-full flex-1">
                                            <label>
                                                Establishment/Office/Store Name
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            </label>

                                            <div
                                                class="p-1 bg-white flex border rounded  {{ $errors->has('office_store_name')  ? 'border-red-500' : '' }}">
                                                <input
                                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                                                    type="text" placeholder="e.g. Gaisano Capital" aria-invalid="true"
                                                    name="office_store_name" value="{{  old('office_store_name') }}">
                                            </div>
                                            <div class="text-xs text-theme-6">
                                                @if($errors->has('office_store_name'))
                                                {{ $errors->first('office_store_name') }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 xxl:mx-2">
                                            Establishment Type
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                            <div
                                                class="{{ $errors->has('type') ? 'border border-theme-6 rounded' : '' }}">
                                                <select class="select2 w-full input border" name="type">
                                                    <option selected disabled>Select Establishment Type</option>
                                                    @foreach($types as $type)
                                                    <option {{ old('type') == $type ? 'selected' : '' }}
                                                        value="{{ $type }}">{{ $type }}</option>
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
                                        name="address" rows="5">{{ old('address') }}</textarea>
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
                                        class="input w-full border {{  $errors->has('contact_number')  ? 'border-theme-6' : '' }}"
                                        placeholder="+639193693499" value="{{  old('contact_number') }}"
                                        name="contact_number">
                                    <div class="text-xs text-theme-6">
                                        @if($errors->has('contact_number'))
                                        {{ $errors->first('contact_number') }}
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
                                                class="{{ $errors->has('barangay') ? 'border border-theme-6 rounded' : '' }}">
                                                <select name="barangay" id="barangay"
                                                    class="select2 w-full input border">
                                                    <option selected disabled>Select Barangay</option>
                                                    @foreach($barangays as $barangay)
                                                        <option {{ old('barangay') === $barangay->code ? 'selected' : '' }} value="{{ $barangay->code }}">{{  $barangay->name }}</option>
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
                                    <button type="submit" class="button bg-theme-1 text-white w-auto">Add New
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
    <!-- END: Add New Establishment -->
</div>
</div>
@push('page-scripts')
<script src="/dist/js/custom/select/select-province-city.js"></script>
<script>
    // Get the current position of the user.
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(initPosition);
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    }

    // Get the latitude and longitude.
    function initPosition(position) {
        $('#geo_tag_location').val(`${position.coords.latitude}&${position.coords.longitude}`);
    }

    getLocation();

</script>
@endpush
@endsection
