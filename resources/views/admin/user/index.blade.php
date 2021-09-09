@extends('templates-2.app')
@section('page-title','List of User')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        @yield('page-title')
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="{{ route('personnel.create') }}"
            class="button text-white bg-theme-1 shadow-md mr-2 sm:w-full md:w-auto lg:w-auto xl:w-auto">Add New User</a>
    </div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    @if(request()->has('menu_edit'))
    <div class="rounded-md flex items-center px-5 py-4 mb-3 bg-theme-1">
        <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
        <span class="text-white"> Look for the checker you want to edit then click the circle button with pencil icon.
        </span>
        <a class="flex items-center bg-white rounded-full p-3 shadow ml-2 text-gray">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-edit-3 mx-auto">
                <path d="M12 20h9"></path>
                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
            </svg>
        </a>
    </div>
    @endif
    <table class="table  display datatable w-full" id="checkers-table">
        <thead>
            <tr>
                <td class="font-medium">Username</td>
                <td class="font-medium text-center">Status</td>
                <td class="font-medium text-center">Registered Date</td>
                <td class="font-medium text-center">Options</td>
            </tr>
        </thead>
        <tbody class='text-center'>
            @forelse($users as $user)
            <tr>
                <td class="font-medium">{{ $user->username }}</td>
                <td class="font-medium text-center">
                    <span class="px-2 py-1 rounded text-xs text-white rounded-full {{ $user->status ? 'bg-theme-6' : 'bg-theme-1' }}">
                        {{ $user->status  ? 'Incomplete' : 'Complete' }}
                    </span>
                </td>
                <td class="capitalize text-center">{{ $user->created_at->format('F d, Y h:i A') }}</td>
                <td class="text-center border-b w-5">
                    <div class="flex sm:justify-center items-center ">
                        <a class="flex items-center bg-white rounded-full p-3 mr-3 shadow"
                            href="{{ route('personnel.edit', $user->person_id) }}" title="Edit User">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-edit-3 mx-auto">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </a>
                        <a class="flex items-center bg-white rounded-full p-3 mr-3 shadow"
                            href="{{ route('personnel.logs', $user->person_id) }}"
                            title="View Information of {{ $user->username }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-eye mx-auto">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>
<!-- END: Datatable -->
@endsection
