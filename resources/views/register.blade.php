@extends('templates-2.app')
@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium">
            Regular Form
        </h2>
    </div>
    <div class="grid">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Input
                    </h2>
                </div>
                <div class="p-5" id="input">
                    <div class="preview">
                        <div>
                            <label>Input Text</label>
                            <input type="text" class="input w-full border mt-2" placeholder="Input text">
                        </div>
                        <div class="mt-3">
                            <label>Rounded</label>
                            <input type="text" class="input w-full rounded-full border mt-2" placeholder="Rounded">
                        </div>
                        <div class="mt-3">
                            <label>With Help</label>
                            <input type="text" class="input w-full border mt-2" placeholder="With help">
                            <div class="text-xs text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                        </div>
                        <div class="mt-3">
                            <label>Password</label>
                            <input type="password" class="input w-full border mt-2" placeholder="Password">
                        </div>
                        <div class="mt-3">
                            <label>Disabled</label>
                            <input type="text" class="input w-full border mt-2 bg-gray-100 cursor-not-allowed" placeholder="Disabled" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Input -->
        </div>
    </div>
@endsection
