@extends('templates-2.app')
@section('page-title', 'Dashboard')
@prepend('page-css')
@include('templates.select-option')
@endpush
@section('content')
<div class=" flex items-center h-10 mt-5">
    <h2 class="text-lg font-medium truncate mr-5">
        Add New Personnel
    </h2>
    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i>
        Reload Data </a>
</div>
{{-- @include('templates.error') --}}
@if(Session::has('success'))
<div class="intro-y col-span-12 md:col-span-6">
    <div class="box">
        <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                <p class="font-medium mb-2 text-white">Personnel Successfully Added!</p>
                <div class="text-gray-600 text-xs">
                    <a target="_blank" href="{{ route('admin.print.qr', Session::get('success')) }}" 
                        class="text-white">View Personnel I.D</a>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif ($errors->any())
    @include('templates.error')
@else
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6">
    <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
    <span class="text-white font-medium">All fields with * mark are required.</span>
</div>
@endif
<div class=" box py-10 sm:py-20 mt-5">
    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full button text-white bg-theme-1 form-wizard-buttons"
                data-target="person-information" id="wizard-0">1</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto">Person Information</div>
        </div>
        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 form-wizard-buttons"
                data-target="login-information" id="wizard-1">2</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Login Information</div>
        </div>
        {{-- <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 form-wizard-buttons"
                data-target="other-information" id="wizard-2">3</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Other Information</div>
        </div> --}}
        <div class="wizard__line hidden lg:block w-full bg-gray-200 absolute mt-5"></div>
    </div>
    <form id="formAddNewPersonnel" method="POST" enctype="multipart/form-data" action="{{ route('personnel.store') }}">
        @csrf
        <div class="px-5 sm:px-20 pt-5 mt-5 border-t border-gray-200">
            <div class="intro-x grid grid-cols-12 gap-4 row-gap-5 mt-5 section" id="person-information">
                <div class=" col-span-12 sm:col-span-3">
                    <label>
                        First Name
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>

                    <div class="p-1 bg-white flex">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('firstname') ? 'border-red-500' : '' }}"
                            type="text" placeholder="e.g. Christopher" aria-invalid="true" name="firstname"
                            value="{{  old('firstname') }}">
                    </div>
                    @if($errors->has('firstname'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('firstname') }}
                        </span>
                    @endif
                </div>

                <div class=" col-span-12 sm:col-span-3">
                    <label>Last Name
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class="p-1 bg-white flex">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('lastname') ? 'border-red-500' : '' }}"
                            type="text" placeholder="e.g. Vistal" name="lastname" value="{{  old('lastname') }}">
                    </div>
                    @if($errors->has('lastname'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('lastname') }}
                        </span>
                    @endif
                </div>

                <div class=" col-span-12 sm:col-span-3">
                    <label> Middlename </label>
                    <div class="p-1 bg-white flex">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('middlename') ? 'border-red-500' : '' }}"
                            type="text" placeholder="e.g. Platino" name="middlename" value="{{  old('middlename') }}">
                    </div>
                    @if($errors->has('middlename'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('middlename') }}
                        </span>
                    @endif
                </div>

                <div class=" col-span-12 sm:col-span-3">
                    <label>
                        Suffix
                    </label>
                    <div class="p-1 bg-white flex">
                        <input placeholder="Enter Suffix"
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('suffix') ? 'border-red-500' : '' }}"
                            type="text" maxlength="3" placeholder="e.g. Jr" name="suffix" value="{{  old('suffix') }}">
                    </div>
                </div>
                <div class=" col-span-12 sm:col-span-12">
                    <label>
                        Date of Birth <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div
                        class=" p-1 bg-white flex border {{ $errors->has('date_of_birth')  ? 'border-red-500' : 'border' }} rounded">
                        <input name="date_of_birth" placeholder="Date of Birth"
                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="date"
                            value="{{ old('date_of_birth') }}">
                    </div>
                    @if($errors->has('date_of_birth'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('date_of_birth') }}
                        </span>
                    @endif
                </div>


                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Province
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class="bg-white flex {{ $errors->has('province')  ? 'border border-red-500' : 'p-1' }}">
                        <select class="select2 input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                            name="province" id="province">
                            <option selected disabled>Select Province</option>
                            @foreach($provinces as $province)
                                @if(old('province'))
                                <option {{ old('province') == $province->code ? 'selected' : '' }}
                                    value="{{ $province->code }}"> {{ $province->name }}</option>
                                @else
                                <option value="{{ $province->code }}"> {{ $province->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('province'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('province') }}
                        </span>
                    @endif
                </div>
                <div class=" col-span-12 sm:col-span-4">
                    <label for="">
                        City
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class=" bg-white flex {{  $errors->has('city') ? 'rounded border border-red-500' : 'p-1' }}">
                        <select class="select2 input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                            name="city" id="cities">
                            <option selected disabled>Select City</option>
                        </select>
                    </div>
                    <span class="text-red-500 text-xs">{{  $errors->first('city') }}</span>
                </div>
                <div class=" col-span-12 sm:col-span-4">
                    <label for="">
                        Barangay
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class="bg-white {{ $errors->has('barangay') ? 'rounded border border-red-500' : 'p-1' }}">
                        <select class="select2 input border p-2 px-2 appearance-none outline-none w-full text-gray-800 "
                            name="barangay" id="barangay">
                            <option selected disabled>Select Barangay</option>
                        </select>
                    </div>
                    <span class="text-red-500 text-xs">{{  $errors->first('barangay') }}</span>
                </div>


                <div class=" col-span-12 sm:col-span-6">
                    <label for="">
                        Temporary Address
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div
                        class="p-1 bg-white flex border {{  $errors->has('temporary_address') ? 'border-red-500' : '' }} rounded rounded">
                        <textarea placeholder="e.g. Purok Paradise 950"
                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5"
                            name="temporary_address">{{  old('temporary_address') }}</textarea>
                    </div>
                    @if($errors->has('temporary_address'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('temporary_address') }}
                        </span>
                    @endif
                </div>

                <div class=" col-span-12 sm:col-span-6">
                    <label for="">
                        Permanent Address
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class="p-1 bg-white flex border {{  $errors->has('address') ? 'border-red-500' : '' }} rounded">
                        <textarea placeholder="e.g. Purok Paradise 950"
                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5"
                            name="address">{{  old('address') }}</textarea>
                    </div>
                    @if($errors->has('address'))
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            {{  $errors->first('address') }}
                        </span>
                    @endif
                </div>

                <div class=" col-span-12 sm:col-span-6">
                    <label> Sex
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>
                    <div class=" p-1 bg-white flex">
                        <select
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800  border {{  $errors->has('gender') ? 'border-red-500' : '' }}"
                            name="gender">
                            <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">
                                Male</option>
                            <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class=" col-span-12 sm:col-span-6">
                    <label>
                        Status
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>
                    <div class="p-1 bg-white flex ">
                        <select
                            class="select2 input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('status') ? 'border-red-500' : '' }}"
                            name="status">
                            @foreach($civil_status as $status)
                            <option {{ old('status') == $status ? 'selected' : '' }} value={{ $status }}>{{ $status }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('status'))
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                {{  $errors->first('status') }}
                            </span>
                    @endif
                </div>

                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Email
                    </label>
                    <div class=" p-1 bg-white flex">
                        <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800" type="email"
                            placeholder="e.g. user@gmail.com" name="email" value="{{  old('email') }}">
                    </div>
                </div>

                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Mobile Number
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>
                    <div class="p-1 bg-white flex">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('phone_number') ? 'border-red-500' : '' }}"
                            type="text" placeholder="e.g.+639193693499" name="phone_number"
                            value="{{  old('phone_number') }}">
                    </div>

                    @if($errors->has('phone_number'))
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                {{  $errors->first('phone_number') }}
                            </span>
                        @endif
                </div>

                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Landline Number
                    </label>
                    <div class="p-1 bg-white">
                        <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800" type="text"
                            placeholder="e.g. 8123-4567" name="landline_number" value="{{  old('landline_number') }}">
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-12">
                    <div class="w-full flex-1">
                        <label>
                            Image
                        </label>


                        <div class="p-1 bg-white flex  rounded">
                            <input
                                class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('image') ? 'border-red-500' : '' }}"
                                type="file" name="image">
                        </div>

                        @if($errors->has('image'))
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                                {{  $errors->first('image') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="intro-x grid grid-cols-12 gap-4 row-gap-5 mt-5 section hidden" id="login-information">
                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Username
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>

                    <div class=" p-1 bg-white flex">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('username') ? 'border-red-500' : '' }}"
                            type="text" placeholder="Enter username" name="username" value="{{  old('username') }}">
                    </div>
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                        {{ $errors->first('username') }}
                    </span>
                </div>

                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Password
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>
                    <div class="p-1 bg-white flex ">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('password') ? 'border-red-500' : '' }}"
                            type="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                    </div>

                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                        {{ $errors->first('password') }}
                    </span>
                </div>

                <div class=" col-span-12 sm:col-span-4">
                    <label>
                        Re-type Password
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>
                    <div class="p-1 bg-white flex ">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 border {{  $errors->has('password') ? 'border-red-500' : '' }}"
                            type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                            placeholder="Enter Re-type password">
                    </div>

                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                        {{ $errors->first('passwword_confirmation') }}
                    </span>
                </div>

                <div class=" col-span-12 sm:col-span-6">
                    <label>
                        MPIN
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>

                    <div class="p-1 bg-white">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('mpin') ? 'border-red-500' : '' }}"
                            placeholder="Enter MPIN" name="mpin" value="{{ old('mpin') }}" maxlength="4" type="password">
                    </div>
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                        {{ $errors->first('mpin') }}
                    </span>
                </div>

                <div class=" col-span-12 sm:col-span-6">
                    <label>
                        Re-type MPIN
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                            *
                        </span>
                    </label>

                    <div class="p-1 bg-white">
                        <input
                            class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800 {{  $errors->has('mpin') ? 'border-red-500' : '' }}"
                            placeholder="Enter MPIN" name="mpin_confirmation" value="{{ old('mpin') }}" maxlength="4" type="password">
                    </div>
                </div>

            </div>

            <div class="intro-x grid grid-cols-12 gap-4 row-gap-5 mt-5 section hidden" id="other-information">
                Other information
            </div>

            <div class="col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button type="button" class="button w-24 justify-center block bg-gray-200 text-gray-600 hidden"
                    id="btn-previous">Previous</button>
                <button type="button" class="button w-24 justify-center block bg-theme-1 text-white ml-2" id="btn-next" data-submit="false">Next</button>
            </div>
        </div>
    </form>
</div>
@push('page-scripts')
<script src="{{ stage_asset('dist/js/custom/select/select-province-city.js') }}"></script>
{{-- BEGIN: FORM WIZARD --}}
<script src="{{ stage_asset('dist/js/custom/wizard.js') }}"></script>
{{-- END: FORM WIZARD --}}
@endpush
@endsection
