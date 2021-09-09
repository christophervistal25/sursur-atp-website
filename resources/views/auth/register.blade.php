<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Register</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ stage_asset('/dist/css/app.css') }}" />
    <!-- END: CSS Assets-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<!-- END: Head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Logo" src="{{ stage_asset('/dist/images/logo.png') }}">
                    <span class="text-white text-lg ml-3"> <span class="font-medium">{{  config('app.name') }}</span>
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="" class="-intro-x w-1/2 -mt-16" src="/dist/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to
                        <br>
                        sign up to your account.
                    </div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Create your account
                    </h2>
                    <form method="POST" action="{{  route('auth.register') }}">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text"
                                class="login__input input input--lg border rounded-none border-gray-300 block {{  $errors->has('firstname')  ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Firstname" name="firstname" value="{{ old('firstname') }}">
                            <span class="text-theme-6">{{  $errors->first('firstname') }}</span>

                            <input type="text"
                                class=" login__input input input--lg border rounded-none border-gray-300 block mt-4 {{  $errors->has('middlename') ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Middlename" name="middlename" value="{{  old('middlename') }}">
                            <span class="text-theme-6">{{  $errors->first('middlename') }}</span>

                            <input type="text"
                                class=" login__input input input--lg border rounded-none border-gray-300 block mt-4 {{  $errors->has('lastname') ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Lastname" name="lastname" value="{{  old('lastname') }}">
                            <span class="text-theme-6">{{  $errors->first('lastname') }}</span>

                            <div class="mt-4">
                                <input type="date"
                                    class=" login__input input input--lg border rounded-none border-gray-300 block {{ $errors->has('date_of_birth') ? 'border-theme-6' : 'intro-x' }}"
                                    placeholder="Date of Birth" name="date_of_birth"
                                    value="{{  old('date_of_birth') }}">

                                <span class="text-theme-6">{{  $errors->first('date_of_birth') }}</span>
                            </div>

                            <input type="text"
                                class=" login__input input input--lg border rounded-none border-gray-300 block mt-4 {{  $errors->has('username') ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Username" name="username" value={{ old('username') }}>
                            <span class="text-theme-6">{{  $errors->first('username') }}</span>

                            <input type="number"
                                class=" login__input input input--lg border  border-gray-300 block mt-4 {{  $errors->has('phone_number') ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Mobile Number" name="phone_number" value={{ old('phone_number') }}>
                            <span class="text-theme-6">{{  $errors->first('phone_number') }}</span>

                            <input type="text"
                                class=" login__input input input--lg border rounded-none border-gray-300 block mt-4 {{  $errors->has('password') ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Password" name="password">
                            <span class="text-theme-6">{{  $errors->first('password') }}</span>

                            <input type="text"
                                class=" login__input input input--lg border rounded-none border-gray-300 block mt-4 {{  $errors->has('password') ? 'border-theme-6' : 'intro-x' }}"
                                placeholder="Re-type password" name="password_confirmation">
                        </div>

                        <div class="intro-x flex items-center text-gray-700 mt-4 text-xs sm:text-sm">
                            <input type="checkbox" class="input border mr-2" id="remember-me">
                            <label class="cursor-pointer select-none" for="remember-me">I agree to the
                                {{ config('app.name') }}</label>
                            <a class="text-theme-1 ml-1" href="">Privacy Policy</a>.
                        </div>

                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit"
                                class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Register</button>
                            <button type="button" id="btn-sign-in"
                                class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Sign
                                in</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('/dist/js/app.js') }}"></script>
    <!-- END: JS Assets-->
    <script>
        $('#btn-sign-in').click((e) => window.location.href = "{{ route('login') }}")

    </script>
</body>

</html>
