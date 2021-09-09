@extends('templates-2.app')
@section('page-title','View Personnel')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Personnel
  </h2>
  <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
      <a href="{{  route('personnel.create') }}" class="button text-white bg-theme-1 shadow-md mr-2">Add New Person</a>
  </div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
  @if(request()->has('menu_edit'))
    <div class="rounded-md flex items-center px-5 py-4 mb-3 bg-theme-1">
      <i data-feather="alert-circle" class="w-6 h-6 mr-2 text-white"></i>
      <span class="text-white"> Look for the person you want to edit then click the circle button with pencil icon. </span>
      <a class="flex items-center bg-white rounded-full p-3 shadow ml-2 text-gray">
          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 mx-auto">
              <path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
          </svg>
      </a>
    </div>
  @endif
  <span class="text-gray-800 font-medium">Filter by Province</span>
    <div class="mt-2"></div>
    <select name="cities" id="province_filter" class="select2 input border px-2 py-2 mb-3 w-full">
        <option value="all">Show All</option>
        @foreach($provinces as $province)
        <option value="{{ $province->code }}"> {{ $province->name }}</option>
        @endforeach
    </select>
    <div class="mb-2"></div>
  <table class="table datatable table--report  display"  id="persons-table">
      <thead>
        <tr>
          <th class="font-medium">ID</th>
          <th class="font-medium">Image</th>
          <th class="font-medium">Firstname</th>
          <th class="font-medium">Middlename</th>
          <th class="font-medium">Lastname</th>
          <th class="font-medium">Suffix</th>
          <th class="font-medium">Age</th>
          <th class="font-medium">Province</th>
          <th class="font-medium">City</th>
          <th class="font-medium">Barangay</th>
          <th class="font-medium text-center">Status</th>
          <th class="font-medium">Registered Date</th>
          <th class="font-medium text-center">Options</th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>
<!-- END: Datatable -->
  @push('page-scripts')
  <script>
    $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
  </script>
  <script>
    let BASE_URL = document.head.querySelector("meta[name='base_url']").content;
    let ROUTE = `${BASE_URL}admin/persons/list/`;
    // By default the template has built-in datatable so we need to
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#persons-table').dataTable().fnClearTable();
    $('#persons-table').dataTable().fnDestroy();

    let QUERY_STRING = 'all';

    // Check if there is selected item.
    if(localStorage.getItem('FILTER_SELECT') == null) {
      QUERY_STRING = 'all';
    } else {
      QUERY_STRING = localStorage.getItem('FILTER_SELECT');
      $('#province_filter').val(QUERY_STRING).trigger('change');
    }



    let person_table = $('#persons-table').DataTable({
          serverSide: true,
          ajax: `${ROUTE}${QUERY_STRING}`,
          columns: [
              { name: 'person_id' },
              { name: 'image' },
              { name: 'firstname' },
              { name: 'middlename' },
              { name: 'lastname' },
              { name: 'suffix' },
              { name: 'age' },
              { name: 'province.name', orderable : false },
              { name: 'city.name', orderable : false},
              { name: 'barangay.name', orderable : false },
              { name: 'status', orderable : false, searchable :false, },
              { name: 'created_at' },
              { name: 'admin_action' , searchable : false, orderable : false, },
          ],
      });

      $('#province_filter').change((e)  => {
        // Get the value of selected item
        QUERY_STRING = e.target.value;

        // Set it to local storage to remember the filter selected when re-visit
        localStorage.setItem('FILTER_SELECT', QUERY_STRING);

        // Filter and load data base on selected province
        person_table.ajax.url(`${ROUTE}${QUERY_STRING}`).load();
    });
  </script>
  @endpush
@endsection
