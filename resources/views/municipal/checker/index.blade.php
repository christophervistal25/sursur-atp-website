@extends('templates-2.app')
@section('page-title','List of Checker')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Checker
  </h2>
  <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
      <a href="{{  route('m-checker.create') }}" class="button text-white bg-theme-1 shadow-md mr-2">Add New Checker</a>
      {{-- <div class="dropdown relative ml-auto sm:ml-0">
          <button class="dropdown-toggle button px-2 box text-gray-700">
              <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
          </button>
          <div class="dropdown-box mt-10 absolute w-40 top-0 right-0 z-20">
              <div class="dropdown-box__content box p-2">
                  <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New Category </a>
                  <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> New Group </a>
              </div>
          </div>
      </div> --}}
  </div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
  @if(request()->has('menu_edit'))
    <div class="rounded-md flex items-center px-5 py-4 mb-3 bg-theme-1">
      <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
      <span class="text-white"> Look for the checker you want to edit then click the circle button with pencil icon. </span>
      <a class="flex items-center bg-white rounded-full p-3 shadow ml-2 text-gray">
          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 mx-auto">
              <path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
          </svg>
      </a>
    </div>
  @endif
  <table class="table  display datatable w-full"  id="checkers-table">
      <thead>
        <tr>
          <td class="font-medium">Username</td>
          <td class="font-medium">Firstname</td>
          <td class="font-medium">Middlename</td>
          <td class="font-medium">Lastname</td>
          <td class="font-medium">Suffix</td>
          <td class="font-medium">Phone Number</td>
          <td class="font-medium">Municipal</td>
          <td class="font-medium">Registered Date</td>
          <td class="font-medium">Options</td>
        </tr>
      </thead>
      <tbody class='text-center'>
        @forelse($checkers as $checker)
            <tr>
              <td class="font-medium">{{ $checker->username }}</td>
              <td class="capitalize">{{ $checker->firstname }}</td>
              <td class="capitalize">{{ $checker->middlename }}</td>
              <td class="capitalize">{{ $checker->lastname }}</td>
              <td class="capitalize">{{ $checker->suffix }}</td>
              <td class="capitalize">{{ $checker->phone_number }}</td>
              <td class="capitalize">{{ $checker->city->name }}</td>
              <td class="capitalize text-center">{{ $checker->created_at->format('m/d/Y') }}</td>
              <td class="text-center border-b w-5">
                <div class="flex sm:justify-center items-center ">
                    <a class="flex items-center bg-white rounded-full p-3 mr-3 shadow" href="{{ route('m-checker.edit', $checker->id) }}" title="Edit Checker">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 mx-auto">
                          <path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
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
