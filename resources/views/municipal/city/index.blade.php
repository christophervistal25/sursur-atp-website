@extends('templates-2.app')
@section('page-title','List of Municipalities')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Municipalities
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
  <table class="table datatable table--report  display w-full"  id="municipality-table">
      <thead>
        <tr>
          <th class="font-medium">Code</th>
          <th class="font-medium">Name</th>
          <th class="font-medium">Province</th>
          <th class="font-medium">Income Classification</th>
          <th class="font-medium">Population</th>
          <th class="font-medium text-center"># of Barangays</th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>
<!-- END: Datatable -->
  @push('page-scripts')
  <script>
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}municipal/m-city/list`;
    // By default the template has built-in datatable so we need to
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#municipality-table').dataTable().fnClearTable();
    $('#municipality-table').dataTable().fnDestroy();


    let municipality_table = $('#municipality-table').DataTable({
          serverSide: true,
          ajax: `/municipal/m-city/list`,
          columns: [
              { name: 'code' },
              { name: 'name' },
              { name: 'municipality_province', orderable : false, searchable : false },
              { name: 'income_classification' },
              { name: 'population' },
              { name: 'municipality_barangay', searchable: false, orderable : false },
          ],
      });

  </script>
  @endpush
@endsection
