@extends('templates-2.app')
@section('page-title','Update your profile')
@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Update Profile
    </h2>
</div>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
        <!-- BEGIN: Display Information -->
        @if(Session::has('success'))
        <div class="intro-y col-span-12 md:col-span-6">
            <div class="box">
                <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                        <p class="font-medium text-white">{{ Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Account Information
                </h2>
            </div>
            <div class="p-5">
                <form action="{{ route('admin.profile.update.account', $admin->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit  zoom-in mx-auto">
                                    <img class="rounded-md" alt="Administrator Image"
                                        src="{{  stage_asset('storage/images/' . $admin->profile) }}" id="profile">
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    {{-- <button type="button" class="button w-full bg-theme-1 text-white ">Change
                                        Photo</button> --}}
                                    <input type="file" accept="image/*" name="profile"
                                        class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div>
                                <label>Username</label>
                                <input type="text"
                                    class="input w-full border mt-2 {{ $errors->has('username') ? 'border-theme-6' : '' }}"
                                    placeholder="Enter new username" name="username"
                                    value="{{ old('username') ?? $admin->username }}">
                                <span class="text-theme-6 text-sm">{{  $errors->first('username') }}</span>
                            </div>

                            <div class="mt-2">
                                <label>Password</label>
                                <input type="password" name="password"
                                    class="input w-full border  mt-2 {{ $errors->has('password') ? 'border-theme-6' : '' }}"
                                    placeholder="Enter new password">
                                <span class="text-theme-6 text-sm">{{  $errors->first('password') }}</span>
                            </div>

                            <div class="mt-2">
                                <label>Re-type password</label>
                                <input type="password" name="password_confirmation" class="input w-full border  mt-2"
                                    placeholder="Re-type new password">
                            </div>


                            <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Display Information -->
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Personal Information
                </h2>
            </div>
            <div class="p-5">
                <form action="{{ route('admin.profile.update.info', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-3">
                            <div>
                                <label>Firstname</label>
                                <input type="text" name="firstname"
                                    class="input w-full border mt-2 {{ $errors->has('firstname') ? 'border-theme-6' : '' }}"
                                    placeholder="Enter new firstname"
                                    value="{{ old('firstname') ?? $admin->firstname }}">
                                <span class="text-theme-6">
                                    {{  $errors->first('firstname') }}
                                </span>
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-3">
                            <div>
                                <label>Middlename</label>
                                <input type="text" name="middlename"
                                    class="input w-full border mt-2 {{ $errors->has('middlename') ? 'border-theme-6' : '' }}"
                                    placeholder="Enter new middlename"
                                    value="{{ old('middlename') ?? $admin->middlename }}">
                                <span class="text-theme-6">
                                    {{ $errors->first('middlename') }}
                                </span>
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-3">
                            <div>
                                <label>Lastname</label>
                                <input type="text" name="lastname"
                                    class="input w-full border mt-2 {{ $errors->has('lastname') ? 'border-theme-6' : '' }}"
                                    placeholder="Enter lastname" value="{{ old('lastname') ?? $admin->lastname }}">
                                <span class="text-theme-6">{{ $errors->first('lastname') }}</span>
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-3">
                            <div>
                                <label>Suffix</label>
                                <input type="text" name="suffix" class="input w-full border mt-2"
                                    placeholder="Enter suffix" value="{{ old('suffix') ?? $admin->suffix }}">
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>Phone Number</label>
                                <input type="text" name="phone_number"
                                    class="input w-full border mt-2 {{ $errors->has('phone_number') ? 'border-theme-6' : '' }}"
                                    placeholder="Input text" value="{{ old('phone_number') ?? $admin->phone_number }}">
                                <span class="text-theme-1">{{ $errors->first('phone_number') }}</span>
                            </div>
                        </div>
                        <button type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Personal Information -->
        @push('page-scripts')
        <script>
            $('#changeProfile').click(function () {
                $('#changeProfile').trigger('click');
            });
        </script>
        @endpush
        @endsection
