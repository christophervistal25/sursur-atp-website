@extends('templates-2.app')
@section('page-title','View Personnel')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Personnel
  </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5 ">
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
      <tbody class='text-center'></tbody>
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
    // By default the template has built-in datatable so we need to 
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#persons-table').dataTable().fnClearTable();
    $('#persons-table').dataTable().fnDestroy();

    let QUERY_STRING = 'all';

    // Check if there is selected item.
    let BASE_URL = document.head.querySelector("meta[name='base_url']").content;
    let ROUTE = `${BASE_URL}municipal/people/list/${QUERY_STRING}`;

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
              { name: 'status', orderable : false },
              { name: 'created_at' },
              { name: 'action' , searchable : false, orderable : false, },
          ],
      });
  </script>
  @endpush
@endsection
