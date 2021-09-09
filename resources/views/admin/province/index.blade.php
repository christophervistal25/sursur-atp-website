@extends('templates-2.app')
@section('page-title','List of Province')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Province
  </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
  <table class="table datatable table--report  display w-full"  id="province-table">
      <thead>
        <tr>
          <th class="font-medium">Code</th>
          <th class="font-medium">Name</th>
          <th class="font-medium">Income Classification</th>
          <th class="font-medium">Population</th>
          <th class="font-medium text-center"># of Municipality</th>
          <th class="font-medium text-center"># of Barangay</th>
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
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}admin/province/list`;
    
    // By default the template has built-in datatable so we need to 
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#province-table').dataTable().fnClearTable();
    $('#province-table').dataTable().fnDestroy();


    let person_table = $('#province-table').DataTable({
          serverSide: true,
          ajax: ROUTE,
          columns: [
              { name: 'code' },
              { name: 'name' },
              { name: 'income_classification' },
              { name: 'population' },
              { name: 'province_cities', searchable : false, orderable : false },
              { name: 'province_barangay', searchable : false, orderable : false },
          ],
      });

  </script>
  @endpush
@endsection
