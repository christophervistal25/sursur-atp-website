@extends('user.templates.app')
@section('page-title', 'Dashboard')
@prepend('page-css')
@include('templates.select-option')
@endpush
@section('content')
<div class=" flex items-center h-10 mt-5">
    <h2 class="text-lg font-medium truncate mr-5">
        Update your account
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
                        class="button button--md text-white bg-theme-1 mr-2">View Personnel I.D</a>
                </div>
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
<div class=" box py-10 sm:py-20 mt-5">
    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full button text-white bg-theme-1 form-wizard-buttons"
                data-target="person-information" id="wizard-0">1</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto">Personal</div>
        </div>
        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 form-wizard-buttons"
                data-target="address-section" id="wizard-1">2</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Address</div>
        </div>

        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 form-wizard-buttons"
                data-target="login-information" id="wizard-2">3</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Uploads</div>
        </div>
        <div class="wizard__line hidden lg:block w-full bg-gray-200 absolute mt-5"></div>
    </div>
    <form id="formAddNewPersonnel" method="POST" enctype="multipart/form-data"
        action="{{ route('user.update.profile.submit', Auth::user()->id) }}">
        @csrf
        @method('PUT')
        <div class="px-5 pt-5 mt-5 border-t border-gray-200">
            <div class="intro-x grid grid-cols-12 gap-4 row-gap-5 mt-5 section" id="person-information">

                <div class="col-span-12 sm:col-span-6">
                    <label class="font-medium"> Sex
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
                    <label class="font-medium">
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

                <div class=" col-span-12 sm:col-span-6">
                    <label class="font-medium">
                        Email
                    </label>
                    <div class=" p-1 bg-white flex">
                        <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                            type="email" placeholder="e.g. user@gmail.com" name="email" value="{{  old('email') }}">
                    </div>
                </div>


                <div class=" col-span-12 sm:col-span-6">
                    <label class="font-medium">
                        Landline Number
                    </label>
                    <div class="p-1 bg-white">
                        <input class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                            type="text" placeholder="e.g. 8123-4567" name="landline_number"
                            value="{{  old('landline_number') }}">
                    </div>
                </div>

            </div>

            <div class="intro-x grid grid-cols-12 gap-4 row-gap-5 mt-5 section hidden" id="address-section">
                <div class="col-span-12 sm:col-span-12">
                    <div class="mt-4">
                        <span class="text-gray-700">
                            Status of residence in Tandag City
                            <span class='text-xs text-theme-6'> * </span>
                        </span>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" id="residence" name="residence_type"
                                    {{ old('residence_type') == 'residence' ? 'checked' : '' }} value="residence">
                                <span class="ml-2">Residence</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio" id="non_residence" name="residence_type"
                                    value="non_residence"
                                    {{ old('residence_type') == 'non_residence' ? 'checked' : '' }}>
                                <span class="ml-2">Non-Residence</span>
                            </label>
                        </div>
                        <span class='text-theme-6'>
                            {{ $errors->first('residence_type') }}
                        </span>
                    </div>
                </div>

                <div class="col-span-12" id="province-container">
                    <label class="font-medium">
                        Province
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class="bg-white flex  {{ $errors->has('province')  ? 'border border-red-500 rounded' : '' }} ">
                        <select
                            class="select-province p-2 px-2 appearance-none outline-none w-full text-gray-800 border rounded"
                            name="province" id="province">
                            <option> </option>
                            @foreach($provinces as $province)
                            <option {{ old('province') == $province->code ? 'selected' : '' }}
                                value="{{ $province->code }}"> {{ $province->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    @if($errors->has('province'))
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-red-600">
                        {{  $errors->first('province') }}
                    </span>
                    @endif
                </div>

                <div class="col-span-12" id="city-container">
                    <label class="font-medium">
                        City
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class=" bg-white flex {{  $errors->has('city') ? 'border border-red-500 rounded' : '' }}">
                        <select
                            class="select-city p-2 px-2 appearance-none outline-none w-full text-gray-800 border rounded"
                            name="city" id="cities">
                            <option selected value=""></option>
                        </select>
                    </div>
                    @if($errors->has('city'))
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-red-600">
                        {{ $errors->first('city') }}
                    </span>
                    @endif
                </div>

                <div class="col-span-12">
                    <label class="font-medium">
                        Barangay
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div class="bg-white {{  $errors->has('barangay') ? 'border rounded border-red-500' : '' }}">
                        <select class="input border p-2 px-2 appearance-none outline-none w-full text-gray-800"
                            name="barangay" id="barangay">
                            <option> </option>
                            @foreach($residenceOfTandagBarangays as $barangay)
                            <option {{ old('barangay') == $barangay->code ? 'selected' : '' }}
                                value="{{ $barangay->code }}">{{  $barangay->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('barangay'))
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-red-600">
                        {{  $errors->first('barangay') }}
                    </span>
                    @endif
                </div>


                <div class="col-span-12 sm:col-span-6">
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
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-red-600">
                        {{ $errors->first('temporary_address') }}
                    </span>
                    <div class="mb-2"></div>
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <label for="">
                        Permanent Address
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                    </label>
                    <div
                        class="p-1 bg-white flex border {{  $errors->has('address') ? 'border-red-500' : '' }} rounded">
                        <textarea placeholder="e.g. Purok Paradise 950"
                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" rows="5"
                            name="address">{{ old('address') }}</textarea>
                    </div>
                    <span class="sm:ml-auto mt-1 sm:mt-0 text-red-600">
                        {{  $errors->first('address') }}
                    </span>
                    <div class="mb-2"></div>
                </div>
            </div>


            <div class="intro-x grid grid-cols-12 gap-4 row-gap-5 mt-5 section hidden" id="login-information">
                <div class="col-span-12 sm:col-span-12">
                    <div>
                        <div class="p-5 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                PHOTO OF FACE
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="w-40 mx-auto relative mt-5">
                                <span class="text-theme-6">
                                    {{ $errors->first('photo_of_face') }}
                                </span>
                                <div class="w-40 h-40 relative image-fit zoom-in mx-auto mb-5">
                                    <img id="photo_of_face"
                                        class="border {{ $errors->has('photo_of_face') ? 'border-theme-6' : '' }}">
                                </div>
                                <button type="button" class="button w-full bg-theme-1 text-white">UPLOAD PHOTO</button>
                                <input type="file" accept="image/*" name="photo_of_face" id="photoOfFace"
                                    class="w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <div>
                        <div class="p-5 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                PHOTO OF ID
                            </h2>
                            <a href="javascript::" data-toggle="modal" data-target="#header-footer-modal-preview"
                                class="text-theme-1">View list of valid IDs</a>
                        </div>
                        <div class="p-5">
                            <div class="w-40 mx-auto relative mt-5">
                                <span class="text-theme-6">
                                    {{ $errors->first('photo_of_id') }}
                                </span>
                                <div class="w-40 h-40 relative image-fit zoom-in mx-auto mb-5">
                                    <img id="photo_of_id"
                                        class="border {{ $errors->has('photo_of_id') ? 'border-theme-6' : '' }}">
                                </div>
                                <button type="button" class="button w-full bg-theme-1 text-white">UPLOAD PHOTO</button>
                                <input type="file" accept="image/*" name="photo_of_id" id="photoOfId"
                                    class="w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button type="button" class="button w-24 justify-center block bg-gray-200 text-gray-600 hidden"
                    id="btn-previous">Previous</button>
                <button type="button" class="button w-24 justify-center block bg-theme-1 text-white ml-2" id="btn-next"
                    data-submit="false">Next</button>
            </div>
        </div>
    </form>
</div>


<!-- BEGIN: Header & Footer Modal -->
<div class="p-5" id="header-footer-modal">
    <div class="modal" id="header-footer-modal-preview">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    List of valid IDs.
                </h2>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-12 text-md">
                    <p>a. Social Security System (SSS) / Government Service Insurance System (GSIS) Unified
                        Multi-Purpose Identification
                        (UMID) Card</p>
                    <p> b. Land Transportation Office (LTO) Driver’s License. Student Permit may be accepted if
                        in card format.</p>
                    <p> c. Professional Regulatory Commission (PRC) ID</p>
                    <p> d. Overseas Workers Welfare Administration (OWWA) / Integrated Department of Labor and
                        Employment (iDOLE) card</p>
                    <p> e. Commission on Elections (COMELEC) Voter's ID or Voter's Certification from the
                        Election Officer with Dry Seal</p>
                    <p> f. Philippine National Police (PNP) Firearms License</p>
                    <p> g. Senior Citizen ID</p>
                    <p> h. Airman License (issued August 2016 onwards)</p>
                    <p> i. Philippine Postal ID (issued November 2016 onwards)</p>
                    <p> j. School ID</p>
                    <p> k. Passport</p>
                    <p> l. In the absence of a valid ID, PSA copy of a birth certificate</p>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- END: Header & Footer Modal -->
@push('page-scripts')
<script src="{{ stage_asset('/dist/js/custom/select/select-province-city.js') }}"></script>
<script src="{{ stage_asset('/dist/js/custom/wizard.js') }}"></script>
<script src="{{ stage_asset('/dist/js/custom/select/barangays.js') }}"></script>
<script>


    $('input[type="radio"]').change((e) => {
        let selectedRadioButton = e.target.value;

        $('#province').val('');
        $('#cities').val('');
        $('#barangay').val('');

        if (selectedRadioButton.toLowerCase() === 'residence') {
            $('#province-container').hide();
            $('#city-container').hide();

            // Removing the name attribute to exclude in back-end validation.
            $('#cities').removeAttr('name');
            $('#province').removeAttr('name');

            // Re-initialize values of barangay select element.
            $('#barangay').empty();
            tandagBarangays.map((barangay) => $('#barangay').append(`<option value='${barangay.code}'>${barangay.name}</option>`));
        } else {
            $('#province-container').show();
            $('#city-container').show();

            $('#cities').attr('name', 'city');
            $('#province').attr('name', 'province');
        }
    });

    // Check if there's a old value that being selected in form before hitting the submit button
    let oldResidenceSelect = "{{ old('residence_type') }}";
    if (oldResidenceSelect) {
        if (oldResidenceSelect.includes('non_')) {
            $('#non_residence').val(oldResidenceSelect)
                .trigger('change');
        } else {
            $('#residence').val(oldResidenceSelect)
                .trigger('change');
        }
    }



    $('#photoOfFace').change(function () {
        if (this.files && this.files[0]) {
            $('#photo_of_face').attr('src', URL.createObjectURL(this.files[0]));
        }
    });

    $('#photoOfId').change(function () {
        if (this.files && this.files[0]) {
            $('#photo_of_id').attr('src', URL.createObjectURL(this.files[0]));
        }
    });

</script>
@endpush
@endsection
