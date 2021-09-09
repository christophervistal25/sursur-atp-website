@extends('templates-2.app')
@section('page-title','Track Personnel')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      Track Personnel
  </h2>
  <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
      {{-- <a href="#" class="button text-white bg-theme-1 shadow-md mr-2">Add New Municipality</a> --}}
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
  <table class="table datatable table--report  display w-full"  id="people-table">
      <thead>
        <tr>
            <th>Person ID</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Lastname</th>
            <th>Suffix</th>
            <th>Province</th>
            <th>City</th>
            <th>Barangay</th>
            <th># of Logs</th>
            <th>Options</th>
        </tr>
      </thead>
      <tbody class='text-center'></tbody>
  </table>
</div>
<!-- END: Datatable -->
  @push('page-scripts')
  <script>
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}admin/persons/track`;
    // By default the template has built-in datatable so we need to 
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#people-table').dataTable().fnClearTable();
    $('#people-table').dataTable().fnDestroy();


    let people = $('#people-table').DataTable({
          serverSide: true,
            ajax: ROUTE,
            columns: [
                { name: 'person_id' },
                { name: 'firstname' },
                { name: 'middlename' },
                { name: 'lastname' },
                { name: 'suffix' },
                { name: 'province.name', orderable :false, searchable : false },
                { name: 'city.name', orderable :false, searchable : false },
                { name: 'barangay.name', orderable :false, searchable : false },
                { name: 'person_logs', orderable : false, searchable : false },
                { name: 'track_action', searchable : false, orderable : false, },
            ],
      });

  </script>
  @endpush
@endsection
