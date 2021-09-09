@extends('templates-2.app')
@section('page-title','List of Barangay')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Barangay
  </h2>
  <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
      {{-- <a href="#" class="button text-white bg-theme-1 shadow-md mr-2">Add New Barangay</a> --}}
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
  <table class="table datatable table--report  display w-full"  id="barangay-table">
      <thead>
        <tr>
          <th class="font-medium">Code</th>
          <th class="font-medium">Province Code</th>
          <th class="font-medium">Municipality Code</th>
          <th class="font-medium">Name</th>
          <th class="font-medium">Urban / Rural (base on 2010 CPH)</th>
          <th class="font-medium text-center">Population</th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>
<!-- END: Datatable -->
  @push('page-scripts')
  <script>
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}municipal/barangay/list`;
    // By default the template has built-in datatable so we need to
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
     $('#barangay-table').dataTable().fnClearTable();
     $('#barangay-table').dataTable().fnDestroy();


    let barangay_table = $('#barangay-table').DataTable({
          serverSide: true,
          ajax: ROUTE,
          columns: [
              { name: 'code' },
              { name: 'province_code' },
              { name: 'city_code' },
              { name: 'name' },
              { name: 'type' },
              { name: 'population' },
          ],
      });

  </script>
  @endpush
@endsection
