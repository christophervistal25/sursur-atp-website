@extends('templates-2.app')
@section('page-title', 'Add New Checker')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: Add New Checker -->
            <div class="col-span-12 mt-8">
                {{-- @include('templates.error') --}}
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Add New Checker
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols mt-5">
                    <div class="intro-y col-span-12 lg:col-span-6">
                        @if(Session::has('success'))
                            <div class="intro-y col-span-12 md:col-span-6">
                                <div class="box">
                                    <div class="flex flex-col lg:flex-row items-center p-5 bg-theme-9 rounded">
                                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                            <p class="font-medium mb-2 text-white">Checker Successfully Added!</p>
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
                                    Checker Information
                                </h2>
                            </div>
                            <div class="p-5" id="input">
                                <form id="formAddNewChecker" method="POST" action="{{ route('checker.store') }}" class="preview">
                                    @csrf
                                    <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
                                        <div class="flex-1 flex flex-col md:flex-row">
                                            <div class="w-full flex-1">
                                                <label>
                                                    Firstname
                                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                                </label>

                                                <div class="p-1 bg-white flex border rounded  {{ $errors->has('firstname')  ? 'border-red-500' : '' }}">
                                                    <input class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. Christopher" aria-invalid="true" name="firstname" value="{{  old('firstname') }}">
                                                </div>
                                                <div class="text-xs text-theme-6">
                                                    @if($errors->has('firstname'))
                                                        {{ $errors->first('firstname') }}
                                                    @else
                                                    Required, at least 3 characters
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="w-full flex-1 mx-2">
                                                Middlename
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                                <div class="p-1 bg-white flex border {{ $errors->has('middlename')  ? 'border-red-500' : '' }} rounded">
                                                    <input class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. Platino" name="middlename" value="{{  old('middlename') }}">
                                                </div>
                                                <div class="text-xs text-theme-6">
                                                    @if($errors->has('middlename'))
                                                        {{ $errors->first('middlename') }}
                                                    @else
                                                        Required, at least 2 characters
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="w-full flex-1 mx-2">
                                                Lastname
                                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
                                                <div class="p-1 bg-white flex border {{ $errors->has('lastname')  ? 'border-red-500' : '' }} rounded">
                                                    <input class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" placeholder="e.g. Vistal" name="lastname" value="{{  old('lastname') }}">
                                                </div>
                                                <div class="text-xs text-theme-6">
                                                    @if($errors->has('lastname'))
                                                        {{ $errors->first('lastname') }}
                                                    @else
                                                        Required, at least 2 characters
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="w-full flex-1 mx-2">
                                                Suffix
                                                <div class="p-1 bg-white flex border rounded">
                                                    <input placeholder="Enter Suffix" class="p-1 px-2 appearance-none outline-none w-full text-gray-800" type="text" maxlength="3" placeholder="e.g. Jr" name="suffix" value="{{  old('suffix') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label>
                                            Username
                                            <span class="text-theme-6">*</span>
                                        </label>
                                        <input type="text" class="input w-full border {{  $errors->has('username')  ? 'border-theme-6' : '' }}" name="username" value="{{ old('username') }}" placeholder="checker01">
                                        <div class="text-xs text-theme-6">
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
                                        <div class="text-xs text-theme-6">
                                            @if($errors->has('password'))
                                                {{ $errors->first('password') }}
                                            @else
                                                Required, atleast 6 characters
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label>Re-type Password</label>
                                        <input type="password" class="input w-full border {{  $errors->has('password_confirmation')  ? 'border-theme-6' : '' }}" placeholder="" name="password_confirmation">
                                        <div class="text-xs text-theme-6">
                                            @if($errors->has('password_confirmation'))
                                                {{ $errors->first('password_confirmation') }}
                                            @else
                                                Required, atleast 6 characters and same with password field
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3 mb-3">
                                        <label>
                                            Phone number
                                            <span class="text-theme-6">*</span>
                                        </label>
                                        <input type="text" class="input w-full border {{  $errors->has('phone_number')  ? 'border-theme-6' : '' }}" placeholder="+639193693499" value="{{  old('phone_number') }}" name="phone_number">
                                        <div class="text-xs text-theme-6">
                                            @if($errors->has('phone_number'))
                                                {{ $errors->first('phone_number') }}
                                            @else
                                                Required, Please include country code e.g. +639
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <label>
                                            Municipalities
                                            <span class="text-theme-6">*</span>
                                        </label>
                                        <select class="select2 w-full input border" name="city">
                                            @foreach($cities as $city)
                                                <option value="{{ $city->code }}">
                                                    {{ $city->province->name }} - {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="flex lg:justify-end mt-5">
                                        <button type="submit" class="button bg-theme-1 text-white w-auto">Add New Checker</button>
                                    </div>
                                </form>
                             </div>
                            </div>
                        </div>
                        <!-- END: Input -->
                    </div>
                </div>
            </div>
            <!-- END: Add New Checker -->
        </div>
    </div>
@endsection
