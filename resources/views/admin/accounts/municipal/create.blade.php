@extends('templates-2.app')
@section('page-title', 'Add New Municipal Account')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: Add New Municipal Account -->
            <div class="col-span-12 mt-8">
                {{-- @include('templates.error') --}}
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Add New Municipal Account
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols mt-5">
                    <div class="intro-y col-span-12 lg:col-span-6">
                        @if(Session::has('success'))
                            <div class="intro-y col-span-12 md:col-span-6">
                                <div class="box">
                                    <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded mb-2">
                                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                            <p class="font-medium text-white">{{  Session::get('success') }}</p> 
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
                                    Municipal Account Information
                                </h2>
                            </div>
                            <div class="p-5" id="input">
                                <form method="POST"  action="{{ route('municipal-account.store') }}" class="preview">
                                    @csrf
                                    <div> 
                                        <label>
                                            Username
                                            <span class="text-theme-6">*</span>
                                        </label> 
                                        <input type="text" class="input w-full border {{  $errors->has('username')  ? 'border-theme-6' : '' }}" name="username" value="{{ old('username') }}" placeholder="e.g. administrator">
                                        <div class="text-theme-6">
                                            @if($errors->has('username'))
                                                {{ $errors->first('username') }}
                                            @else
                                                Required, atleast 6 characters
                                            @endif
                                        </div>
                                    </div>


                                    <div class="mt-3"> 
                                        <label>
                                            Password
                                            <span class="text-theme-6">*</span>
                                        </label>
                                        <input type="password" class="input w-full border {{  $errors->has('password')  ? 'border-theme-6' : '' }}" name="password">
                                        <div class="text-theme-6">
                                            @if($errors->has('password'))
                                                {{ $errors->first('password') }}
                                            @else
                                                Required, atleast 6 characters
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3"> 
                                        <label>
                                            Re-type Password
                                            <span class="text-theme-6">*</span>
                                        </label> 
                                        <input type="password" class="input w-full border {{  $errors->has('password')  ? 'border-theme-6' : '' }}" placeholder="" name="password_confirmation">
                                        <div class="text-theme-6">
                                            @if($errors->has('password_confirmation'))
                                                {{ $errors->first('password_confirmation') }}
                                            @else
                                                Required, atleast 6 characters and must be the same with password field
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3 mb-3"> 
                                        <label>
                                            Phone number 
                                            <span class="text-theme-6">*</span>
                                        </label> 
                                        <input type="text" class="input w-full border {{  $errors->has('phone_number')  ? 'border-theme-6' : '' }}" placeholder="+639193693499" value="{{  old('phone_number') }}" name="phone_number">
                                        <div class="text-theme-6">
                                            @if($errors->has('phone_number'))
                                                {{ $errors->first('phone_number') }}
                                            @else
                                                Required, Please include country code e.g. +639
                                            @endif
                                        </div>
                                    </div>


                                    <div class="mt-3 mb-3"> 
                                        <label>
                                            City 
                                            <span class="text-theme-6">*</span>
                                        </label> 
                                        <select type="text" class="select2 input w-full border {{  $errors->has('city')  ? 'border-theme-6' : '' }}" value="{{  old('city') }}" name="city">
                                            @foreach($cities as $city)
                                                @if(old('city'))
                                                    <option {{ old('city') == $city->code ? 'selected' : '' }} value="{{ $city->code }}"> {{ $city->name }}</option>
                                                @else
                                                    <option value="{{ $city->code }}"> {{ $city->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="text-theme-6">
                                            @if($errors->has('city'))
                                                {{ $errors->first('city') }}
                                            @endif
                                        </div>
                                    </div>


                                    <div class="flex lg:justify-end mt-5">
                                        <button type="submit" class="button bg-theme-1 text-white w-auto">Add New Municipal Account</button>    
                                    </div>
                                </form>
                             </div>
                            </div>
                        </div>
                        <!-- END: Input -->
                    </div>
                </div>
            </div>
            <!-- END: Add New Municipal Account -->
        </div>
    </div>
@endsection
