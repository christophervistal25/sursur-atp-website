@extends('templates-2.app')
@section('page-title','View Establishments')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Establishment
  </h2>
  <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
      <a href="{{  route('m-establishment.create') }}" class="button text-white bg-theme-1 shadow-md mr-2">Add New Establishment</a>
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
      <span class="text-white"> Look for the establishment you want to edit then click the circle button with pencil icon. </span>
      <a class="flex items-center bg-white rounded-full p-3 shadow ml-2 text-gray"> 
          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 mx-auto">
              <path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
          </svg>
      </a>
    </div>
  @endif
  <table class="table datatable  display w-full"  id="estabshliment-table">
      <thead>
        <tr>
          <td class="text-center font-medium">ID</td>
          <td class="text-center font-medium">Establishment/Office/Store Name</td>
          <td class="text-center font-medium">Address Located</td>
          <td class="text-center font-medium">Contact Number</td>
          <td class="text-center font-medium">Latitude</td>
          <td class="text-center font-medium">Longitude</td>
          <td class="text-center font-medium">Date/Time register</td>
          <td class="text-center font-medium">Option</td>
        </tr>
      </thead>
      <tbody class="text-center"></tbody>
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
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}municipal/m-establishment/list`;
    
    // By default the template has built-in datatable so we need to 
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#estabshliment-table').dataTable().fnClearTable();
    $('#estabshliment-table').dataTable().fnDestroy();

    let estabshliment_table = $('#estabshliment-table').DataTable({
          serverSide: true,
          ajax: ROUTE,
            columns: [
                { name: 'id' },
                { name: 'name' },
                { name: 'address' },
                { name: 'contact_no' },
                { name: 'latitude' },
                { name: 'longitude' },
                { name: 'created_at' },
                { name: 'municipal_action' , searchable : false, orderable : false, },
          ],
      });
  </script>
  @endpush
@endsection

